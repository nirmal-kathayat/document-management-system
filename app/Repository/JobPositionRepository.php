<?php

namespace App\Repository;
use App\Models\JobPosition;

class JobPositionRepository{
  private $query;

  public function __construct(JobPosition $query)
  {
    $this->query = $query;
  }

  public function getAllJobs()
  {
    return JobPosition::all();
  }

  public function storeJobPosition(array $data){
  

    return $this->query->create($data);
  }

  public function findJobs($id)
  {
    $jobPosition =  $this->query;
    if (!is_array($id)) {
      return $jobPosition->findOrFail($id);
    } else {
      return $jobPosition->whereIn('id', $id)->get();
    }
  }

  public function updateJobs(array $data, int $id)
  {
  
    return $this->query->where(['id'=>$id])->update($data);
  }

  public function deleteJobs($id)
  {
    return $this->query->where('id',$id)->delete($id);
  }
}