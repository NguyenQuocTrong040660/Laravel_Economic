<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['matp','name','type'];

    protected $primaryKey = 'matp';
    protected $table = 'devvn_tinhthanhpho';
}
