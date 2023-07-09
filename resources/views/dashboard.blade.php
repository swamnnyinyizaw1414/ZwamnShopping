@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- sidebar -->
        <div class="col-md-2">
            <ul class="list-group">
                <div class="mb-3">
                    <label for="">Category</label>
                    <a class="text-decoration-none" href="{{url('category/create')}}"><li class="list-group-item">Create Category</li></a>
                    <a class="text-decoration-none" href="{{url('category')}}"><li class="list-group-item">Category Lists</li></a>
                </div>
                <div class="mb-3">
                    <label for="">Product</label>
                    <a class="text-decoration-none" href="{{url('product/create')}}"><li class="list-group-item">Create Product</li></a>
                    <a class="text-decoration-none" href="{{url('product')}}"><li class="list-group-item">Product Lists</li></a>
                </div>
            </ul>
        </div>
        <!-- sidebar end -->
        <div class="col-md-10">
            @yield('dashboard-content')
        </div>
    </div>
</div>
@endsection
