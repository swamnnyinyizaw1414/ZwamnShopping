@extends('customer.master')

@section('content')
    <div class="text-center my-5">
        <h2 class="text-primary">Products</h2>
    </div>
    <div class="row justify-content-center">
        @forelse($products as $p)
        <div class="col-3 m-3 card p-3 bg-white shadow">
            <div class="card-body">
                <div class="text-center" style="width: 100%; height: 50%;">
                    <img width="100%" height="100%" class="my-3" src='{{asset("storage/$p->photo")}}' alt="">
                </div>
                <div class="mt-5" >
                    <div class="">Product - <span class="">{{$p->name}}</span></div>
                    <div class="">Category - <span class="badge badge-primary bg-primary">{{$p->category->name}}</span></div>
                    <div>
                        @if($p->discount_price!=null)
                        <div>
                            Price - 
                            <span class="" style="text-decoration: line-through;">${{$p->price}}</span>
                            <span class="text-success">${{$p->discount_price}}</span>
                        </div>   
                        @else
                        <span>Price - ${{$p->price}}</span>
                        @endif
                    </div>
                    <div class="">
                        <button class="btn btn-info btn-sm my-2">Detail</button>
                        <form action="{{url('add_to_cart',$p->id)}}" method="post">
                            @csrf
                            <div class="d-flex">
                                <input type="number" class="form-control me-2" name="quantity" value=1>
                                <button class="btn btn-warning text-nowrap btn-sm">Add to cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center">
            <h4 class="text-info">There is no products yet...</h4>
        </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-end mb-5">{{$products->links()}}</div>
@endsection