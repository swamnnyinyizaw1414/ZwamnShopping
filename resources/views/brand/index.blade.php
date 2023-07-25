@extends('dashboard')

@section('dashboard-content')
    @if(session('status'))
        <div class="alert alert-info">
            {{session('status')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <h1 class="font-weight-bold">Brand Lists</h1>
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
                    @foreach($brands as $brand)
                    <tr class="text-center">
                        <td>{{$brand->id}}</td>
                        <td>{{$brand->name}}</td>
                        <td>{{$brand->slug}}</td>
                        <td>{{$brand->created_at->format('Y-m-d | H:i A')}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <form action="{{url('/brand/delete',$brand->id)}}" class="me-1" method="post">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Are you sure want to delete?')" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="{{url('/brand/edit',$brand->id)}}" class="btn btn-warning btn-sm">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
