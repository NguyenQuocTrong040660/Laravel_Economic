<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipping_oder extends Model
{
    use HasFactory;

    protected $fillable = ['shipping_name','shipping_phone','medthod_payment','shipping_matp','shipping_maqh','shipping_xaid'];

    protected $primaryKey = 'shipping_id';
    protected $table = 'shipping_oders';

    public function tinh(){
        return $this->hasOne(City::class,'matp','shipping_matp');
    }
    public function thanhpho(){
        return $this->belongsTo(Province::class,'shipping_maqh','maqh');
    }
    public function xa(){
        return $this->belongsTo(Wards::class,'shipping_xaid','xaid');
    }

}
