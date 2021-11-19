<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Categogy;
class product extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','content','user_id','category_id','feature_image_path','img_name'];


    //su dung eloquen relationship 1 sp co nhieu hinh anh chi tiet
    public function images(){
        return $this->hasMany(product_image::class,'product_id');
    }

    // 3 table : product<->product_tags<->tag
    //insert intermedia Table :Product_tag
    public function product_tags(){
        return $this->belongsToMany(tag::class,'product_tags','product_id','tag_id')->withTimestamps();
    }

    //category co nhieu sampham Va sp thuoc 1 catagory -> belongto
    public function caterogy(){
       return $this->belongsTo(Categogy::class,'category_id','id');
    }
}
