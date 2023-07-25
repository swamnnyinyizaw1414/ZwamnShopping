@extends('dashboard')

@section('dashboard-content')
    @if(session('status'))
        <p class="alert alert-info">{{session('status')}}</p>
    @endif
    <div class="card">
        <div class="card-body">
            <h1 class="font-weight-bold">Create Product</h1>
            <hr>
            <form action="{{url('/product')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" value="{{old('name')}}" id="name" name="name">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" value="{{old('slug')}}" id="slug" name="slug">
                    @error('slug')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" min="0" class="form-control" value="{{old('price')}}" id="price" name="price">
                    @error('price')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="discount_price" class="form-label">Discount Price</label>
                    <input type="number" min="0" class="form-control" value="{{old('discount_price')}}" id="discount_price" name="discount_price">
                    @error('discount_price')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" min="0" class="form-control" value="{{old('quantity')}}" id="quantity" name="quantity">
                    @error('quantity')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Category</label>
                    <select name="category_id" class="form-select" id="">
                        @foreach($categories as $c)
                        <option {{$c->id==old("category_id")? 'selected' : ''}} value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Brand</label>
                    <select name="brand_id" class="form-select" id="">
                        @foreach($brands as $b)
                        <option {{$b->id==old("brand_id")? 'selected' : ''}} value="{{$b->id}}">{{$b->name}}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control" value="{{old('photo')}}" id="photo" name="photo">
                    @error('photo')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection