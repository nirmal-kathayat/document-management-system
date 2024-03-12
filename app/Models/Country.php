<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];

    public function continent()
    {
        return $this->belongsTo(Continent::class,'id','continent_id');
    }
}
