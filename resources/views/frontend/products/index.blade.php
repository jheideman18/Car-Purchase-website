@extends('layouts.frontend')
@section('title')
{{$category->name}}
@endsection

@section('content')
<div class="py-3 mb-3 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            Showroom / {{$category->name}}
        </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <h2 >{{$category->name}}</h2>
                @foreach ($products as $prod)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <a href="{{url('category/'.$category->slug.'/'.$prod->car_name)}}">
                    <img src="{{asset('assets/uploads/products/'.$prod->image)}}" width="100%" alt="Product image">
                    <div class="card-body">
                        <h5>{{$prod->car_name}}</h5>
                        <small>From R{{$prod->car_price}}</small>
                    </div>
                </a>
                </div>
                </div>
                @endforeach
        </div>
    </div>
</div>
@endsection
