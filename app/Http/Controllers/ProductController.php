<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
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
    public function sort(Request $request, $id, $sort){
        $request->session()->flash('sort', $sort);
        return redirect()->route('catalog', ['id'=>$id]);
    }

    public function catalog(Request $request)
    {
        $this->auth_user();

        if($request->session()->get('sort')=='name'){
            $product = Product::with('category')->where('qty', '!=', 0)->orderBy('name', 'DESC')->get();

        }
        elseif($request->session()->get('sort')=='price'){
            $product = Product::with('category')->where('qty', '!=', 0)->orderBy('price', 'ASC')->get();
        }
        else{
            $product = Product::with('category')->where('qty', '!=', 0)->latest()->get();
        }

        // $product = Product::where('qty','!=',0)->get();
        $this->auth_user();
        if(Auth::check()){
            $category = Category::all();
           $data = (object)[
            'product'=>$product,
            'role'=>$this->user_role,
            'category'=>$category
        ];
      
        return view('product.products')->with(['data'=>$data]);  
        }
        else{
            return redirect()->route('index')->with('auths','Нет доступа');
        }
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    $this->auth_user();
        $data=(object)[
          'role'=>$this->user_role
        ];
        $category = Category::all();
        return view('product.create')->with(['category'=>$category,'data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:125'],
            'price' => 'required',
            'qty' => 'required',
            'description' => 'nullable',
            'category_id' => 'required'
        ]);
        if($validator->fails()){
        return redirect() -> route('products.create')->with('success', 'Ошибки при заполнении формы');
        }else{
          $image_name = time() . '.' . $request->file('image')->extension();
            $path = 'images/products/';
            $request->file('image')->move(public_path($path), $image_name);
            Product::create([
                'image'=>$path . $image_name
            ]+$validator->validated());
            return redirect() -> route('catalog')->with('success', 'Товар добавлен');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {   
        $this->auth_user();
        $product = Product::find($id);
        $category = Category::find($product->category_id)->name;
        $data=(object)[
            'id' =>$product->id,
            'name' =>$product->name,
            'price' =>$product->price,
            'image' => $product->image,
            'description' =>$product->description,
            'category' =>$product->category->name,
            'role'=>$this->user_role
        ];
        return view('product.show')->with(['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $this->auth_user();
        $data=(object)[
          'role'=>$this->user_role
        ];
        $pro = Product::find($id);
        $category = Category::all();
        return view('product.edit',compact('pro'))->with(['category'=>$category,'data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
        'name' => ['required', 'max:125'],
        'price' => 'required',
        'qty' => 'required',
        'image' => 'nullable|file|mimes:png,jpg,jpeg',
        'description' => 'nullable',
        'category_id' => 'nullable'
    ]);

    if ($validator->fails()) {
        return redirect()->route('products.edit', $product->id)->withErrors($validator)->withInput();
    } else {
        if ($request->hasFile('image')) {
            $image_name = time() . '.' . $request->file('image')->extension();
            $path = 'images/products/';
            $request->file('image')->move(public_path($path), $image_name);
            $product->update([
                'image' => $path . $image_name
            ] + $validator->validated());
        } else {
            $product->update($validator->validated());
        }

        return redirect()->route('products.catalog')->with('success', 'Товар изменен');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect() -> route('products.catalog')->with('success', 'Товар удален');
    }
    
    public function cart(Request $request){
        $productId=$request->input('product_id');
        $product =Product::find($productId);

        $this->auth_user();
        $cart = $request->session()->get('cart', []);
        $cart[$productId] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'description' => $product->description,
            'category' => $product->category->name,
        ];
    
       
        $request->session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Товар добавлен в корзину');

    }
    public function viewCart(Request $request) {
        $cart = $request->session()->get('cart', []);
        $this->auth_user();
        $data=(object)[
          'role'=>$this->user_role
        ];
    
        return view('product.cart')->with(['cart' => $cart,'data'=>$data]);
    }
    public function clearCart(Request $request) {
    
   
        $request->session()->forget('cart');
        
            return redirect()->route('cart.view')->with('success', 'Корзина очищена');
    }
    public function checkout(Request $request) {
        $cart = $request->session()->get('cart', []);
    
        foreach ($cart as $productId => $item) {
            
            $product = Product::find($productId);
    
       
            if ($product && $product->qty >= 1) {
               
                $product->decrement('qty');

                $product->save();
            } else {
                return redirect()->route('cart.view')->with('success', 'К сожалению товар закончился');
            }
        }
        $request->session()->forget('cart');
    
        return redirect()->route('cart.view')->with('success', 'Покупка завершена');
    }
}
