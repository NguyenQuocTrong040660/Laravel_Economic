
@extends('playout.admin') <!-- load toan bo trang playout.admin -->

@section('title')
    <title>Trang Chu</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <div class="container">
            <section class="panel">
                <br>
                <h3> Thêm vận chuyển</h3>


                <div class="panel-body">
                    <div class="position-center">
                        <form >
                            @csrf
                            <div class="form-group" style="width: 300px">
                                <label>Chọn Tỉnh</label>
                                <select name="city" id="city"  data-dependent="city" class="form-control chonselect city address_phi">
                                    <option value="0">--Chọn tỉnh-thành phố--</option>
                                    @foreach($city as $key=>$cityItem)
                                    <option value="{{$cityItem->matp}}"> {{$cityItem->name}} </option>

                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group " style="width: 300px">
                                <label>Chọn quận huyện</label>
                                <select  name="province" id="province" data-dependent="province" class="form-control chonselect province" >
                                    <option value="0">--Chọn quận huyện--</option>

                                </select>

                            </div>

                            <div class="form-group"style="width: 300px">
                                <label>Chọn xã phường </label>
                                <select id="wards" name="wards" data-dependent="wards" class="form-control  award">
                                    <option value="0">--Chọn xã phường--</option>

                                </select>

                            </div>

                            <div class="form-group"style="width: 300px">
                                <label for="fee_ship">Phí vận chuyển</label>
                                <input id="fee_ship" type="text" name="fee_ship" class="form-control fee_ship">

                            </div>
                            <div class="form-group"style="width: 300px">

                                <input type="button" value="Thêm" class="delivery_ship"/>
                            </div>




                        </form>



                    </div>


                </div>

            </section>
            <!-- /.content -->
        </div>
        <div id="result_feeship" class="container-fluid">

        </div>
    </div>

@endsection



