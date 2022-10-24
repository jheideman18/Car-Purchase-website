@extends('layouts.admin');

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Products</h4>
        <hr>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                <th>Id</th>
                <th>Category</th>
                <th>Name</th>
                <th>Type</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td >{{$item->category->name}}</td>
                    <td>{{$item->car_name}}</td>
                    <td>{{$item->car_type}}</td>
                    <td>{{$item->car_description}}</td>
                    <td>R{{$item->car_price}}</td>
                    <td>{{$item->car_qty}}</td>
                    <td><img src="{{asset('assets/uploads/products/'.$item->image)}}" class="cate-img" height="auto" alt="">
                    </td>
                    <td>
                        <a href="{{url('edit-product/'.$item->id)}}" class="btn btn-primary">Edit</a>

                        <a href="{{url('delete-product/'.$item->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection
