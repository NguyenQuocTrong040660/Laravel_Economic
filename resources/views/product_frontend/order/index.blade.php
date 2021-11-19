

@extends('playout_frontend.master')

@section('title')
    <title>Lịch Sử đơn hàng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('Eshopper/home/home.css') }}">
@endsection
@section('content')
    <div class="content-wrapper" style="height: 800px">
        <!-- Content Header (Page header) -->

        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container">
                <div class="row">

                    <!--display content data phân trang -->
                    <div class="col-md-12">
                        <div style="text-align:center;font-weight: bold;font-size:large;color: #1A94FF"><h2>Danh sách đơn hàng</h2></div>
                        <table class="table table-striped">
                            <thead>

                            <tr>

                                <th>Thứ tự</th>
                                <th>Mã hóa đơn</th>
                                <th>Ngày tháng đặt hàng</th>
                                <th>Tình trạng đơn hàng</th>
                                <th style="width:30px;">Action</th>
                            </tr>

                            </thead>

                            <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach($getorder as $key => $ord)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td><label>{{$i}}</label></td>
                                    <td>{{ $ord->order_code }}</td>
                                    <td>{{ $ord->created_at }}</td>

                                    <td>@if($ord->order_status==1)
                                            <span class="text text-success">Chờ xử lí</span>
                                        @elseif($ord->order_status==2)
                                            <span class="text text-primary">Đã xử lý - Đã giao hàng</span>
                                        @else
                                            <span class="text text-danger">Đơn hàng đã bị hủy</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($ord->order_status==3)
                                            {{$ord->order_destroy}}
                                        @endif
                                    </td>


                                    <td>
                                        <a href="{{route('view_order_frontend',$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                                            <i class="fa fa-eye text-success text-active"></i></a>

{{--                                        <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">--}}
{{--                                            <i class="fa fa-times text-danger text"></i>--}}
{{--                                        </a>--}}

                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>

                    </div>

                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>


@endsection




