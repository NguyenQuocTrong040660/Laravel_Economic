

@extends('playout_frontend.master')

@section('title')
        <title>Home Page</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('Eshopper/home/home.css') }}">
@endsection


@section('js')
    <script rel="stylesheet" href="{{asset('Eshopper/home/home.js')}}" ></script>
    <script src="{{asset('Eshopper/js/jquery.js')}}"></script>
    <script src="{{asset('Eshopper/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('Eshopper/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('Eshopper/js/price-range.js')}}"></script>
    <script src="{{asset('Eshopper/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('Eshopper/js/main.js')}}"></script>
@endsection



@section('content')
   @include('partial_frontend.slider')
    <section>
    {{--    slider--}}

    {{--    slider--}}
    <div class="container">
        <div class="row">
          @include('partial_frontend.sidebar')

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Sản phẩm tiềm năng</h2>
                    @foreach($product as  $key=>$product)

                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="{{route('detail.product',$product->id)}}">
                                            <img src="{{$product->feature_image_path}}" alt="Anh product" />
                                        </a>
                                        <h4>{{$product->price}}VND</h4>
                                        <p>{{$product->name}}</p>
                                        <a href="#"
                                           data-url="{{route('addToCart',$product->id)}}"
                                           class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart">

                                            </i>Thêm giỏ hàng
                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach


                </div><!--features_items-->

            </div>
        </div>
    </div>
</section>
@endsection




