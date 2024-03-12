<?php

namespace App\Repository;
use App\Models\JobPosition;

class JobPositionRepository{
  private $jobPosition;

  public function __construct(JobPosition $jobPosition)
  {
    $this->jobPosition = $jobPosition;
  }

  public function getAllJobs()
  {
    return JobPosition::all();
  }

  public function storeJobPosition(array $data){
    $data = [
      'title'=>$data['title'],
      'isDescription'=>$data['isDescription']
    ];

    return $this->jobPosition->create($data);
  }

  public function findJobs($id)
  {
    $jobPosition =  $this->jobPosition;
    if (!is_array($id)) {
      return $jobPosition->findOrFail($id);
    } else {
      return $jobPosition->whereIn('id', $id)->get();
    }
  }

  public function updateJobs(array $data, int $id)
  {
    $data = [
      'title'=>$data['title'],
      'isDescription'=>$data['isDescription']
    ];

    return $this->jobPosition->where(['id'=>$id])->update($data);
  }

  public function deleteJobs($id)
  {
    return $this->jobPosition->where('id',$id)->delete($id);
  }
}