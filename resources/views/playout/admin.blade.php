<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css')}}">
    @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- hearder-->
@include('partial.header')
<!-- Main Sidebar Container -->
@include('partial.slider')

    <!-- content will be changed-->
 @yield('content')

    <!-- Main Footer -->

</div>
@include('partial.footer')

<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>
@yield('js')

<script type="text/javascript">
    $(document).ready(function (){


        fetch_delivery();

        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : "{{route('select_feeship')}}",
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                    $('#result_feeship').html(data);
                }
            });
        }
        $(document).on('blur','.fee_feeship_edit',function(){

            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
            var _token = $('input[name="_token"]').val();
            alert(feeship_id);
            alert(fee_value);
            $.ajax({
                url : "{{route('update_delivery')}}",
                method: 'POST',
                data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
                success:function(data){
                    fetch_delivery();
                }
            });

        });

        $('.delivery_ship').click(function (){
            var city_id = $('.city').val();
            var province_id = $('.province').val();
            var ward_id = $('.award').val();
            var ship_id = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
           // alert(city_id);
           // alert(province_id);
           // alert(ward_id);
           // alert(ship_id);

            $.ajax({
                url: "{{route('insert_delivery')}}",
                method:'POST',
                data:{city_id:city_id,province_id:province_id,ward_id:ward_id,ship_id:ship_id,_token:_token},
                success:function (data){
                    alert('Them phi van chuyen thanh cong');
                }
            });

        });

        $('.chonselect').change(function (){
            var action =$(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result='';
            if(action=='city'){
               result='province';
            }else{
                result='wards';
            }

            $.ajax({
                url: "{{route('delivery')}}",
                method:'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function (data){
                    $('#'+result).html(data);
                }
            });
        });

        /* xu li trang thai*/
        $('.order_details').change(function (){
            var id_don =$(this).attr('id');
            var trangthai = $(this).val();
            var _token = $('input[name="_token"]').val();
            // alert(action);
            // alert(value);


            $.ajax({
                url: "{{route('handel_order_status')}}",
                method:'POST',
                data:{id_don:id_don,trangthai:trangthai,_token:_token},
                success:function (){
                     alert('Xử lí thành công');
                }
            });
        });

    });

</script>
</body>
</html>


