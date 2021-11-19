
@extends('playout.admin') <!-- load toan bo trang playout.admin -->

@section('title')
    <title>Quản lí đơn hàng</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Oder','key'=>'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <!--display content data phân trang -->
                    <div class="col-md-12">

                        <table class="table table-striped">
                            <thead>

                            <tr>

                                <th>Thứ tự</th>
                                <th>Mã đơn hàng</th>
                                <th>Ngày tháng đặt hàng</th>
                                <th>Tình trạng đơn hàng</th>
                                <th>Lý do hủy</th>


                                <th style="width:30px;"></th>
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
                                            <span class="text text-success">Đơn hàng mới</span>
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
                                        <a href="{{route('view_order',$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                                            <i class="fa fa-eye text-success text-active"></i></a>

                                        <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                                            <i class="fa fa-times text-danger text"></i>
                                        </a>

                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        {{$getorder->links()}}



                    </div>




                <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>


@endsection



