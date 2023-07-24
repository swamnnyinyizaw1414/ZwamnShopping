@extends('dashboard')

@section('dashboard-content')
    @if(session('status'))
        <div class="alert alert-info">
            {{session('status')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h1 class="font-weight-bold">Order Lists</h1>
                <div class="d-flex align-items-center">
                    <form action="{{url('order')}}" class="d-flex align-items-center">
                        <span class="me-1">From:</span><input type="date" class="form-control me-2" name="start" required>
                        <span class="me-1 ms-2">To:</span><input type="date" class="form-control" name="end" required> 
                        <button type="submit" class="btn btn-primary ms-2">Search</button>
                    </form>

                    <a href="{{url('/order')}}" class="btn btn-info ms-2">No Filter</a>
                </div>
            </div>
            <hr>
            <table class="table" style="display: block; overflow-x: auto; white-space: nowrap;">
                <thead>
                    <tr class="text-nowrap text-center">
                        <th>#</th>
                        <th>Product</th>
                        <th>Brand</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Photo</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Created_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr class="text-center">
                        <td>{{$order->id}}</td>
                        <td>{{$order->product}}</td>
                        <td>{{$order->brand}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>${{$order->price}}</td>
                        <td>
                            <img src='{{asset("storage/$order->product_image")}}' width="50" alt="">
                        </td>
                        <td>{{$users->find($order->user_id)->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->address}}</td>
                        <td>Cash on delivery</td>
                        <td>
                            @if($order->delivery_status=="Delivered")
                            Delivered
                            @else
                                Processing
                            @endif
                        </td>
                        <td>{{$order->created_at->format('Y-m-d | H:i A')}}</td>
                        <td>
                            <!-- <div class="d-flex">
                                <form action="{{url('/order',$order->id)}}" class="me-1" method="post">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Are you sure want to delete?')" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href='{{url("order/$order->id/edit")}}' class="btn btn-warning btn-sm">Edit</a>
                            </div> -->

                            @if($order->delivery_status=="Processing")
                            <form action="{{url('/delivered',$order->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success">Delivered</button>
                            </form>
                            @else
                            <p>Delivered</p>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="14" class="text-center text-danger fw-bold">There is no order...</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{$orders->links()}}
            </div>
        </div>
    </div>
@endsection
