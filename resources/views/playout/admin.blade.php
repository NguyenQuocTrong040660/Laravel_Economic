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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

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


            $.ajax({
                url: "{{route('insert_delivery')}}",
                method:'POST',
                data:{city_id:city_id,province_id:province_id,ward_id:ward_id,ship_id:ship_id,_token:_token},
                success:function (data){
                    alert('Them phi van chuyen thanh cong');
                    location.reload();
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
                    location.reload();
                }
            });
        });

    });

</script>


<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script>
    $(function() {
        $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
    } );
</script>



<script type="text/javascript">
    $(document).ready(function(){


        //chart60daysorder();
        var chart = new Morris.Bar({

            element: 'myfirstchart',
            //option chart
            lineColors:  ['#819C79', '#fc8710','#FF6541', '#A4ADD3', '#766B56'],
            parseTime: false,
            resize:true,
            hideHover: 'auto',
            xkey: 'order_date',
            ykeys: ['total_order','doanh_thu','loi_nhuan'],
            labels: ['Số đơn hàng','doanh số','lợi nhuận']


        });


        //Gui ket qua qua router qua ordercontroller xu li ket qua

    $('#datepicker2').change(function(){

        var _token = $('input[name="_token"]').val();

        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();

        $.ajax({
            url:"{{route('loc-doanh-thu')}}",
            method:"POST",
            dataType:"JSON",
            data:{from_date:from_date,to_date:to_date,_token:_token},

            success:function(data)
            {
                chart.setData(data);
            }
        });

    });

    //Select Option

        $('.dashboard-filter').change(function(){

            var dashboard_value = $(this).val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{route('filter_order_now_day')}}",

                method:"POST",

                data:{dashboard_value:dashboard_value,_token:_token},

                success:function(data)
                {
                    $('#result_option_thongke_sp').html(data);

                }
            });

        });


    });






</script>
</body>
</html>


