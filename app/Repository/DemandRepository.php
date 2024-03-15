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

  public function getAllExperiences()
  {
    return Experience::pluck('experience', 'id');
  }

  public function getAllDemands()
  {
    return Demand::all();
  }

  public function get($params=[]){
    $query = $this->query;
    if(isset($params['country_id'])){
      $query = $query->where('country_id',$params['country_id']);
    }
    return $query->orderBy('title','asc')->get();
  }
  public function store(array $data)
  {

    return $this->query->create($data);
  }

  public function find($id)
  {
    $demand =  $this->query;
    if (!is_array($id)) {
      return $demand->findOrFail($id);
    } else {
      return $demand->whereIn('id', $id)->get();
    }
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