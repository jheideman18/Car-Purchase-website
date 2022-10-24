@extends('layouts.admin');

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Add Product</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('insert-product')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-4">
                    <select class="form-select" name ="cate_id">
                        <option value="">Select a Category</option>
                        @foreach ($category as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>

                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="car_name">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Type</label>
                    <input type="text" class="form-control" name="car_type">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea name="car_description" rows="3" class="form-control">

                    </textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Price</label>
                    <input type="number" class="form-control" name="car_price">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Quantity</label>
                    <input type="number" class="form-control" name="car_qty">
                </div>


                <div class="col-md-6 mb-2">
                    <label for="">Car Status</label>
                    <input type="checkbox"  name="car_status">
                </div>

                <div class="col-md-6 mb-2">
                    <label for="">Car Trending</label>
                    <input type="checkbox"  name="car_trending">
                </div>

                <div class="col-md-12">
                    <input type="file" class="form-control" name="image">
                </div>

                 <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>

            </div>

        </form>
    </div>
</div>

@endsection
