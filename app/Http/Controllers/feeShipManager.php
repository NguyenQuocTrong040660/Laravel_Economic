<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\fee_ship;

use App\Models\Province;
use App\Models\Wards;
use Illuminate\Http\Request;

class feeShipManager extends Controller
{
    public function update_delivery(Request $request){
        $data = $request->all();
        $fee_ship = fee_ship::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'],'.');
        $fee_ship->fee_feeship = $fee_value;
        $fee_ship->save();
    }
    public function select_feeship(){
        $feeship = fee_ship::orderby('fee_id','ASC')->get();
        $output = '';
        $output .= '<div class="table-responsive">
			<table class="table table-bordered">
				<thread class="thead-dark">
					<tr>
					    <th>#</th>
						<th>Tên thành phố</th>
						<th>Tên quận huyện</th>
						<th>Tên xã phường</th>
						<th>Phí ship(VNĐ)</th>
					</tr>
				</thread>
				<tbody>
				';
        $i=0;
        foreach($feeship as $key => $fee){
          $i +=1;
            $output.='
					<tr>
					    <td>'.$i.'</td>
						<td>'.$fee->city->name.'</td>
						<td>'.$fee->province->name.'</td>
						<td>'.$fee->wards->name.'</td>
						<td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.number_format($fee->fee_feeship,0,',','.').'</td>
					</tr>
					';
        }

        $output.='
				</tbody>
				</table></div>
				';

        echo $output;


    }

    public function insert_delivery(Request $request){
        $data = $request->all();
        $fee_ship = new fee_ship();
        $fee_ship->fee_matp = $data['city_id'];
        $fee_ship->fee_maqh = $data['province_id'];
        $fee_ship->fee_xaid = $data['ward_id'];
        $fee_ship->fee_feeship = $data['ship_id'];
        $fee_ship->save();
    }

    public function feeShipManager(){
            $city= City::all();

        return view('admin.feeShip.index',compact('city'));
    }
    public function select_delivery(Request $request)
    {
        $data = $request->all();
        $ma_id =  $data['ma_id'];


        if ($data['action']) {
            $output ='';
            if ($data['action']=="city") {
                $select_province = Province::where('matp',$ma_id)->get();

                $output.= '<option>--Chọn quận huyện --</option>';
                foreach($select_province as  $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name.'</option>';

                }

            } else {

                $select_ward = Wards::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output.= '<option>--Chọn phường xã--</option>';
                foreach ($select_ward as $key => $Wards) {

                    $output.= '<option value="' . $Wards->xaid. '">' . $Wards->name . '</option>';

                }

            }
            echo $output;

        }

    }
}
