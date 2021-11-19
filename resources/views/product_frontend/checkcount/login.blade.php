
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
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-2">
                    <div class="login-form"><!--login form-->
                        <h2>Đăng nhập</h2>
                        <form action="{{route('login_custom')}}" method="post">
                            @csrf
                            <input type="text" name="username" placeholder="username" />
                            <input type="password"  name="password" placeholder="Mật khẩu" />
                            <span>
								<input type="checkbox" name="remember-me" class="checkbox">
								Ghi nhớ
							</span>

                            <button type="submit" class="btn">Đăng nhâp</button>


                        </form>
                       <div >
                            <a  href="{{route('login_facebook')}}">
                                <i class="fa fa-facebook-f">  <button   class="btn btn-primary ">Facebook</button></i>
                            </a>
                       </div>




                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Đăng kí tài khoản mới!</h2>
                        <form action="{{route('register_customer')}}" method="post">
                            {{csrf_field()}}
                            <input type="text" name="name" placeholder="Họ Tên"/>
                            <input type="email" name="email" placeholder="Địa chỉ Email"/>
                            <input type="number" name="phone" placeholder="Phone"/>
                            <input type="password"  name="pass" placeholder="Mật khẩu"/>
                            <input type="submit" class="btn btn-default hover-register">
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection


