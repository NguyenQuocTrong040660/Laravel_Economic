@extends('playout.admin') <!-- load toan bo trang playout.admin -->

@section('title')
    <title>Trang Chu</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       @include('partial.content-header',['name'=>'Menu','key'=>'Add'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('menu.store')}}" method="POST">
                        @csrf <!-- {{ csrf_field() }} -->
                            <div class="form-group">
                                <label for="dmsp">Name Menu</label>
                                <input type="text" class="form-control" id="#"  name="name" aria-describedby="emailHelp" placeholder="Enter Category">

                            </div>
                            <div class="form-group ">
                                <label for="inputState">Danh Muc Cha</label>
                                <select id="inputState" class="form-control" name="parent_id">
                                    <option  value="0">Danh Muc Cha</option>
                                    {!! $htmlOption !!}

                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form></div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection
