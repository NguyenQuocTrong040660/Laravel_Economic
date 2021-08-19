
@extends('playout.admin') <!-- load toan bo trang playout.admin -->

@section('title')
    <title>Product_index</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Product','key'=>'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a  class="btn btn-success float-right m-2" href="{{route('product.add')}}">Add</a>
                    </div>
                    <!--display content data phân trang -->
                    <div class="col-md-12">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Sản Phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hình Ảnh</th>
                                <th scope="col">Danh Mục</th>
                                <th scope="col">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> 1 </td>
                                    <td> IPhone13</td>
                                    <td>10.000.000</td>
                                    <td></td>
                                    <td>Điện Thoại</td>
                                    <td>
                                        <a href="#" class="btn btn-success">Edit</a>
                                        <a onclick="return confirm('Are you sure?')" href="#" class="btn btn-danger">Delete</a>

                                    </td>

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

