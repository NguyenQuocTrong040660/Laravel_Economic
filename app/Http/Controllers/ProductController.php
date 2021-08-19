<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public  function index(){

        return view('admin.product.index');
    }
    //onclick on nut ADD
    public function add(){
        return view('admin.product.add');

    }
}
