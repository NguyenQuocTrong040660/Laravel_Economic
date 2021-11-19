<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Silder;
use Illuminate\Http\Request;
use App\Models\Categogy;
session_start();

class CartController extends Controller
{

 public function saveCart(Request $request){
     $product_id = $request->product_id;
     $product_quality = $request->quality;

     $product_Info = product::where('id', $product_id )->first();

     $all_categogies = Categogy::where('parent_id',0)->get();

     $data['id']= $product_Info->id;
     $data['qty'] =$product_quality;
     $data['name']=$product_Info->name;
     $data['price']=$product_Info->price;
     $data['weight']="50";
     $data['options']['image']=$product_Info->feature_image_path;
     Cart::add($data);
     Cart::setGlobalTax(10);

     return redirect()->route('show_cart');

 }
 public function show_cart(){
     $all_slider = Silder::latest()->get();
     $all_categogies = Categogy::where('parent_id',0)->get();
     return view('product_frontend.cart.show_Cart',compact('all_categogies','all_slider'));
 }

 public function delete_cart($rowId){
     //dua so luong == 0 ve trang thai rong
     Cart::update($rowId,0);
     return redirect()->route('show_cart');

 }
 public function cart_update_quantity(Request $request){
     $rowId = $request->rowId;
     $quantity_cart = $request->quantity;
     Cart::update($rowId,$quantity_cart);
     return redirect()->route('show_cart');
 }

 //Ajax
    public function addToCartAjax($id){

              $product = product::find($id);
                 $cart = session()->get('cart');
              if(isset($cart[$id])){
                  $cart[$id]['quantity'] = $cart[$id]['quantity']+0;
              }else{
                  $cart[$id] = [
                      'product_id'=>$product->id,
                      'name'=>$product->name,
                      'price'=>$product->price,
                      'quantity' => 1,
                      'image'=>$product->feature_image_path,

                  ];
                 }
                  session()->put('cart',$cart);

               return response()->json([
                   'code'=>200,
                   'message'=>'Thêm giỏ hàng thành công'
               ],200);
              }
              public function show_cartAjax(){
                  $cart = session()->get('cart');
                  if($cart==true){
                  return view('product_frontend.cart.showcartAjax',compact('cart'));
                  }
                  else{
                      return redirect()->route('homefrontend');
                  }


              }

              public function updatecartAjax($key,$qty){

                  $cart = session()->get('cart');

                  $cart[$key]['quantity']=$qty;

                  session()->put('cart',$cart);

              }

              public function deletecartAjax($product_id)
              {
                  $cart = session()->get('cart');
                  if ($cart == true) {

                      foreach ($cart as $key => $cartItem)
                          if ($cartItem['product_id'] == $product_id) {
                              unset($cart[$key]);
                          }
                  }
                      session()->put('cart', $cart);
                      return redirect()->back()->with('message', 'Xóa sản phẩm thành công');
                  if($cart == NULL){
                      return redirect()->route('homefrontend');
                  }
              }

              //hien thi so luong 123 khithem cart (CodeAjax in Masster playout)

               public function hienThiSlgThemCart(){
              $solg_cart = count(session()->get('cart'));
              if($solg_cart > 0){
              $output = '';
              $output.='<span class="badges">'.$solg_cart.'</span>';
              echo $output;}

          }



}
