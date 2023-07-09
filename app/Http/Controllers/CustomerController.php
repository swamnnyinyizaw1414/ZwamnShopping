<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule as ValidationRule;

class CustomerController extends Controller
{
    public function products(){
        $products=Product::latest()->paginate(6)->withQueryString();
        return view('customer.products',compact('products'));
    }
    
    public function add_to_cart(Request $request,$id){
        $cart=new Cart();
        $product=Product::find($id);
        $cart->product_name=$product->name;
        $cart->price=$product->price;
        $cart->discount_price=$product->discount_price;
        $cart->brand=$product->brand;
        $cart->quantity=$request->quantity;
        $cart->image=$product->photo;
        $cart->save();
        return redirect()->back()->with("status","You added a product in the cat");
    }

    public function show_carts(){
        $carts=Cart::latest()->paginate(6)->withQueryString();
        return view("customer.show_carts",compact('carts'));
    }
}
