<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Book;
use App\Models\BookItem;
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

    public function postCreate(Request $request,OrderRepository $orderRepository,
    BookItemRepository $bookItemRepository,OrderItemRepository $orderItemRepository)
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

            $order = $orderRepository->create(
                [
                "borrower_id"          =>$user_id, 
                "status"               => 0,
                "order_date"           => date('Y-m-d h:i:s'),
                "return_date"          => null,
                "expired"              => date('Y-m-d h:i:s', strtotime("+10 day")), 
                ]);
            
            foreach($listOrderItem as $row)
            {
                $order_item = $orderItemRepository->create([
                'order_id'      => $order->id,
                'book_copy_id'  => $row->id , // or $row with list id
                'status'        => 0,
                ]);
            
                $book_item = $bookItemRepository->update([
                    'status'    => 1,
                ]
                ,(int) $row->id //$row
                ,"id");
            }   
            return redirect('/orders')->with('notify-success', 'Thêm order thành công');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $order = Order::find((int) $id);
        return view('admin.order.edit',['order' => $order]);
    }

    public function update(Request $request,OrderRepository $orderRepository,
    BookItemRepository $bookItemRepository,OrderItemRepository $orderItemRepository)
    {
        $id = $request->id;
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
            $order = $orderRepository->update([
                'borrower_id' => $user_id,
            ]);
            //luu y update status sach da remove => 1
            foreach($listBookRemoved as $row)
            {
                $book_item = $bookItemRepository->update([
                    'status'    => 0,
                ],(int) $row->id, //$row,
                "id");
            };

            foreach($listOrderItem as $row)
            {
                $order_item = $orderItemRepository->create([
                'order_id'      => $order->id,
                'book_copy_id'  => $row->id , // or $row with list id
                'status'        => 0,
                ]);
            
                $book_item = $bookItemRepository->update([
                    'status'    => 1,
                ]
                ,(int) $row->id //$row
                ,"id");
            }   
            return redirect('/orders')->with('notify-success', 'Sua order thành công');
        }
    }

    public function updateReturnBook(Request $request, OrderRepository $orderRepository)
    {
       $id = $request->id;
       $orderRepository->update(
           [
               "return_date"    => date('Y-m-d h:i:s'),
               "status"         => 1
           ],
           (int) $id,
           "id"
        );
        return redirect('/orders')->with('notify-success', 'Sua order thành công');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $obj = Order::find((int) $id);
        $obj->delete();
        return redirect('/books');
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
         
            //echo json_encode($data);
            return response()->json($data);
                
        }  
    }

    

}
