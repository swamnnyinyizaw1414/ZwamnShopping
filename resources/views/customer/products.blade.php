@extends('customer.master')

@section('content')
    <div class="text-center my-5">
        <h2 class="text-primary fw-bold ">Products</h2>

        <div class="d-flex justify-content-end">
            <div class="dropdown me-1">
                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{isset($currentBrand)? $currentBrand->name : "Filter By Brand"}}
                </button>
                <ul class="dropdown-menu">
                    @foreach($brands as $brand)
                    <li>
                        <a class="dropdown-item" href="?brand={{$brand->slug}} {{request('gender')? '&gender='.request('gender') : ''}}">{{$brand->name}}</a>
                    </li>
                    @endforeach
                    <li>
                        <a class="dropdown-item" href="/products">All</a>
                    </li>
                </ul>
            </div>

            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{isset($currentGender)? $currentGender->name : "Filter By Gender"}}
                </button>
                <ul class="dropdown-menu">
                    @foreach($genders as $gender)
                    <li>
                        <a class="dropdown-item" href="?gender={{$gender->slug}} {{request('brand')? '&brand='.request('brand') : ''}}">{{$gender->name}}</a>
                    </li>
                    @endforeach
                    <li>
                        <a class="dropdown-item" href="/products">All</a>
                    </li>
                </ul>
            </div>
        </div>

        @error("product_name")
            <p class="alert alert-info">You've already added that product...</p>
        @enderror
    </div>
    <div class="row justify-content-center">    
        @forelse($products as $p)
        <div class="col-3 card bg-white mx-2 my-3">
            <div class="card-body">
                <div class="text-center">
                    <img width="80%" class="" src='{{asset("storage/$p->photo")}}' alt="">
                </div>
                <div class="" >
                    <div class="">Product - <span class="">{{$p->name}}</span></div>
                    <div class="">Category - <span class="badge badge-primary bg-primary">{{$p->category->name}}</span></div>
                    <div>
                        @if($p->discount_price!=null)
                        <div>
                            Price - 
                            <span class="" style="text-decoration: line-through;">${{$p->price}}</span>
                            <span class="text-danger fw-bold">${{$p->discount_price}}</span>
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
                                <input type="hidden" name="product_name" value="{{$p->name}}">
                                <input type="number" class="form-control me-2" min="1" name="quantity" value=1> 
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