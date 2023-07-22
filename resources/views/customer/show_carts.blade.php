@extends('customer.master')

@section('content')
    <div class="text-center my-5">
        <h2 class="text-primary">Cart</h2>
    </div>
    
    <div class="row">
        <div class="col-12">
            @if(session("status"))
                <div class="text-center">
                    <p class="alert alert-success">{{session("status")}}</p>
                </div>
            @endif
            
                <table class="table">
                    <thead>
                        <tr class="table-success text-center">
                            <th>Product</th>
                            <th>Price</th>
                            <th>Brand</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $totalPrice=0;
                        ?>
                        @foreach($carts as $cart)
                        <tr class="text-center">
                            <td>{{$cart->product_name}}</td>
                            @if($cart->discount_price!=null)
                            <td>${{$cart->discount_price}}</td>
                            @else
                            <td>${{$cart->price}}</td>
                            @endif
                            <td>{{$cart->brand}}</td>
                            <td>
                                {{$cart->quantity   }}
                            </td>
                            <td>
                                <div class="">
                                    <img src='{{asset("storage/$cart->image")}}' width="50" alt="">
                                </div>
                            </td>
                            <td>
                                <form action="{{url('destroy_cart',$cart->id)}}" method="post">
                                    @csrf
                                    @method("delete")
                                    <button class="btn btn-danger">Cancel</button>
                                </form>
                            </td>
                        </tr>

                        <?php 
                            if($cart->discount_price!=null){
                                $price=$cart->discount_price*$cart->quantity;
                                $totalPrice+=$price;
                            }else{
                                $price=$cart->price*$cart->quantity;
                                $totalPrice+=$price;
                            }
                        ?>

                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mx-5"><h5 class="">Total Price - ${{$totalPrice}}</h5></div>
                <hr>
                <div class="">
                    <div class="text-center">
                        <h4 class="text-primary">
                            Please submit your information
                        </h4>
                    </div>   
                    <form action="{{url('/cash_delivery')}}" method="post" class="">
                        @csrf
                        <div class="my-2 d-flex justify-content-center">
                            <div class="col-5">
                                <div class="form-group mb-3"> 
                                    <label for="">Email</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control" required>
                                    @error('email')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-3"> 
                                    <label for="">Phone</label>
                                    <input type="number" min="1" name="phone" value="{{old('phone')}}" class="form-control" required>
                                    @error('phone')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-3"> 
                                    <label for="">Address</label>
                                    <textarea name="address" class="form-control" required id="" cols="10" rows="5">{{old('address')}}</textarea> 
                                    @error('address')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <button class="btn btn-success mb-3">Cash on delivery</button>
                                <button class="btn btn-warning mb-3">Pay with card</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
    
@endsection