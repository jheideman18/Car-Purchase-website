@extends('layouts.admin');

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Update Product</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('update-product/'.$product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12 mb-4">
                    <select class="form-select" name ="cate_id">
                        <option value="">{{$product->category->name}}</option>
                      </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Name</label>
                    <input type="text" value="{{$product->car_name}}" class="form-control" name="car_name">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Type</label>
                    <input type="text"value="{{$product->car_type}}"  class="form-control" name="car_type">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea name="car_description" rows="3" class="form-control">
                        {{$product->car_description}}
                    </textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Price</label>
                    <input type="number" value="{{$product->car_price}}" class="form-control" name="car_price">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Quantity</label>
                    <input type="number" value="{{$product->car_qty}}" class="form-control" name="car_qty">
                </div>


                <div class="col-md-6 mb-2">
                    <label for="">Car Status</label>
                    <input type="checkbox" {{$product->car_status == '1'?'checked':''}} name="car_status">
                </div>

                <div class="col-md-6 mb-2">
                    <label for="">Car Trending</label>
                    <input type="checkbox" {{$product->car_trending == '1'?'checked':''}} name="car_trending">
                </div>

                @if($product->image)
                <img src="{{asset('assets/uploads/products/'.$product->image)}}" width="30%">
                @endif
                <div class="col-md-12">
                    <input type="file" class="form-control" name="image">
                </div>

                 <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection
