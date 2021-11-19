<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $fillable = ['order_code','product_id','product_name','product_price','product_quantity'];

    protected $primaryKey = 'order_detail_id';
    protected $table = 'order_details';
    public function product(){
        return $this->belongsTo(product::class,'product_id');
    }
}
