<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request, UserRepository $userRepository )
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');

        $search_query = User::query();

        if($name)
        {
            $search_query->Where('name', 'like', '%'.$name.'%');
        }
        if($email)
        {
            $search_query->Where('email', 'like', '%'.$email.'%');
        }
        if($phone)
        {
            $search_query->Where('phone', $phone);
        }

        $users = $userRepository->getAll($search_query);
        return view('admin.users.index',['users' => $users,
        'email' => $email,
        'name' => $name,
        'phone' => $phone,]);
    }

    public function getCreate()
    {
        $this->roles = config('admin-book.role');
        return view('admin.users.create',['roles' =>  $this->roles ]);
    }

    public function postCreate(Request $request, UserRepository $userRepository )
    {   
        $validator = Validator::make(
            $request->all(),
            [
                'email'                  => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/',
                'phone'                  => 'required|digits_between:10,15|numeric',
                'name'                   => 'required|min:6|max:30',
                'password'               => 'required|min:6|regex:/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/|confirmed',    
                'role'                   => 'required',
            ]
            ,
            [
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $email       = $request->input('email');
            $phone_num   = $request->input('phone');
            $name        = $request->input('name');
            $password    = Hash::make($request->input('password'));
            $user_role   = $request->input('role');
            $user = $userRepository->create(
                [
                "email"          =>$email, 
                "phone"          =>$phone_num, 
                "name"           =>$name,
                "password"       =>$password,  
                "user_role"      =>$user_role,
                ]);
            
            return redirect('/users')->with('notify-success', 'Thêm người dùng thành công');
        }
    }

    public function getEdit(Request $request)
    {
        $id = $request->id;
        $user = new User();
        $this->roles = config('admin-book.role');
        return view('admin.users.edit', ['user' => $user->findUser((int) $id), 'roles' =>  $this->roles]);
    }

    public function postEdit(Request $request, UserRepository $userRepository)
    {
        $id = $request->id;
        $user = new User();
        if($request->get('password') == '')
        {
            $validator = Validator::make($request->all(), [
                'phone'                 => 'required|digits_between:10,15|numeric',
                'name'                  => 'required|min:6|max:30',
                'role'                  => 'required',
                ],
                [
                ]);
    
            if ($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            else{
                $userRepository->update(
                    [
                    "phone" => $request->get('phone'),
                    "name" => $request->get('name'),
                    "user_role" => $request->get('role')
                    ], 
                    (int) $id,
                    "id"
                    );
                    return redirect('/users')->with('notify-success', 'Sửa người dùng thành công');
            }
        }else
        {
            //Trường hợp người dùng chỉnh sửa pass
            $validator = Validator::make($request->all(), [
                'password'          => 'required|min:6|regex:/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/|confirmed',
                'phone'             => 'required|digits_between:10,15|numeric',
                'name'              => 'required|min:6|max:30',
    
                ],
                [ 
                ]);
    
            if ($validator->fails())
            {
                return redirect()->back()->with('notify', $validator->errors()->first())->withInput();
            }
            else{

                $userRepository->update(
                    [
                    "phone" => $request->get('phone'),
                    "name" => $request->get('name'),
                    "user_role" => $request->get('role'),
                    "password"  =>  $request->get('password'),
                    ], 
                    (int) $id,
                    "id"
                    );
                    return redirect('/users')->with('notify-success', 'Sửa người dùng thành công');
            }
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $user = new User();
        $user->destroyUser((int) $id);
        return redirect('/users');
    }

    public function detail(Request $request, UserRepository $userRepository)
    {
       $id = $request->id;
       $user = new User();
        $this->roles = config('admin-book.role');
        return view('admin.users.detail', ['user' => $user->findUser((int) $id), 'roles' =>  $this->roles]);
    }
}
