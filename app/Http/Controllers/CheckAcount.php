<?php

namespace App\Http\Controllers;

use App\Models\Categogy;
use App\Models\City;
use App\Models\customer;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\shipping;
use App\Models\customer_social;
use App\Models\shipping_oder;
use App\Models\Silder;
use App\Models\tbl_thongke;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Province;
use App\Models\Wards;
use App\Models\fee_ship;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;
use PhpParser\Node\Expr\Array_;
session_start();
class CheckAcount extends Controller
{
    public function checkcount()
    {
        return view('product_frontend.checkcount.login');

    }

    public function registerCustomer(Request $request)
    {
        $id_customer = User::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->pass),

        ]);
        $request->session()->put('customer_id', $id_customer);
        $request->session()->put('customer_name', $request->name);


        return redirect()->route('thanhtoan');
    }

    //login
    public function checkLogin(Request $request){
        $remember_me = $request->has('remember-me')? true : false;
        if(Auth::attempt([
            'name'=>$request->username,
            'password'=>$request->password,
        ], $remember_me)) {
            $request->session()->put('customer_name',$request->username);
            $city=City::all();
            return view('product_frontend.checkcount.thanhtoan',compact('city'));
        }else{

            return redirect()->route('check_acount');
        }
    }

    //logout
    public function logout(){
        session()->flush();
        return redirect()->route('check_acount');
    }


    //login facebook

    public function login_facebook(){

        return Socialite::driver('facebook')->stateless()->redirect();

    }

    public function callback_facebook(){
        // result info loginfacebook
        $provider = Socialite::driver('facebook')->stateless()->user();
     $user_id = $provider->getId();

       //truyvan xen bang co row??
       $account = customer_social::where('provider','facebook')->where('provider_user_id',$user_id)->first();

        if($account != NULL){

            $account_name = User::where('id',$account->user)->first();
            session()->put('customer_id',$account_name->id);
            session()->put('customer_name',$account_name->name);

            return redirect()->route('homefrontend');
        }
        elseif($account==NULL){
           //insert data vao customer_social
            $customer_login = new customer_social([
                'provider_user_id' => $provider->getId(),
                'provider_user_email'=>$provider->getEmail(),
                'provider' => 'facebook'
            ]);

            //check acount user when loginfacebook
            $User = User::where('email',$provider->getEmail())->first();

            if(!$User){
                $User = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',

                ]);
            }
            //Insert to customer_social
            $customer_login->customerSocial()->associate($User);
            $customer_login->save();

            $account_new = User::where('id',$customer_login->user)->first();

            session()->put('customer_name',$customer_login->name);
            session()->put('customer_id',$customer_login->id);
            return redirect()->route('homefrontend');
        }
    }






    public function thanhtoan()
   {
       $all_slider = Silder::latest()->get();
       $all_categogies = Categogy::where('parent_id',0)->get();
       $city =City::all();
       return view('product_frontend.checkcount.thanhtoan',compact('all_slider','all_categogies','city'));
   }
   public function storeShipping(Request $request){


        $shipping_id = shipping::insertGetId([
            'name'=>$request->shipping_name,
            'phone'=>$request->shipping_phone,
            'address'=>$request->shipping_addess,
        ]);
       session()->put('shipping_id',$shipping_id);
        return redirect()->route('payment');

   }

   //thanh toan
   public function payment(){
       $all_slider = Silder::latest()->get();
       $all_categogies = Categogy::where('parent_id',0)->get();
        return view('product_frontend.payment.payment',compact('all_categogies','all_slider'));
}


 public function shipping_oder(Request $request){
        $data = $request->all();


     //lay gia tri feeship
     $fee_ship = $request->session()->get('get_fee_ship');
     foreach ($fee_ship as $key=>$fee_ship){
         $fee = $fee_ship->fee_feeship;

     }

        $shipping = shipping_oder::create([
             'shipping_name'=>$data['name'],
            'shipping_phone'=>$data['phone'],
            'medthod_payment'=>$data['payment'],
            'shipping_matp'=> $data['city'] ,
           'shipping_maqh'=>$data['province'],
           'shipping_xaid'=>$data['wards'],
            'fee_ship'=>$fee

        ]);
       $shipping_id =$shipping->shipping_id;



     $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
       $check_code = substr(md5(microtime()),rand(0,16),5);
       $oders = Order::create([
           'customer_id' => session()->get('customer_id'),
           'shipping_id'=>$shipping_id,
           'order_status'=>1,
           'order_code'=>$check_code,
           'order_date'=>$now
       ]);



         if( session()->get('cart')==true){
             foreach( session()->get('cart') as $key => $cart){
               $order_details = Order_detail::create([
                 'order_code'=>$check_code,
                 'product_id' => $cart['product_id'],
                 'product_name' => $cart['name'],
                 'product_price' => $cart['price'],
                'product_quantity'=> $cart['quantity'],


             ]);
         }
     }

         session()->forget('cart');
         session()->forget('get_fee_ship');


    }




 public function delete_fee_ship(){
        session()->forget('fee_ship');
        return redirect()->back();

 }

    public function TinhPhiVanChuyen(Request $request){
        $data =$request->all();
        $city= $data['city'];
        $province= $data['province'];
        $wards= $data['wards'];

        $get_fee_ship= fee_ship::where('fee_matp',$city)->where('fee_maqh',$province)->where('fee_xaid',$wards)->get();

        session()->put('get_fee_ship', $get_fee_ship);




    }

    //delete_fee_ship
    public function xoaPhiVanChuyen(){
        session()->forget('get_fee_ship');
        return redirect()->back();

    }

}
