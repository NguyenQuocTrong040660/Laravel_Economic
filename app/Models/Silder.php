<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Description;

class Silder extends Model
{
    use HasFactory;
    protected $fillable =['name','description','image_name','image_path'];
}
