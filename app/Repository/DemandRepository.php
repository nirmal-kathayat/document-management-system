<?php

namespace App\Repository;
use App\Models\Demand;
use App\Models\Experience;

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
    if(isset($params['position']) && !empty($params['position'])){
      $query = $query->where('demands.job_position_id',$params['position']);
    }
    if(isset($params['experience']) && !empty($params['experience'])){
      $query = $query->where('demands.experience_id', $params['experience']);

    }
    if(isset($params['from_date']) && isset($params['to_date']) && !empty($params['from_date']) && !empty($params['to_date'])){
      $query = $query->whereDate('demand.date', '>=', $params['from_date'])
                         ->whereDate('demand.date', '<=', $params['to_date']);
    }
    return $query
              ->leftJoin('job_positions','job_positions.id','demands.job_position_id')
              ->leftJoin('experiences','experiences.id','demands.experience_id')
              ->leftJoin('countries','countries.id','demands.country_id')
              ->select('demands.*','job_positions.title as position_name','experiences.experience','countries.title as country_name')
              ->orderBy('demands.date','desc');
  }

  public function get($params=[]){
    $query = $this->query;
    if(isset($params['country_id'])){
      $query = $query->where('country_id',$params['country_id']);
    }
    return $query->orderBy('date','desc')->get();
  }


  public function store(array $data)
  {

    return $this->query->create($data);
  }

  public function find($id)
  {
      return $this->query->findorFail($id);
  }

  public function update(array $data,int $id)
  {
    return $this->query->where('id',$id)->update($data);
  }

  public function delete($id)
  {
    return $this->query->where('id',$id)->delete($id);
  }
}