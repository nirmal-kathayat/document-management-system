<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
   protected $guarded = [];

    public function passportDetails()
    {
        return $this->belongsTo(Passport::class,'passport_id');
    }

    public function setFamilyDetailsAttribute($value){
        $this->attributes['family_details'] =  json_encode($value);
    }

    public function getFamilyDetailsAttribute($value){
    	return json_decode($value, true); 
    }

    public function setPersonalDetailsAttribute($value){
      $this->attributes['personal_details'] = json_encode($value);
    }

    public function getPersonalDetailsAttribute($value){
   		return json_decode($value, true); 
    }

    public function setExperiencesAttribute($value){
      $this->attributes['experiences'] = json_encode($value);
    }

    public function getExperiencesAttribute($value){
      return json_decode($value,true);
    }

    public function setEducationsAttribute($value){
      $this->attributes['educations'] = json_encode($value);
    }

     public function getEducationsAttribute($value){
      return json_decode($value,true);
    }

    public function setOnJobChecklistAttribute($value){
      $this->attributes['on_job_checklist'] = json_encode($value);
    }

     public function getOnJobChecklistAttribute($value){
      return json_decode($value,true);
    }

    public function setPersonalChecklistAttribute($value){
      $this->attributes['personal_checklist'] = json_encode($value);
    }

     public function getPersonalChecklistAttribute($value){
      return json_decode($value,true);
    }

    public function setAttachmentsAttribute($value){
      $this->attributes['attachments'] = json_encode($value);
    }

    public function getAttachmentsAttribute($value){
      return json_decode($value,true);
    }
}
