<?php

namespace App\Repository;
use App\Models\JobPosition;

class JobPositionRepository{
  private $query;

  public function __construct(JobPosition $query)
  {
    $this->query = $query;
  }

  public function dataTable(){
      return $this->query->query()->orderBy('title','asc');
  }

  public function get()
  {
    return $this->query->orderBy('title','asc')->get();
  }

  public function store(array $data){
    return $this->query->create($data);
  }

  public function find($id)
  {
      return $this->query->findOrFail($id);
  }

  public function update(array $data, int $id)
  {
  
    return $this->query->where(['id'=>$id])->update($data);
  }

  public function delete($id)
  {
    return $this->query->where('id',$id)->delete($id);
  }
}