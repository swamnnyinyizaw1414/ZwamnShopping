@extends('dashboard')

@section('dashboard-content')
    @if(session('status'))
        <p class="alert alert-info">{{session('status')}}</p>
    @endif
    <div class="card">
        <div class="card-body">
            <h1 class="font-weight-bold">Update Product</h1>
            <hr>
            <form action="{{url('/product',$product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" value="{{old('name',$product->name)}}" id="name" name="name">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" value="{{old('slug',$product->slug)}}" id="slug" name="slug">
                    @error('slug')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" min="0" class="form-control" value="{{old('price',$product->price)}}" id="price" name="price">
                    @error('price')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="discount_price" class="form-label">Discount Price</label>
                    <input type="number" min="0" class="form-control" value="{{old('discount_price',$product->discount_price)}}" id="discount_price" name="discount_price">
                    @error('discount_price')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" min="0" class="form-control" value="{{old('quantity',$product->quantity)}}" id="quantity" name="quantity">
                    @error('quantity')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-1">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control" value="{{old('photo',$product->photo)}}" id="photo" name="photo">
                    @error('photo')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <img src='{{asset("storage/$product->photo")}}' width="80" alt="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Brand</label>
                    <select name="brand_id" class="form-select" id="">
                        @foreach($brands as $b)
                        <option {{$b->id==old("brand_id") || $b->id==$product->brand_id ? 'selected' : ''}} value="{{$b->id}}">{{$b->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Category</label>
                    <select name="category_id" class="form-select" id="">
                        @foreach($categories as $c)
                        <option {{$c->id==old("category_id") || $c->id==$product->category_id ? 'selected' : ''}} value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection