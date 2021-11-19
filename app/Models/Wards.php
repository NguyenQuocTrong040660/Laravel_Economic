<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['xaid','name','type','maqh'];

    protected $primaryKey = 'xaid';
    protected $table = 'devvn_xaphuongthitran';

}
