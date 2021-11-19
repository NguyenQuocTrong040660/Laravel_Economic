@extends('playout.admin') <!-- load toan bo trang playout.admin -->

@section('title')
    <title>Thêm Sản Phẩm</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('vendors/select2.min.css')}}" />
    <link rel="stylesheet href="{{asset('admins/add/select2.css')}}"/>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       @include('partial.content-header',['name'=>'Product','key'=>'Add'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('product.store')}}" enctype="multipart/form-data" method="post">
                        @csrf <!-- {{ csrf_field() }} -->
                            <div class="form-group">
                                <label for="sp">Tên sản Phẩm</label>
                                <input type="text" class="form-control" id="sp"  name="name"  placeholder="Enter">
                            </div>

                            <div class="form-group">
                                <label for="price">Giá(VNĐ)</label>
                                <input type="text" class="form-control" id="price"  name="gia"  placeholder="Enter: 10.000.000">
                            </div>

                            <div class="form-group">
                                <label for="feature_image_path">Ảnh đại diện</label>
                                <input type="file" class="form-control-file" id="feature_image_path"  name="feature_image_path"  placeholder="Enter Category">
                            </div>

                            <div class="form-group">
                                <label for="image_path">Ảnh chi tiết</label>
                                <input type="file" multiple class="form-control-file" id="image_path"  name="image_path[]" placeholder="Enter Category">
                            </div>

                            <div class="form-group ">
                                <label for="inputState">Danh mục</label>
                                <select id="inputState" class="form-control" name="category_id">
                                    <option  value="0">Danh Muc Cha</option>
                                    {!! $htmlOption  !!}
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Chọn tags </label>
                                <select class="form-control select2"  name="tags[]"   multiple="multiple"  >

                                </select>

                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control tynimce_init"  name="contents" id="contents" rows="3"></textarea>
                            </div>

                            <button  onclick="return confirm('Are you sure?')" type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection

@section('js')
    <!-- / Them Select2 -->
            <script src="{{asset('vendors/select2.min.js')}}"></script>
            <script src="{{asset('admins/add/select2.js')}}"> </script>
        <!-- /Them Tynicme -->
            <script src="{{asset('vendors/tinymce.min.js')}}" referrerpolicy="origin"></script>



@endsection
