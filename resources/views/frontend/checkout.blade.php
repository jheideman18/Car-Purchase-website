@extends('layouts.frontend')
@section('title')
    Checkout
@endsection

@section('content')
<div class="py-3 mb-3 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">
                Home
            </a>/
            <a href="{{url('checkout')}}">
               Checkout
            </a>

        </h6>
    </div>
</div>

<div class="container mt-3">
    <form action="{{url('place-order')}}" method="POST">
        {{csrf_field()}}
        <div class="row">
                <div class="col-md-7">
                    <div class="card">
                    <div class="card-body">
                        <h6>Basic Details</h6>
                        <hr>
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" value="{{Auth::user()->name}}" name ="fname" placeholder="Enter First Name">
                            </div>
                            <div class="col-md-6">
                                <label for="firstName">Last Name</label>
                                <input type="text" class="form-control"value="{{Auth::user()->lname}}"  name ="lname"  placeholder="Enter Last Name">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="firstName">Email</label>
                                <input type="text" class="form-control" value="{{Auth::user()->email}}" name ="email" placeholder="Enter Email">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="firstName">Phone Number</label>
                                <input type="text" class="form-control" value="{{Auth::user()->phone}}" name ="phone" placeholder="Enter Phone Number">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="firstName">Address 1</label>
                                <input type="text" class="form-control" value="{{Auth::user()->address1}}" name ="address1" placeholder="Enter Address 1">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="firstName">Address 2<small>(Optional)</small></label>
                                <input type="text" class="form-control" value="{{Auth::user()->address2}}" name ="address2" placeholder="Enter Address 2">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="firstName">City</label>
                                <input type="text" class="form-control" value="{{Auth::user()->city}}" name ="city"  placeholder="Enter City">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="firstName">Province</label>
                                <input type="text" class="form-control" value="{{Auth::user()->province}}" name ="province" placeholder="Enter Province">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="firstName">Country</label>
                                <input type="text" class="form-control" value="{{Auth::user()->country}}" name ="country" placeholder="Enter Country">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="firstName">Street Code</label>
                                <input type="text" class="form-control" value="{{Auth::user()->streetcode}}" name ="streetcode" placeholder="Enter Pin Code">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6>Order Details</h6>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                                <th>Item Name</th>
                                <th>Item Price</th>
                            </thead>
                            <tbody>
                                @foreach($cartItem as $item)
                                <tr>
                                    <td>{{$item->products->car_name}}</td>
                                    <td>R{{$item->products->car_price}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <button type ="submit" class="btn btn-primary float-end">Place Order</button>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
