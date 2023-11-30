<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public $user_id;
    public $user_role;

    public function auth_user(){
      if(Auth::check())
      {
        $user= Auth::user();
        $this->user_id=$user->id;
        $this->user_role=$user->role;
      }
      else{
        $this->user_role='guest';
      }
    }

    public function index()
    {   $category = Category::all(); 
        $this->auth_user();
        if(Auth::check()){
           $data = (object)[
            'category' => $category,
            'role'=>$this->user_role
        ];
        return view('category.categories')->with(['data'=>$data]);
        }else{
            return redirect()->route('index')->with('auths','Нет доступа');
        }
    }

    public function create()
    {   $this->auth_user();
        $data=(object)[
          'role'=>$this->user_role
        ];
        $category = Category::all();
        return view('category.create')->with(['category'=>$category,'data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:125'],
        ]);
        if($validator->fails()){
        return redirect() -> route('categories.create')->with('success', 'Ошибки при заполнении формы');
        }else{
            Category::create($validator->validated());
            return redirect() -> route('categories.index')->with('success', 'Категория добавлена');
        }
    }

    public function show($id)
    {   $this->auth_user();
        $product = Product::with('category')->where('category_id', '=', $id)->get();
        $data =(object)[
            'product' => $product,
            'role'=>$this->user_role,
        ];
        return view('category.show')->with(['data'=>$data]);
    }

    public function edit(string $id)
    {   $this->auth_user();
        $data=(object)[
          'role'=>$this->user_role
        ];
        $pro = Category::find($id);
        return view('category.edit',compact('pro'))->with(['data'=>$data]);
    }

  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return redirect() -> route('categories.index')->with('success', 'Товар Изменен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect() -> route('categories.index')->with('success', 'Товар удален');
    }
}
