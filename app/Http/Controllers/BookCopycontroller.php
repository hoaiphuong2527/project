<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\BCopy;
use Illuminate\Http\Request;
use App\Repositories\BookCopyRepository;
use Illuminate\Support\Facades\Validator;


class BookCopycontroller extends Controller
{
    public function index()
    {
      $users = User::all();
      $books = Book::all();
      return view('admin.book_copy.index',['users' => $users, 'books' => $books]);
    }

    public function update(Request $request,BookCopyRepository $bookCopyRepository)
    {
        $validator = Validator::make(
          $request->all(),
          [
              'book'                  => 'required',
              'user'                  => 'required',
              'amount'                => 'required|numeric',    
          ]
          ,
          []
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else {
            $book_id              = (int) $request->input('book');
            $user_id              = (int) $request->input('user');
            $amount               = $request->input('amount');

            $bCopy = $bookCopyRepository->create([
            "book_id"          =>$book_id, 
            "user_id"          =>$user_id,
            "amount"           =>$amount, 
          ]);
            return redirect('/books')->with('notify-success', 'Thêm item thành công');
        }     
    }
}
