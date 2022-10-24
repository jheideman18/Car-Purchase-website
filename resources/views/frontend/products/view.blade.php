@extends('layouts.frontend')
@section('title', $products->car_name)

@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{url('/add-rating')}}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{$products->id}}">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Rate {{$products->car_name}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="rating-css">
                <div class="star-icon">
                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                    <label for="rating1" class="fa fa-star"></label>
                    <input type="radio" value="2" name="product_rating" id="rating2">
                    <label for="rating2" class="fa fa-star"></label>
                    <input type="radio" value="3" name="product_rating" id="rating3">
                    <label for="rating3" class="fa fa-star"></label>
                    <input type="radio" value="4" name="product_rating" id="rating4">
                    <label for="rating4" class="fa fa-star"></label>
                    <input type="radio" value="5" name="product_rating" id="rating5">
                    <label for="rating5" class="fa fa-star"></label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>

<div class="py-3 mb-3 shadow-sm bg-primary bg-opacity-50 border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('category')}}">
                Showroom
            </a>/
            <a href="{{url('category')}}">
                {{$products->category->name}}
            </a>/
            <a href="{{url('category')}}">
                {{$products->car_name}}
            </a>
        </h6>
    </div>
</div>

<div class="container my-5 py-5 ">
    <div class=" product_data">
            <div class="">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{asset('assets/uploads/products/'.$products->image)}}" class="w-100" alt="">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{$products->car_name}}
                            @if($products->car_trending == '1')
                            <label style="font-size:16px;" class="float-end badge bg-danger trending_tag">Trending </label>
                            @endif
                        </h2>

                        <hr>

                        <label class="me-3"><b>Price: R{{$products->car_price}}</b></label>
                        @php $rateNum= number_format($rating_value)@endphp
                        <div class="rating">
                            @for($i =1; $i<=$rateNum; $i++)
                                <i class="fa fa-star checked"></i>
                            @endfor
                            @for($j = $rateNum+1; $j<=5; $j++)
                            <i class="fa fa-star"></i>
                            @endfor
                            <span> {{$ratings->count()}} Ratings</span>

                        </div>

                        <p class="mt-3">
                            {!! $products->car_description !!}
                        </p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Rate this product
                          </button>

                        <hr>
                        @if($products->car_qty > 0)
                            <label class="badge bg-success p-2">In stock</label>
                         @else
                         <label class="badge bg-danger p-2">Out of stock</label>
                         @endif
                         <div class="row mt-2">
                            <input type="hidden" value="{{$products->id}}" class="prod_id">
                            <!--
                            <div class="col-md-2">
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3">
                                    <span class="input-group-text">-</span>
                                    <input type="text" name="quantity" class="form-control">
                                    <span class="input-group-text">+</span>
                                </div>
                            </div>
                        -->
                            <div class="col-md-10">
                                <br/>
                                @if($products->car_qty > 0)
                                <button type="button" class="btn btn-primary me-3 addToCartBtn float-start">Add to Cart <i class="fa fa-shopping-cart"></i></button>
                                @endif
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            <!--
            <div class="card-footer">
                <h2>Details</h2>
                <p></p>
            </div>
        -->
    </div>
</div>
@endsection

@section('scripts')
<script>

    $('.addToCartBtn').click(function(e){
        e.preventDefault();

        var product_id =$(this).closest('.product_data').find('.prod_id').val();

        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

        $.ajax({
            type:"POST",
            url:"/add-to-cart",
            data:{

                "product_id":product_id,
            },
            success: function(response){
                swal(response.status);
            }
        });
    });

</script>
@endsection
