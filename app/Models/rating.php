<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{

    public $timestamps = false; //set time to false
    protected $fillable = [
        'id_rating','order_code', 'product_id', 'number_rating'
    ];
    protected $primaryKey = 'id_rating';
    protected $table = 'tbl_rating';
}
