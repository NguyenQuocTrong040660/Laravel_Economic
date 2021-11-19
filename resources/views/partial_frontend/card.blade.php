
<div class="container">

<div class="row">
           <div class="giohangcuaban"> Giỏ hàng của bạn</div>
            <hr>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <th>#</th>
                        <th class="image">Hình ảnh</th>
                        <th class=" description">Tên sản phẩm</th>
                        <th class=" price">Giá</th>
                        <th class="quantity">Số lượng</th>
                        <th class="total">Thành tiền</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $tongtien = 0;
                    $ii=0;
                    $i=0;
                    ?>

                    @foreach($cart as $key=>$cartItem)

                        <?php
                            $i++;
                        $tongtien =$tongtien+ ($cartItem['price'] * $cartItem['quantity']);
                        ?>
                        <tr>
                            <td>{{$i}}</td>
                            <td class="cart_product">
                              <img src="{{$cartItem['image']}}" alt="{{$cartItem['name']}}" width="100" height="100">

                            </td>
                            <td class="cart_description">
                                <p>{{$cartItem['name']}}</p>

                            </td>
                            <td class="cart_price">
                                <p>{{number_format($cartItem['price']). 'vnđ'}}</p>
                            </td>
                           <td>
                                <div class="cart_quantity">

                                    <div class="pro_qty">
                                        <span class="dec qtybtn" data="{{$key}}">-</span>
                                      <input id="carqtyti_{{$key}}" type="text"  value="{{$cartItem['quantity']}}" >
                                        <span class="inc qtybtn"  data="{{$key}}">+</span>
                                    </div>

                                </div>
                           </td>



                            <td class="cart_total">
                                <p style="color: red" class="cart_total_price">
                                    {{number_format($cartItem['price'] * $cartItem['quantity']).'vnđ'}}
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete xoacart"  href="{{route('deletecart',$cartItem['product_id'])}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>



            <div class="row">

                <div class="col-sm-6">


                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Tổng  <span>{{number_format($tongtien). 'vnđ'}}</span></li>


                        </ul>


                        <?php
                        if(session()->has('customer_name')){
                        ?>
                        <a class="btn check_out" href="{{route('thanhtoan')}}">Thanh toán</a>
                        <?php
                        }
                        else{
                        ?>
                        <a class="btn btn-default check_out" href="{{route('check_acount')}}">Thanh toán</a>


                    </div>
                </div>
            </div>

                    <?php
                    }
                    ?>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
<script type="text/javascript">



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

    /*-----------
    Delete cart

     -----------*/

</script>
