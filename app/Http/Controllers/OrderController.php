<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\product;
use App\Models\Province;
use App\Models\shipping_oder;
use App\Models\User;
use App\Models\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function manage_order()
    {
        $getorder = Order::orderby('order_id', 'DESC')->paginate(5);
        return view('admin.order.index')->with(compact('getorder'));
    }

    public function view_order($order_code){
        $order_details = Order_detail::where('order_code',$order_code)->get();
        $getorder = Order::where('order_code',$order_code)->get();
        foreach($getorder as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = User::where('id',$customer_id)->first();
        $shipping = shipping_oder::with('tinh')->where('shipping_id',$shipping_id)->first();

        $matp=$shipping->shipping_matp;
        $maqh = $shipping->shipping_maqh;
        $xaid = $shipping->shipping_xaid;
        $tinh = City::where('matp',$matp)->first();
        $thanhpho = Province::where('maqh',$maqh)->first();
        $xa =  Wards::where('xaid',$xaid)->first();




        $order_details_product = Order_detail::with('product')->where('order_code', $order_code)->get();

        return view('admin.order.view_order')->with(compact('order_details','tinh','thanhpho','xa','customer','shipping','getorder'));

    }

    public function handel_order_status(Request $request){
        $data = $request->all();
        if($data['id_don']){
            $update_status_order = Order::where('order_id',$data['id_don'])->update([
                'order_status'=>$data['trangthai']
            ]);
        }

    }
    //Doanh thu san phẩm
    public function DoanhThu(){

        $doanhthu = DB::table('order_details')
             ->select('product_id',DB::raw('SUM(product_quantity) as total_quantity'))
            ->groupBy('product_id');




      //join voi bang products
        $dataproduct = DB::table('products')
            ->joinSub($doanhthu, 'sub_doanhthu', function ($join) {
                $join->on('id', '=', 'sub_doanhthu.product_id');
            })->get();


       return view('admin.danhthu.index',compact('doanhthu','dataproduct'));




    }

    //frontend
    public function history_order(){

       if(session()->get('customer_id')) {
           $customer_id = session()->get('customer_id');

           $getorder = Order::where('customer_id',$customer_id )->get();

           return view('product_frontend.order.index', compact('getorder'));
       }

    }
    public function view_order_frontend($order_code){
        $order_details = Order_detail::where('order_code',$order_code)->get();
        $getorder = Order::where('order_code',$order_code)->get();
        foreach($getorder as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = User::where('id',$customer_id)->first();
        $shipping = shipping_oder::with('tinh')->where('shipping_id',$shipping_id)->first();

        $matp=$shipping->shipping_matp;
        $maqh = $shipping->shipping_maqh;
        $xaid = $shipping->shipping_xaid;
        $tinh = City::where('matp',$matp)->first();
        $thanhpho = Province::where('maqh',$maqh)->first();
        $xa =  Wards::where('xaid',$xaid)->first();




        $order_details_product = Order_detail::with('product')->where('order_code', $order_code)->get();

        return view('product_frontend.order.view')->with(compact('order_details','tinh','thanhpho','xa','customer','shipping','getorder'));

    }

}
