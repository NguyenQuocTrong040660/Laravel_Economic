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

          {{-- action="{{route('loc-doanh-thu')}}"--}}
                        <form autocomplete="off"  method="post" >
                            @csrf
                                <p>Từ ngày: <input type="text"  name="from_date" id="datepicker" ></p>

                                <p>Đến ngày: <input type="text" name="to_date" id="datepicker2" ></p>

                            <p type="button" id="btn-dashboard-filter" class="btn btn-primary btn-danger" value="Lọc kết quả"></p>

                            <p>
                                    Lọc sản phẩm bán được:
                                    <select class="dashboard-filter form-control" >
                                        <option v>---Chọn---</option>
                                        <option value="now_day">Ngày hôm nay</option>
                                        <option value="7ngay">7 ngày qua</option>
                                        <option value="thangtruoc">tháng trước</option>
                                        <option value="thangnay">tháng này</option>
                                        <option value="365ngayqua">365 ngày qua</option>
                                    </select>
                                </p>

                        </form>
                    </div>




                <div  id="myfirstchart" style="height: 500px;"></div>



                <div class="container-fluid" id="doanh_thu_result">


                    <div class="container-fluid" id="result_option_thongke_sp">

                    <!--display content data phân trang -->
                <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>

@endsection
