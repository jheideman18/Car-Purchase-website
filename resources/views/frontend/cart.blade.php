@extends('layouts.frontend')
@section('title')
My Cart
@endsection

@section('content')
<div class="py-3 mb-3 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">
                Home
            </a>/
            <a href="{{url('cart')}}">
                Cart
            </a>
        </h6>
    </div>
</div>

<div class="container my-5">
    @if($cartItems->count() > 0)
    <div class="card mx-auto">
        <h2 class="card-header">Cart Items</h2>
        <div class="card-body">
            @php $total=0; @endphp
            @foreach($cartItems as $item)
            <div class="row product_data">
                <div class="col-md-2 my-auto mt-2 ">
                    <img src="{{asset('assets/uploads/products/'.$item->products->image)}}"  width="100%" alt="">
                </div>
                <div class="col-md-3 my-auto  mt-5 ms-5" >
                    <h3 class="lead">{{$item->products->car_name}}</h3>
                </div>

                  @if ($item->products->car_qty <= 0)
                    <div class="col-md-2 my-auto  mt-5">
                        <label class="badge bg-danger p-2">Out of stock</label>
                    </div>

                    @else

                    <div class="col-md-2 my-auto  mt-4">
                     <h3 class="lead">R{{$item->products->car_price}}</h3>
                    </div>
                @endif

                <div class="col-md-3 my-auto mt-5 mb-5">
                    <input type="hidden" value="{{$item->prod_id}}" class="prod_id">
                        <button class="btn btn-danger delete-cart-item"> <i class="fa fa-trash"></i>
                            Delete
                        </button>
                    </div>
                     </div>

                     @php $total += $item->products->car_price; @endphp
                     @endforeach
                    </div>
                    <div class="card-footer mt-2">
                        <h6 >Total Price: R{{$total}}
                        <a href="{{url('checkout')}}" class="btn btn-outline-success float-end">Proceed to Checkout</a>
                    </h6>
                    </div>
    @else
    <div class="card mx-auto">
        <h2 class="card-header">Cart Items</h2>
        <div class="card-body text-center">
                <h1 class=" ms-5">Your <i class="fa fa-shopping-cart"></i> Cart is empty</h1>
                <a href="{{url('category')}}" class="btn btn-outline-primary float-end">Continue Shopping</a>

        </div>
    </div>
    @endif

                    </div>
            </div>


@endsection
@section('scripts')
<script>

    $('.delete-cart-item').click(function(e){
        e.preventDefault();

        var product_id =$(this).closest('.product_data').find('.prod_id').val();

        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

        $.ajax({
            type:"POST",
            url:"/delete-cart-item",
            data:{

                "product_id":product_id,
            },
            success: function(response){

                window.location.reload();

                //swal("", response.status, "success");
            }
        });
    });

</script>
@endsection
