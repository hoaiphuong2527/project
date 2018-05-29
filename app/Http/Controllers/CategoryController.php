<?php


namespace App\Http\Controllers;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request,CategoryRepository $categoryRepository)
    {
        $name = $request->input('name');

        $search_query = Category::query(); 

        if($name)
        {
            $search_query->where('name', 'like', '%'.$name.'%');
        }

        $categories = $categoryRepository->getAll($search_query);

        return view('admin.categories.index',['categories' => $categories,
        'name' => $name]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function postCreate(Request $request,CategoryRepository $categoryRepository)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'                  => 'required|min:6|max:30|unique:categories,name',
            ]
            ,
            [
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $name       = $request->input('name');
            $user = $categoryRepository->create(
                [
                "name"          =>$name, 
                ]);
            
            return redirect('/categories')->with('notify-success', 'Thêm cate thành công');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $cate = new Category();
        return view('admin.categories.edit', ['cate' => $cate->findCate((int) $id)]);

    }

    public function update(Request $request,CategoryRepository $categoryRepository)
    {
        $id = $request->id;
        $validator = Validator::make(
            $request->all(),
            [
                'name'                  => 'required|min:6|max:30|unique:categories,name',
            ]
            ,
            [
            ]
        );
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $categoryRepository->update(
                [
                "name" => $request->get('name'),
                ], 
                (int) $id,
                "id"
                );
                return redirect('/categories')->with('notify-success', 'Sửa cate thành công');
        }
    }

    public function detroys(Request $request)
    {
        $id = $request->id;
        $user = new Category();
        $user->destroyCate((int) $id);
        return redirect('/categories');
    }
}
