@extends('playout.admin') <!-- load toan bo trang playout.admin -->

@section('title')
    <title>Trang Chu</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
      @include('partial.content-header',['name'=>'Home','key'=>'home'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                   Trang Chu
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection
