
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
                            <?php
                            $i=0;
                            ?>
                            @foreach($data as $value)
                                <?php
                                $i++;

                                ?>

                                <tr>
                                    <td> {{$i}} </td>
                                    <td> {{$value->name}} </td>
                                    <td> {{$value->price}} </td>
                                    <td><img src="{{$value->feature_image_path}}" width="100px" height="100px"/> </td>
                                    <td> {{$value->caterogy['name']}} </td>
                                    <td>
                                        <a href="{{route('product.edit',$value->id)}}" class="btn btn-success">Edit</a>
                                        <a onclick="return confirm('Are you sure?')" href="{{route('product.delete',$value->id)}}" class="btn btn-danger" data="{{$value->id}}" id="deleteProduct">Delete</a>

                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>

                {{ $data->links() }}



                <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>

@endsection


