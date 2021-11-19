@extends('playout.admin') <!-- load toan bo trang playout.admin -->

@section('title')
    <title>Trang Chu</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       @include('partial.content-header',['name'=>'Slider','key'=>'Edit'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('slider.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- {{ csrf_field() }} -->

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name"  name="name" value="{{$data->name}}"  placeholder="Enter Name">

                            </div>
                            <div class="form-group">
                                <label for="mota">Description</label>
                                <textarea type="text"  name="description" id="mota"   class="form-control" >{{$data->description}}</textarea>
                            </div>
                            <div class="form-group ">
                                <label for="inputState">Image</label>
                                <input type="file" id="inputState" name="imgslider" class="form-control-file" >
                               <div class="col-md-6">
                                   <img src="{{$data->image_path}}">
                               </div>

                            </div>

                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-primary" >Submit</button>
                        </form>
                    </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection
