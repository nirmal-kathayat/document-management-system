<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    protected $guarded = [];

    public function setImageAttribute($value){
        $destination='uploaded/passports/';
        $imageName = time().'_'.$value->getClientOriginalName();  
        $value->move($destination,$imageName);
        $this->attributes['image'] =$imageName;
    }
}
