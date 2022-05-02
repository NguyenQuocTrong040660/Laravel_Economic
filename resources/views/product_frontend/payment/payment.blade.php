

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
            <div class="row" style="padding: 20px">
                @include('partial_frontend.sidebar')
                <div class="col-sm-9 padding-right">
                    <section id="cart_items">

                        <h3>Giỏ hàng của bạn</h3>
                        <hr>
                        <div class="table-responsive cart_info">
                            <?php
                            $content = Cart::content();
                            //                            echo'<pre>';
                            //                            print_r($content);
                            //                            echo'</pre>';

                            ?>
                            <table class="table table-condensed">
                                <thead>
                                <tr class="cart_menu">
                                    <td class="image">Hình ảnh</td>
                                    <td class="description">Mô tả</td>
                                    <td class="price">Giá</td>
                                    <td class="quantity">Số lượng</td>
                                    <td class="total">Tổng tiền</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($content as $c_contend)
                                    <tr>
                                        <td class="cart_product">
                                            <a href=""><img src="{{$c_contend->options->image}}" alt="{{$c_contend->img_name}}" width="100" height="100"></a>

                                        </td>
                                        <td class="cart_description">
                                            <h4><a href="">{{$c_contend->name}}</a></h4>
                                            <p>Web ID: 1089772</p>
                                        </td>
                                        <td class="cart_price">
                                            <p>{{$c_contend->price}}</p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                {{--update quantity cart --}}
                                                <form action="{{route('cart_update_quantity')}}" method="post" >
                                                    {{csrf_field()}}
                                                    <input type="hidden" value="{{$c_contend->rowId}}" name="rowId"/>
                                                    <input class="cart_quantity_input" type="number" name="quantity" value="{{$c_contend->qty}}" width="50px" />
                                                    <input type="submit" value="cập nhật">
                                                </form>

                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p style="color: red" class="cart_total_price">
                                                {{number_format($c_contend->price * $c_contend->qty).'vnđ'}}
                                            </p>
                                        </td>
                                        <td class="cart_delete">
                                            <a class="cart_quantity_delete" href="{{route('cart_delete',$c_contend->rowId)}}"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                    </section>
                </div>

                <h3>Chọn hình thức thanh toán</h3>
                Tiền mặt<input type="checkbox" name="payment" value="tiền mặt" >
                VNPAY<input type="checkbox" name="payment" value="vn pay" >

                Ghi nợ<input type="checkbox" name="payment" value="ghi nợ" >

            </div>
        </div>
        </div>
    </section>
@endsection

