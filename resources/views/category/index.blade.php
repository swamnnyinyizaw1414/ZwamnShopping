@extends('dashboard')

@section('dashboard-content')
    @if(session('status'))
        <div class="alert alert-info">
            {{session('status')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <h1 class="font-weight-bold">Category Lists</h1>
            <hr>
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Created_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr class="text-center">
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td>{{$category->created_at->format('Y-m-d | H:i A')}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <form action="{{url('/category/delete',$category->id)}}" class="me-1" method="post">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Are you sure want to delete?')" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="{{url('/category/edit',$category->id)}}" class="btn btn-warning btn-sm">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
