

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
{{--    @include('partial_frontend.slider')--}}
    <section id="cart_items">
        <div class="container">

            <div class="shopper-informations">
                <div class="row">
                     <style type="text/css">
                         .btnguidonhang{
                               margin: 8px 0 0;
                              background-color: red;
                             color: white;

                             height: 50px;
                             text-align:center;}
                    </style>
{{--                    @include('partial_frontend.sidebar')--}}

                    <div class="col-md-12">
                        <form  method="post">
                         @csrf
                        <div class="col-md-6">
                            <div style="font-weight: bold;font-size: larger;color: #1A94FF"><h3>Thông tin người nhận hàng</h3></div>
                            <br>
                            <div class="form-group">
                                    <input type="text"  class="form-control"  required name="shipping_name" id="shipping_name" placeholder="Họ tên *">
                            </div>
                            <div class="form-group">
                                    <input  type="text" class="form-control"  required name="shipping_phone" id="shipping_phone" placeholder="số điện thoại *">
                            </div>
                            <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
                                    <select name="payment_select"  class="form-control input-sm payment_select">
                                        <option value="Chuyển khoản">Qua chuyển khoản</option>
                                        <option value="Tiền mặt">Tiền mặt</option>
                                    </select>

                                    {{-- Thanh toan Paypal--}}
                                      <br/>


                            </div>
                            </div>
                        <div class="col-md-6">
                            <div style="font-weight: bold;font-size: larger;color: #1A94FF"><h3>Địa chỉ nhận hàng</h3></div>
                                <div class="panel-body">
                                    <div class="position-center">

                                            <div class="form-group" style="width: 300px">

                                                <select name="city" id="city"  data-dependent="city" class="form-control chonselect city address_phi">
                                                    <option value="0">--Chọn tỉnh-thành phố--</option>
                                                    @foreach($city as $key=>$cityItem)
                                                        <option value="{{$cityItem->matp}}"> {{$cityItem->name}} </option>

                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="form-group " style="width: 300px">

                                                <select  name="province" id="province" data-dependent="province" class="form-control chonselect province address_phi" >
                                                    <option value="0">--Chọn quận huyện--</option>

                                                </select>

                                            </div>

                                            <div class="form-group"style="width: 300px">

                                                <select id="wards" name="wards" data-dependent="wards" class="form-control  award address_phi">
                                                    <option value="0">--Chọn xã phường--</option>

                                                </select>

                                            </div>

                                        <div  >
                                         <input type="button" class="btnguidonhang" value="Gửi đơn hàng"/>
                                            <input type="button" class="btnVanChuyen" value="Tính phí vận chuyển"/>
                                        </div>



                                              </div>

                                     </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>

        </div>
        <div class="row">
            <div class="container">
                <div class="col-md-9">


                    <div style="font-weight: bold;font-size: larger;color: #1A94FF"><h3>Giỏ hàng của bạn</h3></div>
                    <div class="duongketable"><hr></div>
                    <div class="table-responsive-md cart_info">
                        <table class="table table-condensed">
                            <thead>
                            <tr class="cart_menu">
                                <th>#</th>
                                <th class="image">Hình ảnh</th>
                                <th class=" description">Tên sản phẩm</th>
                                <th class=" price">Giá</th>
                                <th class="">Số lượng</th>
                                <th class="total">Thành tiền</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            if(session()->get('cart')==true){

                            $tongtien = 0;
                            $ii=0;
                            $i=0;
                            $phivanchuyen=0;
                            $total=0;
                            $tongcophi=0;

                            ?>

                            @foreach(session()->get('cart') as $key=>$cartItem)

                                <?php
                                $i++;
                                $tongtien =$tongtien+ ($cartItem['price'] * $cartItem['quantity']);
                                $phiVAT =$tongtien*0.1;
                                $total = $tongtien + $phiVAT;

                                ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td class="cart_product">
                                        <img src="{{$cartItem['image']}}" alt="{{$cartItem['name']}}" width="100" height="100">

                                    </td>
                                    <td class="cart_description">
                                        <p>{{$cartItem['name']}}</p>

                                    </td>
                                    <td class="cart_price">
                                        <p>{{number_format($cartItem['price'])}}</p>
                                    </td>
                                    <td>
                                        <div class="cart_quantity " >

                                            <div class="pro_qty">
                                                <span class="dec qtybtn " data="{{$key}}">-</span>
                                                <input id="carqtyti_{{$key}}" type="text"  value="{{$cartItem['quantity']}}"  >
                                                <span class="inc qtybtn"  data="{{$key}}">+</span>
                                            </div>

                                        </div>
                                    </td>



                                    <td class="cart_total">
                                        <p style="color: red" class="cart_total_price">
                                            {{number_format($cartItem['price'] * $cartItem['quantity']).'vnđ'}}
                                        </p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete xoacart"  href="{{route('deletecart',$cartItem['product_id'])}}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>



                            @endforeach

                            <?php
                            }
                            ?>
                            </tbody>

                        </table>

                    </div>


                </div>
                @if(session()->get('cart'))

                <div class="col-md-3">
                    <br>
                    <br>
                    <div style="font-weight: bold;font-size: larger;color: #1A94FF"><h3>Thanh toán</h3></div>

                    <div class="total_area">
                        <ul>
                            <li>Tổng: <span>{{number_format($tongtien). 'vnđ'}}</span></li>
                            <li>VAT 10%:  <span>{{number_format($phiVAT). 'vnđ'}}</span></li>


                             <?php
                            if(session()->get('get_fee_ship')==true){

                                 ?>
                            @foreach(session()->get('get_fee_ship') as $key=>$fee_ship)
                                <?php

                                $total += $fee_ship['fee_feeship'];
                                ?>

                                <a href="{{route('delete_fee_ship')}}" >
                                    <li class="fa fa-times">Phí vận chuyển:
                                        <span>{{number_format($fee_ship['fee_feeship']). 'vnđ'}}</span></li>
                                </a>
                            @endforeach
                            <?php }

                            ?>

                            <li>Tổng tiền:  <span>{{number_format($total). 'vnđ'}}</span></li>


                        </ul>



                    </div>
                </div>
                @endif



            </div>




        </div>
        </div>
    </section> <!--/#cart_items-->
@endsection

