<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\BookRepository;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, BookRepository $bookRepository )
    {
        $title = $request->input('title');
        $author = $request->input('author');

        $search_query = Book::query(); 

        if($title)
        {
            $search_query->where('title', 'like', '%'.$title.'%');
        }
        if($author)
        {
            $search_query->where('author', 'like', '%'.$author.'%');
        }

        $books = $bookRepository->getAll($search_query);
        $types = config('admin-book.type');

        return view('admin.books.index',['books' => $books,
        'title' => $title,
        'author' => $author,
        'types' => $types,]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $types = config('admin-book.type');
        return view('admin.books.create',[
            'types' => $types,
            'categories'    => $categories,
        ]);
    }

    /**
     * postCreate.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request, BookRepository $bookRepository)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title'                  => 'required|min:6|max:30',
                'author'                 => 'required|min:6|max:30',
                'category'               => 'required',    
                'type'                   => 'required',
            ]
            ,
            [
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else {
            $title              = $request->input('title');
            $author             = $request->input('author');
            $type               = (int) $request->input('type');
            $category_id        = (int) $request->input('category');
            $book = $bookRepository->create(
            [
                "title"          =>$title, 
                "author"         =>$author,
                "type"           =>$type, 
                "category_id"    =>$category_id,
                
                ]); 
            
            return redirect('/books')->with('notify-success', 'Thêm item thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request, BookRepository $bookRepository)
    {
        $id = $request->id;
        $obj = new Book();
        $types = config('admin-book.type');
        return view('admin.books.detail', ['book' => $obj->findBook((int) $id), 'types' =>  $types]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit(Request $request, BookRepository $bookRepository)
    {
        $id = $request->id;
        $obj = new Book();
        $categories = Category::all();
        $types = config('admin-book.type');
        return view('admin.books.edit', ['book' => $obj->findBook((int) $id), 'types' =>  $types,'categories'    => $categories,]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookRepository $bookRepository)
    {
        $id = $request->id;
        $obj = new Book();
        $validator = Validator::make($request->all(), [
            'title'                  => 'required|min:6|max:30',
            'author'                 => 'required|min:6|max:30',
            'category'               => 'required',    
            'type'                   => 'required',
            ],
            [
            ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $bookRepository->update(
                [
                
                "title"          =>$request->get('title'),
                "author"         =>$request->get('author'), 
                "type"           =>$request->get('type'), 
                "category_id"    =>$request->get('category')
                ], 
                (int) $id,
                "id"
                );
                return redirect('/books')->with('notify-success', 'Sửa item thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $obj = new Book();
        $obj->destroyBook((int) $id);
        return redirect('/books');
    }
}
