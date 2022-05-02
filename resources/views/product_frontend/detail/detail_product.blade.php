

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
        <div class="container">
            <div class="row">
                @include('partial_frontend.sidebar')

                <div class="col-sm-9 padding-right">
                      <div style="text-align: center;font-weight: bold;font-size: larger;color: #1A94FF"><h2>Chi tiết sản phẩm</h2></div>
                    <div class="product-details"><!--product-details-->
                        @foreach($detail_id->images as $detail)
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="{{$detail->image_path}}" alt="{{$detail->img_name}}" />
                                <h3>ZOOM</h3>
                            </div>

                        </div>

                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->

                                <h2>{{$detail_id->name}}</h2>
                                <p>Mã sản phẩm: {{$detail_id->id}}</p>

                           {{--Form add Sh0ping Cart--}}

                                <span>
									<span style="color: red">{{number_format($detail_id->price).'VNĐ'}}</span>
                                    <br/>
									<label>Số lượng</label>
                                    <br>
									<input type="number" min="1" value="1" name="quality" />
                                    <input type="hidden" name="product_id" value="{{$detail_id->id}}">
									  <a href="#"
                                         data-url="{{route('addToCart',$detail_id->id)}}"
                                         class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart">

                                            </i>Thêm giỏ hàng
                                        </a>
								</span>

                                {{--Form add Sh0ping Cart--}}
                                <p><b>Trạng thái: </b>Còn hàng</p>
                                <p><b>Điều kiện: </b>Sản phẩm mới</p>
                                <p><b>Thương hiệu: </b> {{$detail_id->caterogy->name}}</p>
                                <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                            </div><!--/product-information-->
                        </div>

                        @endforeach
                    </div><!--/product-details-->
                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li><a href="#mota" data-toggle="tab">MÔ TẢ</a></li>
                                <li><a href="#details" data-toggle="tab">SẢN PHẨM TƯƠNG TỰ</a></li>
                                <li><a href="#reviews" data-toggle="tab">ĐÁNH GIÁ-Nhận Xét Từ Khách Hàng</a></li>

                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane " id="mota" >
                                <div class="col-sm-12">

                                    <p>{{$detail_id->content}}</p>



                                </div>
                            </div>
                            <div class="tab-pane fade" id="details" >
                                @foreach($product_recomman as $product)
                                    <a href="{{route('detail.product',$product->id)}}">
                                <div class="col-sm-6 col-md-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{$product->feature_image_path}}" alt="{{$product->name}}" />
                                                <h4>{{number_format($product->price).'VNĐ'}}</h4>
                                                <p>{{$product->name}}</p>

{{--                                                <button type="button" class="btn btn-default add-to-cart">--}}
{{--                                                    <i class="fa fa-shopping-cart"></i>--}}
{{--                                                    Thêm giỏ hàng</button>--}}

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
                                    </a>
                                @endforeach

                            </div>

                            <div class="tab-pane fade" id="companyprofile" >
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/gallery1.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/gallery3.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/gallery2.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/gallery4.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="tab-pane fade active in" id="reviews" >
                                <div class="col-sm-12">
                                    <ul>
                                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                        <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                        <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                    <p><b>Write Your Review</b></p>
                                    {{--Danh gia Sao --}}
                                   {{-- <p><b>Viết đánh giá của bạn</b></p>

                                    <!------Rating here---------->
                                    <ul class="list-inline rating"  title="Average Rating">
                                        @for($count=1; $count<=5; $count++)
                                            @php
                                                if($count<=$rating){
                                                    $color = 'color:#ffcc00;';
                                                }
                                                else {
                                                    $color = 'color:#ccc;';
                                                }
                                            @endphp

                                            <li title="star_rating" id="{{$value->product_id}}-{{$count}}" data-index="{{$count}}"  data-product_id="{{$value->product_id}}" data-rating="{{$rating}}" class="rating" style="cursor:pointer; {{$color}} font-size:30px;">&#9733;</li>
                                        @endfor

                                    </ul>
                                    --}}
                                    <p><b>Viết đánh giá của bạn</b></p>
                                     <ul class="list-inline"  title="Average Rating">
                                         @for($count=1; $count<=5; $count++)
                                          <li title="đánh giá sao"
                                          id=""
                                          data-index=""
                                          data-product_id=""
                                          data-rating=""
                                          class="rating"
                                          style="cursor:pointer; color: #c0dbeb; font-size:30px;">
                                          &#9733;
                                        </li>
                                         @endfor

                                    </ul>
                                    {{--Danh gia Sao --}}

                                    <form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
                                        <textarea name="" ></textarea>
                                        <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                                        <button type="button" class="btn btn-default pull-right">
                                            Submit
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div><!--/category-tab-->
                </div>
            </div>
        </div>
    </section>
@endsection







