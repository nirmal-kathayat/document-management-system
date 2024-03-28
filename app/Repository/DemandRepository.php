<?php

namespace App\Repository;
use App\Models\Demand;
use App\Models\Experience;
use App\Models\DemandApplicant;
use Carbon\Carbon;
class DemandRepository
{
  private $query;
  public function __construct(Demand$query)
  {
    $this->query =$query;
  }

  public function dataTable($params= []){
    $query = $this->query->query();
    if(isset($params['country']) && !empty($params['country'])){
      $query = $query->where('demands.country_id',$params['country']);
    }
    if(isset($params['experience']) && !empty($params['experience'])){
      $query = $query->where('demands.experience_id', $params['experience']);

    }
    if(isset($params['from_date']) && isset($params['to_date']) && !empty($params['from_date']) && !empty($params['to_date'])){
      $query = $query->whereDate('demands.date', '>=', $params['from_date'])
                         ->whereDate('demands.date', '<=', $params['to_date']);
    }
    return $query
              ->leftJoin('experiences','experiences.id','demands.experience_id')
              ->leftJoin('countries','countries.id','demands.country_id')
              ->select('demands.*','experiences.experience','countries.title as country_name')
              ->orderBy('demands.date','desc');
  }

  public function get($params=[]){
    $query = $this->query;
    if(isset($params['country_id'])){
      $query = $query->where('country_id',$params['country_id']);
    }
    if(isset($params['not_expired'])){
       $query = $query->where('date', '>', Carbon::now()->format('Y-m-d'));
    }
    return $query
              ->orderBy('date','desc')->get();
  }


  public function store(array $data)
  {
    return $this->query->create($data);
  }

  public function find($id)
  {
      return $this->query
                ->findorFail($id);
  }

  public function update(array $data,int $id)
  {
    return $this->query->where('id',$id)->update($data);
  }

  public function delete($id)
  {
    return $this->query->where('id',$id)->delete($id);
  }


  public function applicants($params = [],$id){
    $query = DemandApplicant::query()
                ->where('demand_applicants.demand_id',$id);
    if(isset($params['status']) && !empty($params['status'])){
      $query = $query->where('demand_applicants.status',$params['status']);
    }
    if(isset($params['search']) && !empty($params['search'])){
      $query = $query->where('passports.first_name','like','%' . strtoupper($params['search']) . '%')
              ->orWhere('passports.last_name','like','%' . strtoupper($params['search']) . '%');
    } 
    if(isset($params['gender']) && !empty($params['gender'])){
      $query = $query->where('passports.gender',$params['gender']);
    }
    if(isset($params['country']) && !empty($params['country'])){
      $query = $query->where('applicants.country_id',$params['country']);
    }
    if(isset($params['position']) && !empty($params['position'])){
      $query = $query->where('applicants.job_position_id',$params['position']);
    }
    if(isset($params['age']) && !empty($params['age'])){
      $birthDate = Carbon::now()->subYears((int)$params['age'])->format('Y');
      $query = $query->whereYear('passports.dob', '<=', $birthDate - 1);
    }
    if(isset($params['experience']) && !empty($params['experience'])){
      $query = $query->where(\DB::raw("IFNULL(JSON_UNQUOTE(JSON_EXTRACT(applicants.experiences, '$.professionals[0].duration')), NULL)"), $params['experience']);
    }
    if(isset($params['from_date']) && isset($params['to_date']) && !empty($params['from_date']) && !empty($params['to_date'])){
      $query = $query->whereDate('passports.created_at', '>=', $params['from_date'])
                         ->whereDate('passports.created_at', '<=', $params['to_date']);
    }

    $query = $query
                ->leftJoin('applicants','applicants.id','demand_applicants.applicant_id')
                ->leftJoin('job_positions','job_positions.id','applicants.job_position_id')
                ->leftJoin('passports','passports.id','applicants.passport_id')
                ->leftJoin('countries','countries.id','applicants.country_id')
                ->select('demand_applicants.id','demand_applicants.applicant_id',\DB::raw("IFNULL(JSON_UNQUOTE(JSON_EXTRACT(applicants.experiences, '$.professionals[0].duration')), NULL) AS experience"),'passports.first_name','passports.last_name','passports.id as passport_id','applicants.job_position_id','job_positions.title as position_name','applicants.country_id','countries.title as country_name','passports.gender','passports.dob','demand_applicants.status','applicants.created_at')
                ->orderBy('applicants.created_at','desc');
    return $query;
  }


  public function removeApplicantFromDemand($id){
     return DemandApplicant::where('id',$id)->delete();
  }
}