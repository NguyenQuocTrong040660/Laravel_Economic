<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fee_ship extends Model
{
    use HasFactory;
    protected $fillable = ['fee_matp','fee_maqh','fee_xaid','fee_feeship'];
    protected $primaryKey = 'fee_id';
    protected $table = 'fee_ships';

    public function city(){
        return $this->belongsTo(City::class, 'fee_matp');
    }
    public function province(){
        return $this->belongsTo(Province::class, 'fee_maqh');
    }
    public function wards()
    {
        return $this->belongsTo(Wards::class, 'fee_xaid');
    }
}
