<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
   protected $guarded = [];

   public function setDutiesAttribute($value){
   		$this->attributes['duties'] = json_encode($value);
   }

   public function getDutiesAttribute($value){
   		return json_decode($value, true);
   }

    public function setJobQuestionsAttribute($value){
   		$this->attributes['job_questions'] = json_encode($value);
   }

   public function getJobQuestionsAttribute($value){
   		return json_decode($value, true);
   }
}
