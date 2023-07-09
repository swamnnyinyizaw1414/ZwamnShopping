@extends('customer.master')

@section('content')
    <div class="text-center my-5">
        <h2 class="text-primary">Cart</h2>
    </div>
    
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr class="table-success text-center">
                        <th>Product</th>
                        <th>Price</th>
                        <th>Discount_price</th>
                        <th>Brand</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                    <tr class="text-center">
                        <td>{{$cart->product_name}}</td>
                        <td>${{$cart->price}}</td>
                        @if($cart->discount_price!=null)
                        <td>${{$cart->discount_price}}</td>
                        @else
                        <td><div class="badge badge-info bg-info">No Discount</div></td>
                        @endif
                        <td>{{$cart->brand}}</td>
                        <td>{{$cart->quantity}}</td>
                        <td>
                            <div class="">
                                <img src='{{asset("storage/$cart->image")}}' width="50" alt="">
                            </div>
                        </td>
                        <td>
                            <form action="" method="post">
                                @csrf
                                @method("delete")
                                <button class="btn btn-danger">Cancel</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection