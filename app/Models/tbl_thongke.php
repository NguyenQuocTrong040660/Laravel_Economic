<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_thongke extends Model
{
    use HasFactory;
    protected $fillable = ['id','order_date','doanh_thu','loi_nhuan','total_order'];

    protected $primaryKey = 'id';
    protected $table = 'tbl_thongkes';
}
