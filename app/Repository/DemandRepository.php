<?php

namespace App\Repository;
use App\Models\Demand;
use App\Models\Experience;

class DemandRepository
{
  private $demand;
  public function __construct(Demand $demand)
  {
    $this->demand = $demand;
  }

  public function getAllExperiences()
  {
    return Experience::pluck('experience', 'id');
  }

  public function getAllDemands()
  {
    return Demand::all();
  }

  public function storeDemands(array $data)
  {

    $data = [
      'date'=>$data['date'],
      'demand_name'=>$data['demand_name'],
      'salary'=>$data['salary'],
      'experience'=>$data['experience'],
      'country'=>$data['country'],
      'comment'=>$data['comment']
    ];

    return $this->demand->create($data);
  }

  public function findDemand($id)
  {
    $demand =  $this->demand;
    if (!is_array($id)) {
      return $demand->findOrFail($id);
    } else {
      return $demand->whereIn('id', $id)->get();
    }
  }

  public function updateDemand(array $data,int $id)
  {
    $data = [
      'date'=>$data['date'],
      'demand_name'=>$data['demand_name'],
      'salary'=>$data['salary'],
      'experience'=>$data['experience'],
      'country'=>$data['country'],
      'comment'=>$data['comment']
    ];
    return $this->demand->where('id',$id)->update($data);
  }

  public function deleteDemand($id)
  {
    return $this->demand->where('id',$id)->delete($id);
  }
}