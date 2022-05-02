
@extends('playout.admin') <!-- load toan bo trang playout.admin -->

@section('title')
    <title>Quản lí đơn hàng</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <style type="text/css">
            .formattotal{
               text-align: center;
            }
        </style>
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>' Thông tin đăng nhập','key'=>''])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">

                <div class="row">

                    <!--display content data phân trang -->
                    <div class="col-md-12">

                        <table class="table table-striped">
                            <thead>
                            <tr>

                                <th>Tên khách hàng</th>
                                <th> Số điện thoại</th>
                                <th>Email</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->phone}}</td>
                                <td>{{$customer->email}}</td>

                            </tr>

                            </tbody>

                        </table>

                    </div>

                </div>
            <br>
            <br>
            @include('partial.content-header',['name'=>'Địa chỉ nhận hàng','key'=>''])
                <div class=""row>
                    <div class="col-md-12">
                                <div class="panel-heading">

                                </div>


                                <div class="table-responsive">
                                    <?php
                                    $message = Session::get('message');
                                    if($message){
                                        echo '<span class="text-alert">'.$message.'</span>';
                                        Session::put('message',null);
                                    }
                                    ?>
                                    <table class="table table-striped b-t b-light">
                                        <thead>
                                        <tr>

                                            <th>Tên người nhận hàng</th>
                                            <th>Địa chỉ nhận hàng</th>
                                            <th>Số điện thoại</th>
                                            <th>Hình thức thanh toán</th>


                                            <th style="width:30px;"></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>

                                            <td>{{$shipping->shipping_name}}</td>
                                            <td>{{$tinh->name}} - {{$thanhpho->name}} - {{$xa->name}}</td>
                                            <td>{{$shipping->shipping_phone}}</td>

                                            <td>{{$shipping->medthod_payment}}</td>


                                        </tr>

                                        </tbody>
                                    </table>

                                </div>

                    </div>
                </div>

            <br>
            <br>
            @include('partial.content-header',['name'=>'Chi tiết đơn hàng','key'=>''])
            <div class=""row>
                <div class="col-md-12">
                    <div class="panel-heading">

                    </div>


                    <div class="table-responsive">
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>
                        <table class="table table-striped b-t b-light">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền(VNĐ)</th>


                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 0;
                            $total = 0;
                            ?>

                                @foreach($order_details as $key => $details)

                                    <tr>
                                   <?php
                                        $i++;
                                        $subtotal = $details->product_price * $details->product_quantity;
                                        $total+=$subtotal ;

                                        $vat = '';

                                    ?>
                                        <td><label>{{$i}}</label></td>
                                       <td>{{$details->product_name}}</td>
                                       <td>{{$details->product_quantity}}</td>
                                       <td>{{number_format($details->product_price)}}</td>
                                       <td>{{number_format($subtotal)}}

                                       </td>
                                    </tr>
                                @endforeach

                            <tr>
                                <td colspan="5"  class="formattotal">
                                    <strong> Phí vận chuyển:</strong> {{number_format($shipping->fee_ship).'vnđ'}}</td>

                            </tr>
                            <tr>
                                <td colspan="5"  class="formattotal"><strong>Thuế (10%):</strong> {{number_format($total * 0.1).'vnđ'}}</td>

                            </tr>
                            <tr>
                                <td colspan="5"  class="formattotal"> <strong>Thanh toán:
                                        {{number_format($total + ($total * 0.1)+$shipping->fee_ship). 'vnđ' }}</strong></td>

                            </tr>


                            <tr>
                                <td colspan="2">
                                    @foreach($getorder as $key => $or)
                                        @if($or->order_status==1)
                                            <form>
                                                @csrf
                                                <select class="form-control order_details" id="{{$or->order_id}}">

                                                    <option id="{{$or->order_id}}" selected value="1">Chưa xử lý</option>
                                                    <option id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option>

                                                </select>
                                            </form>

                                        @else

                                            <form>
                                                @csrf
                                                <select class="form-control order_details">

                                                    <option disabled id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                                                    <option id="{{$or->order_id}}" selected value="2">Đã xử lý-Đã giao hàng</option>

                                                </select>
                                            </form>



                                        @endif
                                    @endforeach


                                </td>
                            </tr>


                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

            <!-- /.content -->
        </div>



    </div>


@endsection




