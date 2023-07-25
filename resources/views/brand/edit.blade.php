@extends('dashboard')

@section('dashboard-content')
    @if(session('status'))
        <p class="alert alert-info">{{session('status')}}</p>
    @endif
    <div class="card">
        <div class="card-body">
            <h1 class="font-weight-bold">Update Brand</h1>
            <hr>
            <form action="{{url('/brand/update',$brand->id)}}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" value="{{old('name',$brand->name)}}" id="name" name="name">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" value="{{old('slug',$brand->slug)}}" id="slug" name="slug">
                    @error('slug')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
