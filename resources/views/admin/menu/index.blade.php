
@extends('playout.admin') <!-- load toan bo trang playout.admin -->

@section('title')
    <title>Trang Chu</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Menu','key'=>'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a  class="btn btn-success float-right m-2" href="{{route('menu.add')}}">Add</a>
                    </div>
                    <!--display content data phân trang -->
                    <div class="col-md-12">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Menu</th>
                                <th scope="col">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reult as $value)
                                <tr>
                                    <td> {{ $value->id }} </td>
                                    <td> {{ $value->name}}</td>
                                    <td>
                                        <a href="{{route('menu.edit',$value->id)}}" class="btn btn-success">Edit</a>
                                        <a onclick="return confirm('Are you sure?')" href="{{route('menu.delete',$value->id)}}" class="btn btn-danger">Delete</a>

                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-12">
                {{ $reult->links() }}
                    </div>

                <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>

@endsection

