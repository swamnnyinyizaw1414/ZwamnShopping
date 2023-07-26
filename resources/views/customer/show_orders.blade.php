@extends('customer.master')

@section('content')
    <div class="text-center my-5">
        <h2 class="text-primary">Order</h2>
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
                            <th>Customer</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Date</th>
                            <th>
                                Order Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($orders as $order)
                        <?php 
                            $totalPrice=0;
                        ?>
                        <tr class="text-center">
                            <td>{{$order->product}}</td>
                            <td>${{$order->price}}</td>
                            <td>{{$order->brand}}</td>
                            <td>
                                {{$order->quantity}}
                            </td>
                            <td>
                                <div class="">
                                    <img src='{{asset("storage/$order->product_image")}}' width="50" alt="">
                                </div>
                            </td>
                            <td>{{$customerName}}</td>
                            <td>{{$order->payment_status}}</td>
                            <td>{{$order->delivery_status}}</td>
                            <td>{{$order->created_at->format('Y-m-d H:i A')}}</td>
                            <td>
                                @if($order->is_confirmed=="0")
                                <form action="{{url('destroy_order',$order->id)}}" method="post">
                                    @csrf
                                    @method("delete")
                                    <button class="btn btn-danger">Cancel</button>
                                </form>
                                @else
                                Order Confirmed
                                @endif
                            </td>
                        </tr>

                        <?php 
                            if($order->discount_price!=null){
                                $price=$order->discount_price*$order->quantity;
                                $totalPrice+=$price;
                            }else{
                                $price=$order->price*$order->quantity;
                                $totalPrice+=$price;
                            }
                        ?>

                        @empty
                        <tr>
                            <td colspan="10">
                                <p class="text-danger fw-bold text-center mt-3">Thre is no order yet... </p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mx-5"><h5 class="">Total Price - ${{$totalPrice}}</h5></div>
                <div class="">{{$orders->links()}}</div>
        </div>
    </div>
    
@endsection