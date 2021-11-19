@extends('playout.admin') <!-- load toan bo trang playout.admin -->

@section('title')
    <title>Trang Chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @if(session()->has('success'))
            <div class="col-md-12 alert-success">
             {{session()->get('success')}}
            </div>

        @endif
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'Slider','key'=>'List'])
    <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a  class="btn btn-success float-right m-2" href="{{route('slider.add')}}">Add</a>
                    </div>
                    <!--display content data phân trang -->
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">Description</th>
                                <th scope="col">image</th>
                                <th scope="col">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($result as $result_paginate)
                                <tr>
                                    <td> {{ $result_paginate->id }}</td>
                                    <td>{{ $result_paginate->name }}</td>
                                    <td>{{$result_paginate->description}}</td>
                                    <td>

                                        <img src="{{$result_paginate->image_path}}" width="100px" height="100px" ></td>
                                    <td>
                                        <a href="{{ route('slider.edit',$result_paginate->id) }}" class="btn btn-success">Edit</a>

                                        <a href="{{ route('slider.delete',$result_paginate->id) }}" class="btn btn-danger"
                                           id="delete_slider" data-id="{{$result_paginate->id}}">
                                            Delete
                                        </a>

                                    </td>

                                </tr>

                            @endforeach
                            </tbody>
                        </table>

                    </div>

                {{ $result->links()}}

                <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>

@endsection
            @section('js')
                <script src="{{asset('admins/slider/list.js')}}"></script>

                <script src="{{asset('admins/slider/index/list.js')}}"></script>

                <script>

                    $(document).ready(function () {

                            $("body").on("click","#delete_slider",function(e){



                                e.preventDefault();
                                var id = $(this).data("id");
                                // var id = $(this).attr('data-id');
                                var token = $("meta[name='csrf-token']").attr("content");
                                var url = e.target;
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "You won't be able to revert this!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, delete it!'
                                }).then((result) => {
                                    if (result.value) {

                                $.ajax(
                                    {
                                        url: url.href, //or you can use url: "company/"+id,
                                        type: 'DELETE',
                                        data: {
                                            _token: token,
                                            id: id
                                        },
                                        success: function (response){
                                            if (response.code == 200) {
                                       that.parent().parent().remove();
                              }

                                 }
                                    });
                                return false;
                            });


                        });


                </script>

            @endsection





