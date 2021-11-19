
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <?php
                echo session()->get('customer_id');
                echo session()->get('shipping_id');
                ?>
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +84 828 878 807</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> trongb1809534@student.ctu.edu.vn</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{route('login_facebook')}}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">


                <div class="col-sm-2">
                    <div class="logo pull-left">
                        <a href="{{route('homefrontend')}}"><img src="Eshopper/images/home/LOGO.png" width="100" height="70" alt="" /></a>


                    </div>


                </div>

                <div class="col-sm-10">
                    <div class="shop-menu pull-right">

                        <ul class="nav navbar-nav">

                            <li><a href="{{route('homefrontend')}}"><i class="fa fa-home"></i> Trang chủ</a></li>

                          {{--Thanh toan--}}
                            <?php
                            $customer_id = session()->get('customer_id');
                            $shipping_id =session()->get('shipping_id');
                            $cart = session()->get('cart');
                            if($customer_id!=NULL && $shipping_id==NULL && $cart!=NULL){
                            ?>
                            <li><a href="{{route('thanhtoan')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>

                            <?php }
                            elseif($customer_id!=NULL && $shipping_id!=NULL) {
                                ?>

                            <li><a href="{{route('payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                            <?php
                            }
                            else{
                            ?>
                            <li><a href="{{route('check_acount')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>

                            <?php
                            }
                            ?>
                            {{--Thanh toan--}}

                            {{-- Gio hang --}}
                            <?php
                            $session_cart = session()->get('cart');
                            if($session_cart!=NULL){
                            ?>
                            <li><a href="{{route('show_cartAjax')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                                    <span style="background-color: red" class="badge" id="slg_Adtocart"></span>

                                </a>
                            </li>

                           <?php
                            }elseif($session_cart==NULL){
                            ?>
                            <li><a href="{{route('homefrontend')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                                    <span class="badge" id="slg_Adtocart"></span>
                                </a></li>

                            <?php
                            }
                            ?>
                            {{-- Gio hang --}}

                            {{-- Lich Su Don hang --}}
                            <?php
                                $customer_id = Session::get('customer_id');
                                if($customer_id!=NULL){
                            ?>

                            <li>
                                <a href="{{route('history_order')}}"><i class="fa fa-bell"></i> Lịch sử đơn hàng </a>

                            </li>


                            <?php
                                }
                          ?>
                            {{-- Lich Su Don hang --}}



                            {{-- Login,Logout--}}
                            <?php


                                 if(session()->has('customer_name')){
                                    ?>
                            <li><a href="{{route('logout_checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                 <?php
                                 }
                                 else{
                                 ?>
                            <li><a href="{{route('check_acount')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>

                                 <?php
                                 }
                                 ?>
                            {{-- Login,Logout--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                   <div width="200px" style="padding-right:10px">
                    <form action="{{route('search_product')}}" method="POST">
                       {{@csrf_field()}}
                        <label for="tk">Tìm kiếm sản phẩm</label>
                        <input width="200px" type="text" name="nameproduct"  id="tk"placeholder="Tìm kiếm"/>
                        <input type="submit" value="submit">

                    </form>
                   </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
