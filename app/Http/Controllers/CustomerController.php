<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule as ValidationRule;

class CustomerController extends Controller
{
    // public function products(){
        
    // }
    
    public function add_to_cart(Request $request,$id){
        if(!auth()->user()){
            return redirect(url("/register"))->with("status","Please register or login first to buy products");
        }
        $cart=new Cart();
        $product=Product::find($id);
        $request->validate([
            "product_name"=>'unique:carts'
        ]);
        $cart->product_name=$request->product_name;
        $cart->price=$product->price;
        $cart->discount_price=$product->discount_price;
        $cart->brand=$product->brand->name;
        $cart->quantity=$request->quantity;
        $cart->image=$product->photo;
        $cart->user_id=Auth::id();
        $cart->save();
        return redirect()->back()->with("status","You added a product in the cat");
    }

    public function show_carts(){
        $currentUserId=Auth::id();
        $carts=Cart::where("user_id",$currentUserId)->latest()->paginate(6)->withQueryString();
        return view("customer.show_carts",compact('carts'));
    }

    public function destroy_cart($id){
        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back()->with("status","You cancelled this product...");
    }

    public function cash_delivery(Request $request){
        $carts=Cart::where("user_id",Auth::id())->get();
        $request->validate([
            "phone"=>["required","numeric"],
            "address"=>["required"]
        ]);
        foreach($carts as $cart){
            $order=new Order();
            $order->product=$cart->product_name;
            $order->brand=$cart->brand;
            $order->quantity=$cart->quantity;
            if($cart->discount_price!=null){
                $price=$cart->discount_price;
            }else{
                $price=$cart->price;
            }
            $order->price=$price;
            $order->product_image=$cart->image;
            $order->email=Auth::user()->email;
            $order->address=$request->address;
            $order->phone=$request->phone;
            $order->user_id=Auth::id();
            $order->payment_status="Cash on delivery";
            $order->delivery_status="Processing";
            $order->save();

            $cart_id=$cart->id;
            $cart=Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with("status","We've received your order. We will contact you later.");
    }

    public function show_orders(){
        $currentUserId=Auth::user()->id;
        $customerName=User::find($currentUserId)->name;
        $orders=Order::where("user_id",$currentUserId)->latest()->paginate(8)->withQueryString();
        return view('customer.show_orders',compact('orders','customerName'));
    }

    public function destroy_order($id){
        $order=Order::find($id);
        $order->delete();
        return redirect()->back()->with("status","You cancelled this order...");
    }

}
