@extends('dashboard')

@section('dashboard-content')
    @if(session('status'))
        <p class="alert alert-info">{{session('status')}}</p>
    @endif
    <div class="card">
        <div class="card-body">
            <h1 class="font-weight-bold">Create Category</h1>
            <hr>
            <form action="{{url('/category/store')}}" method="post">
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
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
