<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    protected $guarded = [];

    public function setImageAttribute($value){
        $destination='uploaded/passports/';
        $imageName = time().'.'.pathinfo($value->getClientOriginalName(), PATHINFO_EXTENSION); 
        $value->move($destination,$imageName);
        $this->attributes['image'] =$destination.$imageName;
    }
}
