<?php

namespace App\Http\Controllers;

use App\Models\Categogy;
use App\Models\product;
use App\Models\Silder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        //get all slider
        $all_slider = Silder::latest()->get();

        //get all categogies
        $all_categogies = Categogy::where('parent_id',0)->get();


        $product = product::paginate(9);

        return view('home_frontend',compact('all_slider','all_categogies','product'));
    }
}
