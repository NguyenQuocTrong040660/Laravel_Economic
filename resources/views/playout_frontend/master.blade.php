<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('title')
    <link href="{{asset('Eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/sweetalert.css')}}" rel="stylesheet">
    @yield('css')
    <!--[if lt IE 9]>
    <script src="{{asset('Eshopper/js/html5shiv.js')}}"></script>
    <script src="{{asset('Eshopper/js/respond.min.js')}}"></script>

    <![endif]-->
    <link rel="shortcut icon" href="Eshopper/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('Eshopper/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('Eshopper/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('Eshopper/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('Eshopper/images/ico/apple-touch-icon-57-precomposed.png')}}">

</head>
<body>

<div>

    @include('partial_frontend.header')

    @yield('content')

    @include('partial_frontend.footer')

    <script src="{{asset('Eshopper/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('Eshopper/js/jquery.js')}}"></script>
    <script src="{{asset('Eshopper/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('Eshopper/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('Eshopper/js/price-range.js')}}"></script>
    <script src="{{asset('Eshopper/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('Eshopper/js/main.js')}}"></script>

    @yield('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script type="text/javascript">


        //Ajax handel Hien thi so luong 1 2 3 khi addTocart
        slg_Adtocart();
        function slg_Adtocart(){
            $.ajax({
                url: "{{route('slg_AdtoCart')}}",
                method:'GET',
                success:function (data){
                    $('#slg_Adtocart').html(data);
                }
            });


        }



        //ajax them gio hang
      function  addTocart(event){
           event.preventDefault();
           let urlCart = $(this).data('url');

          $.ajax({
              type:"GET",
              url:urlCart,
              dataType:'json',
              success:function (data) {
                  console.log(data);
                  if(data.code===200){
                      // alert('Them gio hang thanh cong');

                  }
                  slg_Adtocart();

              },
              error:function (){

              },

          })
      };
      $(function (){
          $('.add-to-cart').on('click',addTocart);
      })

      //A jax nut + - so luong Product in cart
      function  updateCart(event) {
          event.preventDefault();
          var key = $(this).attr('data');
          var cartqty = $('#carqtyti_' + key).val();//soluongcart

          if ($(this).hasClass('inc')) {
              if (cartqty < 5) {
                  $('#carqtyti_' + key).val(parseInt(cartqty) + 1);
                  updatecart(key, parseInt(cartqty) + 1);
              }
          } else if ($(this).hasClass('dec')) {
              if (cartqty > 1){
                  $('#carqtyti_' + key).val(parseInt(cartqty) - 1);
                  updatecart(key, parseInt(cartqty) - 1);
              }
          }

      };

      //Cap nhat gio hang
      function updatecart(key,qty){
          $.ajax({
              url:"{{url('updatecart')}}/"+key+"/"+qty,
              success:function (result){

                  location.reload();
              }
          });
      };



      $(function (){
          $('.qtybtn').on('click',updateCart);

      });
        //Cap nhat gio hang

      /*-----------
      Delete cart

       -----------*/


        //-----------// Thanh toan - Dia chi giao hang


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

        //Tinh Phi Van Chuyen
       // btnVanChuyen

        $('.btnVanChuyen').click(function (){

            var city = $('#city').val();
            var province = $('#province').val();
            var wards = $('#wards').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{route('tinh-phi-van-chuyen')}}",
                method:'POST',
                data:{city:city,province:province,wards:wards,_token:_token},
                success:function (data){
                          location.reload();
                }
            });
        });

        //lay gia tri tinh phi
        $('.btnguidonhang').click(function (){

            Swal.fire({
                title: 'Xác nhận gủi đơn hàng',
                text: "Đơn sẽ không hoàn lại ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    var name = $('#shipping_name').val();
                    var phone = $('#shipping_phone').val();
                    var payment = $('.payment_select').val();
                    var city = $('#city').val();
                    var province = $('#province').val();
                    var wards = $('#wards').val();
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url: "{{route('shipping_oder')}}",
                        method:'POST',
                        data:{name:name,phone:phone,payment:payment,city:city,province:province,wards:wards,_token:_token},
                        success:function (){
                            Swal.fire('Saved!', '', 'success')
                        }
                    });
                    window.setTimeout(function (){
                            location.reload();
                    },2000);

                }else{

                }
            })



        });



    </script>
</div>
</body>
</html>
