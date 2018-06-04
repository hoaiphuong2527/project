<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Book;
use App\Models\BookItem;
use App\Models\OrderItem;
use App\Models\UserBookItem;
use App\Repositories\BookRepository;
use App\Repositories\OrderRepository;
use App\Repositories\BookItemRepository;
use App\Repositories\OrderItemRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct() {
        $this->obj_order = new Order();
        $this->obj_user = new User();
        $this->obj_book = new Book();
        $this->obj_book_item = new BookItem();
        $this->obj_order_item = new OrderItem();
        $this->obj_user_book_item = new UserBookItem();
    }

    public function index(Request $request)
    {
        $name = $request->input('name');
        $status = $request->input('status');

        $user = User::where('username',$name)->first();
        $search_query = Order::query();
        if($name == "")
        {
            if($status)
            {
                if($status === "all")
                    $search_query->get();
                if($status === "borrowing")
                    $search_query->where('status',0);
                if($status === "returned")
                    $search_query->where('status',1);
            }
            $list =  $this->obj_order->getOrders($search_query);
            return view('admin.orders.index',['list' => $list,'name' => $name,'status' => $status]);
        }
        if($user)
        {
            if($name)
            {
                $search_query->Where('borrower_id', $user->id);
            }   
            if($status)
            {
                if($status === "all")
                    $search_query->get();
                if($status == 0)
                    $search_query->where('status',0);
                if($status == 1)
                    $search_query->where('status',1);
            }
            $list =  $this->obj_order->getOrders($search_query);
            return view('admin.orders.index',['list' => $list,'name' => $name,'status' => $status]);
        }else
        {
            if($status)
            {
                if($status === "all")
                    $search_query->get();
                if($status == 0)
                    $search_query->where('status',0);
                if($status == 1)
                    $search_query->where('status',1);
            }
            $list =  $this->obj_order->getOrders($search_query);
            return view('admin.orders.index',['list' => $list,'name' => $name,'status' => $status])->withErrors(['error' => "Not found!"]);
        }
    }

    public function create()
    {
        $users = User::all();
        return view('admin.orders.create',['users' => $users]);
    }

    public function postCreate(Request $request,
    BookItemRepository $bookItemRepository)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user'                  => 'required',
            ]
            ,
            [
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {    
            $user_id       = $request->input('user');
            $order = Order::create(
                [
                "borrower_id"          =>$user_id, 
                "status"               => 0,
                "order_date"           => date('Y-m-d h:i:s'),
                "return_date"          => null,
                "expired_date"              => date('Y-m-d h:i:s', strtotime("+10 day")), 
                ]);
            $listOrderItem = $request->bookID;
            //validate list book
            if($listOrderItem == null)
            {
                return redirect()->back()->withErrors(['error' => 'Please choose book!'])->withInput();
            }
            //create order item and update status book item
            foreach($listOrderItem as $row)
            {
                $order_item = OrderItem::create([
                'order_id'      => $order->id,
                'book_item_id'  => $row, 
                'status'        => 0,
                ]);
            
                $book_item = $bookItemRepository->update([
                    'status'    => 1,
                ]
                ,(int) $row //$row
                ,"id");
            }   
            return redirect('/orders')->with('notify-success', 'Thêm order thành công');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $order = Order::find((int) $id);
        $users = User::all();
        return view('admin.orders.edit',['order' => $order,'users' => $users]);
    }

    public function update(Request $request,BookItemRepository $bookItemRepository,OrderItemRepository $orderItemRepository)
    {
        $id = $request->id;
        $order = Order::find((int) $id);
        $validator = Validator::make(
            $request->all(),
            [
                'user'                  => 'required'
            ]
            ,
            [
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user_id       = $request->input('user');
            $order->update([
                'borrower_id' => $user_id,
            ]);
            //luu y update status sach da remove => 0
            $listOldBook = [];// array id old book

            foreach ($order->orderItems as $old) {
                $listOldBook[] = $old->book_item_id;
            }

            $listOrderItem = $request->bookID ?? [];
            //validate list book 
            if($listOrderItem == null)
            {
                return redirect()->back()->withErrors(['error' => 'Please choose book!'])->withInput();
            }

            //update book_item which was removed
            foreach($listOldBook as $row)
            {
                if (in_array($row, $listOrderItem) == false) {
                    $book_item = $bookItemRepository->update([
                        'status'    => 0,
                    ],(int) $row, //$row,
                    "id");
                }
            };

            $this->obj_order_item->deleteItem($order->id);
            foreach($listOrderItem as $row)
            {
                $order_item = $orderItemRepository->create([
                'order_id'      => $order->id,
                'book_item_id'  => $row, // or $row with list id
                'status'        => 1,
                ]);
            
                $book_item = $bookItemRepository->update([
                    'status'    => 1,
                ]
                ,(int) $row//$row
                ,"id");
                
            }   
            return redirect('/orders')->with('notify-success', 'Sua order thành công');
        }
    }

    public function updateReturnBook(Request $request)
    {
       $id = $request->id;
       $order = Order::find((int) $id);
        $order->return_date = date('Y-m-d h:i:s');
        $order->status = 1;
        $order->save();

        $item_orders = $this->obj_order_item->getItemByOrderID($order->id);
        foreach ($item_orders as  $item) {
            $item->status = 0;
            $item->save();

            $book_item = BookItem::find((int) $item->book_item_id);
            $book_item->status = 0;
            $book_item->save();
        }
        return redirect('/orders')->with('notify-success', 'Sua order thành công');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $obj = Order::find((int) $id);
        $obj->delete();
        //delete order item & update status
        $this->obj_order_item->deleteItemByOrderID($id);
        return redirect('/orders');
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
                $book = Book::where('title','like', "%".$query."%")->first();  
                $data = $book->bookItems()->where("status",0)->first();
                
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
                $name = BookItem::where('book_id',$data->book_id)->first()->book->title;
                    $output .= '
                    <tr>
                    <td>'. $name .'</td>
                    <td class="text-center">
                        <input type="checkbox" name="selectedBook" value="'.$data->id.'" title="'.$name.'">
                    </td>
                    </tr>
                    ';
                
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
               );
         
            //echo json_encode($data);
            return response()->json($data);
                
        }  
    }

    

}
