<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categogy extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','parent_id','slug'];

    public function categogiesChild(){
        return $this->hasMany(Categogy::class,'parent_id');
    }
}
