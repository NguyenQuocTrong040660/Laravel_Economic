<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class tbl_social extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'provider_user_id','provider', 'user','provider_user_email'
    ];

    protected $primaryKey = 'user_id';
    protected $table = 'tbl_social';


    //them id moi nhat user vao socialcustomer
    public function login(){
       return $this->belongsTo(User::class,'user');
    }


}
