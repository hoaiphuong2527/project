<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Book_User;
use Illuminate\Http\Request;
use App\Repositories\BookCopyRepository;
use App\Repositories\BookRepository;
use Illuminate\Support\Facades\Validator;


class BookCopyController extends Controller
{
    public function index()
    {
      $users = User::all();
      $books = Book::all();
      return view('admin.book_copy.index',['users' => $users, 'books' => $books]);
    }

    public function update(Request $request,BookCopyRepository $bookCopyRepository,BookRepository $bookRepository )
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
            $amount               = (int) $request->input('amount');
            
            for($i = 0 ; $i < $amount; $i++){
                $book_user = $bookCopyRepository->create([
                    "book_id"          =>$book_id, 
                    "user_id"          =>$user_id
                    ]);
            }
            return redirect('/books')->with('notify-success', 'Thêm item thành công');
        }     
    }
}
