<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Book;
use App\Models\BookItem;
use App\Models\UserBookItem;
use App\Repositories\BookRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct() {
        $this->obj_order = new Order();
        $this->obj_user = new User();
        $this->obj_book = new Book();
        $this->obj_user_book_item = new UserBookItem();
    }

    public function index(Request $request)
    {
        $name = $request->input('name');
        $user = User::where('username',$name)->first();
        $search_query = Order::query();
        if($name == "")
        {
            $list =  $this->obj_order->getOrderByStatus($search_query);
            return view('admin.orders.index',['list' => $list,'name' => $name]);
        }
        if($user)
        {
            if($name)
            {
                $search_query->Where('borrower_id', $user->id);
            }   
            $list =  $this->obj_order->getOrderByStatus($search_query);
            return view('admin.orders.index',['list' => $list,'name' => $name]);
        }else
        {
            $list =  $this->obj_order->getOrderByStatus($search_query);
            return view('admin.orders.index',['list' => $list,'name' => $name])->withErrors(['error' => "Not found!"]);
        }
    }

    public function create()
    {
        $users = User::all();
        //$list = $this->obj_book->getBookByFlag();
        return view('admin.orders.create',['users' => $users]);
    }

    public function postCreate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user'                  => 'required',
                'book[]'                  => 'required'
            ]
            ,
            [
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user_id       = $request->input('user');

            
            $order = $this->obj_order->create(
                [
                "user_id"          =>$user_id, 
                "flag"             => 0,
                "expired"          =>date('Y-m-d h:i:s', strtotime("+10 day")), 
                ]);
            
            $item = $this->obj_item->create([
                'order_id'  => $order->id,
                'book_copy_id'  => 1
            ]);

            //find book with id->first()->update flag => 1
            // $book_user = Book_User::where("id",$item->book_copy_id)->first();
            // $book_user->flag = 1;
            // $book_user->save();

            return redirect('/orders')->with('notify-success', 'Thêm cate thành công');
        }
    }

    public function edit(Type $var = null)
    {
        # code...
    }

    public function update(Type $var = null)
    {
        # code...
    }

    public function delete(Type $var = null)
    {
        # code...
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');

            if($query != '')
            {
                //get list book count b_item theo id > 0 va status = 0
                $book = Book::where('title','like',$query)->first();  
                $data = $book->bookItems()->where("status",0)->get();
                
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)
                {
                    $output .= '
                    <tr>
                    <td id = '.$row->book_id.' >'. BookItem::where('book_id',$row->book_id)->first()->book->title.'</td>
                    <td class="text-center"><input type="checkbox"></td>
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

    

}
