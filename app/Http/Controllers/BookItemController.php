<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\BookItem;
use App\Models\UserBookItem;
use Illuminate\Http\Request;
use App\Repositories\BookRepository;
use Illuminate\Support\Facades\Validator;


class BookItemController extends Controller
{
    
    public function __construct() {
        $this->obj_user = new User();
        $this->obj_book = new Book();
        $this->obj_book_item = new BookItem();
        $this->obj_user_book_item = new UserBookItem();
    }

    public function index()
    {
        $users = User::all();
        $books = Book::all()->sortByDesc("id");
        return view('admin.book_items.index',['users' => $users, 'books' => $books]);

    }

    public function search(Request $request)
    {      
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if($query != '')
            {
                $data = Book::where('title','like', '%'.$query.'%')->get();    
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)
                {
                    $output .= '
                    <tr>
                    <td>'.$row->title.'</td>
                    </tr>
                    ';
                }
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
               );
         
            echo json_encode($data);
                
        }  

    }

    public function create(Request $request,BookRepository $bookRepository)
    {
        //lưu 2 bang book item và user book_item
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
                $book_item = $this->obj_book_item->create([
                    "book_id"             =>$book_id, 
                    "stock_date"          => date('Y-m-d h:i:s'),
                    ]);

                $user_book_item = $this->obj_user_book_item->create(
                    [
                        'user_id'           => $user_id,
                        'book_item_id'      => $book_item->id,
                    ]);
            }
            //var_dump($book_item->id);die();
            
            return redirect('/books')->with('notify-success', 'Thêm item thành công');
        }     
    }
}
