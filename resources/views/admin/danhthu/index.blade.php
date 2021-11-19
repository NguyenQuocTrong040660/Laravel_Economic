@extends('playout.admin') <!-- load toan bo trang playout.admin -->

@section('title')
    <title>Trang Chu</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Doanh thu theo sản phẩm','key'=>'List'])
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
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Mã sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá bán</th>
                                <th scope="col">Doanh Thu (VNĐ)</th>


                            </tr>

                                <th scope="col">Tổng</th>

                            </thead>
                            <tbody>
                            <?php
                            $i=0;
                            $sum=0;
                            $total=0;
                            ?>

                                @foreach($dataproduct as $key=>$doanhthu)
                                <?php
                                $i++;
                                $sum = $doanhthu->total_quantity*$doanhthu->price;
                                $total +=$sum;
                                ?>

                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$doanhthu->name}}</td>
                                    <td>{{$doanhthu->product_id}}</td>
                                    <td>{{$doanhthu->total_quantity}}</td>
                                    <td>{{number_format($doanhthu->price)}}</td>
                                    <td>{{number_format($sum).' '.'vnđ'}}</td>

                                </tr>


                            @endforeach
                            <tr>

                                <td colspan="5" style="text-align: right;font-size: large;font-weight: bold">Tổng  {{number_format($total).' '.'vnđ'}}</td>
                            </tr>

                            </tbody>
                        </table>

                    </div>

                <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>

@endsection
