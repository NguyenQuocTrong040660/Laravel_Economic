<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\product;
use App\Models\Province;
use App\Models\shipping_oder;
use App\Models\tbl_thongke;
use App\Models\User;
use App\Models\Wards;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //Quan li don hang
    public function manage_order()
    {
        $getorder = Order::orderby('order_id', 'DESC')->paginate(5);
        return view('admin.order.index')->with(compact('getorder'));
    }

    //xem don hang
    public function view_order($order_code){
        $order_details = Order_detail::where('order_code',$order_code)->get(); // lay id don hang
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

    //XU LI TRANG THAI DON HANG
    public function handel_order_status(Request $request){
        $data = $request->all();

        if($data['id_don']){
            $update_status_order = Order::where('order_id',$data['id_don'])->update([
                'order_status'=>$data['trangthai']
            ]);
        }


        //lay du lieu don hang
        $order = Order::where('order_id',$data['id_don'])->get();
        foreach($order as $key => $ord){
            $order_id = $ord->order_id;
            $order_code= $ord->order_code;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
            $order_date = $ord->order_date;

        }

        if( $order_status == 2 ) {

            $phivanchuyen = shipping_oder::where('shipping_id', $shipping_id)->get(['fee_ship']);
            foreach ($phivanchuyen as $key=>$val){
                $fee_ship = $val->fee_ship;
            }



            //Tinh so tien cua don hang vua giao

            $doanhthu = Order_detail::where('order_code', $order_code)->get();

            //Tinh tien
            $sales = 0;
            $loi_nhuan=0;
            $total_order = 1;

            foreach ($doanhthu as $key => $val) {
                $sales += $val->product_price * $val->product_quantity * 1.1;
            }
            //DAONH THU
            $sales = $sales + $fee_ship ;

            //LOI NHUAN
            $loi_nhuan = $sales * 0.3;




            //cap nhat bang thong ke


            // Thong ke so row
               $statistic = tbl_thongke::where('order_date',$order_date)->get();
               if($statistic){
                   $statistic_count = $statistic->count();

               }else{
                   $statistic_count = 0;
               }

            if($statistic_count > 0){
                $update_status_order = tbl_thongke::where('order_date',$order_date)->get();
                foreach ($update_status_order as $key=>$value){

                    $doanh_thu1=$value->doanh_thu;
                    $loi_nhuan1=$value->loi_nhuan;
                    $total_order1=$value->total_order;
                }
                //Cap nhat Bang Thong Ke Don hang
                $update_status_order = tbl_thongke::where('order_date',$order_date)->update([
                    'doanh_thu'=> $doanh_thu1 + $sales,
                    'loi_nhuan'=> $loi_nhuan1+ $loi_nhuan,
                    'total_order'=> $total_order1 + $total_order
                ]);


            } else {
                       $shipping = tbl_thongke::create([
                           'order_date'=>$order_date,
                           'doanh_thu'=>$sales,
                           'loi_nhuan'=>$loi_nhuan,
                           'total_order'=>$total_order

                       ]);

                   }

               }



       }
       //  Doanh thu san phẩm
           public function DoanhThu(){


               $doanhthu = DB::table('order_details')
                    ->select('product_id',DB::raw('SUM(product_quantity) as total_quantity'))
                   ->groupBy('product_id');


             //join voi bang products
               $dataproduct = DB::table('products')->joinSub($doanhthu, 'sub_doanhthu', function ($join) {
                       $join->on('id', '=', 'sub_doanhthu.product_id');
                   })->get();

                // dd($dataproduct);
              return view('admin.danhthu.index',compact('doanhthu','dataproduct'));


           }

           //Thong Ke don hang ngay hom do bán được
    /*
           public function ThongKeDonhang(Request $request){

               $data = $request->all();
               $fromdate = $data['from_date'];
               $todate = $data['to_date'];
               $now = Carbon::now()
               $data = Order_detail::whereBetween('created_at',[$fromdate,$todate])->orderBy('created_at','ASC')->get();


               $sum=0;
               foreach ($data as $key => $val) {

                   $sum+=$val->product_price * $val->product_quantity;
                }


               foreach ($data as $key => $val){
                   $dataproduct[]= array(
                       "product_id"=>$val->product_id,
                       "product_name"=>$val->product_name,
                       "product_price"=>$val->product_price,
                       "product_quantity"=>$val->product_quantity,
                       "khoang_time"=> $val->created_at,
                       "thanh_tien" => $val->product_price * $val->product_quantity,
                       "tong_danh_thu"=>$sum
                   );
               }
               dd($dataproduct);


               echo $data = json_encode($dataproduct);

           }*/

    //Thong ke doanh thu theo Bang Su dung Ajax
    public function DoanhThuByDate(Request $request){
        $data = $request->all();
        $fromdate = $data['from_date'];
        $todate = $data['to_date'];


        $get = tbl_thongke::whereBetween('order_date',[$fromdate,$todate])->orderBy('created_at','ASC')->get();



        foreach ($get as $key => $val){
            $dataproduct[]= array(
                "order_date"=>$val->order_date,
                "doanh_thu"=>$val->doanh_thu,
                "loi_nhuan"=>$val->loi_nhuan,
                'total_order'=>$val->total_order

            );
        }

       echo $data = json_encode($dataproduct);
     /*
        $output = '';
        $output .= '<div class="table-responsive">
			<table class="table table-bordered">
				<thread class="thead-dark">
					<tr>
					    <th>#</th>
						<th>Tên sản phẩm</th>
						<th>Số lượng</th>
						<th>Giá bán</th>
						<th>Lợi nhuận(Danh thu - VAT10% - Phí vận Chuyển)</th>
						<th>Date</th>
					</tr>
				</thread>
				<tbody>
				';
        $i=0;
        $total=0;
        foreach($dataproduct as $key=>$doanhthu){

            $i++;
            $total = $doanhthu['tong_danh_thu'] ;
            $output.='
					<tr>
					    <td>'.$i.'</td>
						<td>'.$doanhthu['product_name'].'</td>
						<td>'.$doanhthu['product_quantity'] .'</td>
						<td>'.number_format($doanhthu['product_price']).'</td>
						<td>'.number_format($doanhthu['thanh_tien']).' '.'vnđ'.'</td>

                         <td>'.$doanhthu['khoang_time'].'</td>
					</tr>
					';
        }

        $output.='
				</tbody>
				</table></div>
				';

        echo $output;*/


    }
    //Loc Theo Ngay Thang Năm SelecOption

    public function filter_order_now_day(Request $request){

        $data = $request->all();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

       // $get = Order::where('order_date',$now)->where('order_status',2)->get();

      //
        $get = DB::table('orders')
            ->select('order_code')
            ->where('order_date',$now)->where('order_status',2);





        $tbl_join   = DB::table('order_details')
            ->joinSub($get, 'order_code', function ($join) {
                $join->on('order_details.order_code', '=', 'order_code.order_code');
            })->get();
        foreach ($tbl_join as $key=>$val) {
            $dataproduct[] = array(
                "product_id" => $val->product_id,
                "product_name" => $val->product_name,
                "product_price" => $val->product_price,
                'product_quantity' => $val->product_quantity,


            );
        }


        $output = '';
        $output .= '<div class="table-responsive">
			<table class="table table-bordered">
				<thread class="thead-dark">
					<tr>
					    <th>#</th>
						<th>Tên sản phẩm</th>
						<th>Số lượng</th>
						<th>Giá bán</th>
					</tr>
				</thread>
				<tbody>
				';
        $i=0;
        $total=0;
        foreach($dataproduct as $key=>$doanhthu){

            $i++;

            $output.='
					<tr>
					    <td>'.$i.'</td>
						<td>'.$doanhthu['product_name'].'</td>
						<td>'.$doanhthu['product_quantity'] .'</td>
						<td>'.number_format($doanhthu['product_price'] ).'</td>
					</tr>
					';
        }

        $output.='
				</tbody>
				</table></div>
				';

        echo $output;





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

        return view('product_frontend.order.view')
            ->with(compact('order_details','tinh','thanhpho','xa','customer','shipping','getorder'));

    }

}
