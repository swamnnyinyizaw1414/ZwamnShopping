<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::latest()->filter(request(['search','category']))->paginate(5)->withQueryString();
        $categories=Category::all();
        $currentCategory=Category::firstWhere("slug",request("category"));
        return view("product.index",compact("products","categories","currentCategory"));
    }

    public function customerProducts(){
        $products=Product::latest()->filter(request(['brand','gender']))->paginate(6)->withQueryString();
        $brands=Brand::all();
        $currentBrand=Brand::firstWhere("slug",request("brand"));
        $genders=Category::all();
        $currentGender=Category::firstWhere("slug",request("gender"));
        return view('customer.products',compact('products','brands','currentBrand','genders','currentGender'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        $brands=Brand::all();
        return view('product.create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>["required","min:3","max:100"],
            "slug"=>["required",Rule::unique('products')],
            "price"=>["required","numeric","min:1"],
            "discount_price"=>["nullable","numeric","min:1"],
            "quantity"=>["required","numeric","min:1"],
            "category_id"=>["required",Rule::exists("categories","id")],
            "brand_id"=>["required",Rule::exists("brands","id")],
            "photo"=>["required","file","mimes:jpeg,jpg,webp,png","max:512"]
        ]);

        $product=new Product();
        $product->name=$request->name;
        $product->slug=$request->slug;
        $product->price=$request->price;
        $product->discount_price=$request->discount_price;
        $product->quantity=$request->quantity;
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        if($request->file("photo")!=null){
            $product->photo=$request->file("photo")->store("product_photos");
        }
        $product->user_id=Auth::id();
        $product->save();
        return redirect()->back()->with("status","A new product is created successfully...");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product=Product::find($id);
        $categories=Category::all();
        $brands=Brand::all();
        return view("product.edit",compact('product','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product=Product::find($id);
        $request->validate([
            "name"=>["required","min:3","max:100"],
            "slug"=>["required",Rule::unique('products')->ignore($product->id)],
            "price"=>["required","numeric","min:1"],
            "discount_price"=>["nullable","numeric","min:1"],
            "quantity"=>["required","numeric","min:1"],
            "photo"=>["nullable","file","mimes:jpeg,jpg,webp,png","max:512"],
            "category_id"=>["required",Rule::exists("categories","id")],
            "category_id"=>["required",Rule::exists("categories","id")],
        ]);
        
        $product->name=$request->name;
        $product->slug=$request->slug;
        $product->price=$request->price;
        $product->discount_price=$request->discount_price;
        $product->quantity=$request->quantity;
        if($request->file("photo")!=null){
            $product->photo=$request->file("photo")->store("product_photos");
        }
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->user_id=Auth::id();
        $product->save();

        return redirect(url('/product'))->with("status","A product is updated successfully...");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product=Product::find($id);        
        $product->delete();
        return redirect()->back()->with("status","A product is deleted...");
    }

    public function order(Request $request){
        $start=$request->start;
        $end=$request->end;
        $orders=Order::when(request(['start','end']),function($query) use ($start,$end){
            $query->whereDate('created_at','<=',$end)
            ->whereDate('created_at','>=',$start);
        })->latest()->paginate(8)->withQueryString();
        $users=User::all();
        return view('order.index',compact('orders','users'));
    }

    // public function delete_order($id){
    //     $order=Order::find($id);
    //     $order->delete();
    //     return redirect()->back()->with('status',"You deleted an order...");
    // }

    // public function edit_order($id){
    //     $order=Order::find($id);
    //     return view('order.edit',compact('order'));
    // }

    public function order_confirmed($id){
        $order=Order::find($id);
        $order->is_confirmed="1";
        $order->save();
        return redirect()->back();
    }

    public function delivered($id){
        $order=Order::find($id);
        $order->delivery_status="Delivered";
        $order->save();
        return redirect()->back();
    }

}
