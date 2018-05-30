<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Item;
use App\Models\Book;
use App\Models\Book_User;
use App\Repositories\BookRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct() {
        $this->obj_order = new Order();
        $this->obj_item = new Item();
        $this->obj_user = new User();
        $this->obj_book = new Book();
        $this->obj_book_user = new Book_User();
    }

    public function index(Request $request)
    {
        $list =  $this->obj_order->getOrdersExpired();
        $i = $this->obj_item->getItemById(1);

        return view('admin.orders.index',['list' => $list]);
    }

    public function create()
    {
        $users = User::all();
        $list = $this->obj_book->getBookByFlag();
        return view('admin.orders.create',['users' => $users,'lists' => $list]);
    }

    public function postCreate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user'                  => 'required',
                'book'                  => 'required'
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

            // //update flag khi 
            // //find book with id->first()->update flag => 1
            // $book_user = Book_User::where("id",$item->book_copy_id)->first();
            // $book_user->flag = 1
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

}
