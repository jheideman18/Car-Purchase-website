@extends('layouts.frontend')
@section('title')
Welcome to Lucid Cars
@endsection

@section('content')
@include('layouts.inc.slider')


        <div class="py-5 bg-primary bg-opacity-25">
            <div class="container">
                <div class="row">
                    <h2 >Trending Categories</h2>
                    <div class="owl-carousel owl-theme">
                        @foreach ($trending_category as $t_cate)
                        <div class="item">
                            <a href="{{url('view-category/'.$t_cate->slug)}}">

                            <div class="card">
                            <img src="{{asset('assets/uploads/category/'.$t_cate->image)}}" alt="Trending Category image">
                            <hr>
                            <div class="card-body">
                                <h5>{{$t_cate->name}}</h5>

                                <p>{{$t_cate->description}}</p>
                            </div>
                        </div>
                    </a>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
@endsection
@section('scripts')
<script>
    $('.owl-carousel').owlCarousel({
    items:3,
    loop:true,
    margin:15,
    autoplay:true,
    autoplayTimeout:2500,
    autoplayHoverPause:true
})
</script>
@endsection

