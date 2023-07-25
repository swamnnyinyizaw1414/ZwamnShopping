@extends('dashboard')

@section('dashboard-content')
    @if(session('status'))
        <div class="alert alert-info">
            {{session('status')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <h1 class="font-weight-bold">Product Lists</h1>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{isset($currentCategory)? $currentCategory->name : "Filter By Category"}}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/product">All</a></li>
                    @foreach($categories as $category)
                    <li><a class="dropdown-item" href="?category={{$category->slug}} {{request('search')? '&search='.request('search') : '' }} ">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </div>
                <form action="?search={{request('search')}}">
                    <div class="d-flex"> 
                        @if(request("category"))
                        <input type="hidden" name="category" value="{{request('category')}}">
                        @endif
                        <input type="text" class="form-control me-1" name="search">
                        <button class="btn btn-secondary" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <hr>
            <table class="table" style="display: block; overflow-x: auto; white-space: nowrap;">
                <thead>
                    <tr class="text-nowrap text-center">
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Price</th>
                        <th>Discount Price</th>
                        <th>Quantity</th>
                        <th>Brand</th>
                        <th>Photo</th>
                        <th>Category</th>
                        <th>User</th>
                        <th>Created_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="text-center">
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->slug}}</td>
                        <td>${{$product->price}}</td>
                        @if($product->discount_price!=null)
                        <td>${{$product->discount_price}}</td>
                        @else
                        <td><p class="badge badge-info bg-info">No discount</p></td>
                        @endif
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->brand->name}}</td>
                        <td>
                            <img src='{{asset("storage/$product->photo")}}' width="50" alt="">
                        </td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->user->name}}</td>
                        <td>{{$product->created_at->format('Y-m-d | H:i A')}}</td>
                        <td>
                            <div class="d-flex">
                                <form action="{{url('/product',$product->id)}}" class="me-1" method="post">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Are you sure want to delete?')" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href='{{url("product/$product->id/edit")}}' class="btn btn-warning btn-sm">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{$products->links()}}
            </div>
        </div>
    </div>
@endsection
