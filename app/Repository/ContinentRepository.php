<?php

namespace App\Repository;

use App\Models\Continent;

class ContinentRepository
{
  private $continent;
  public function __construct(Continent $continent)
  {
    $this->continent = $continent;
  }

  public function getContinentForSelect()
  {
    return Continent::pluck('title', 'id')->toArray();
  }

  public function getAllContinents()
  {
    return Continent::all();
  }

  public function storeContinent(array $data)
  {
    $data = [
      'title' => $data['title']
    ];

    return $this->continent->create($data);
  }

  public function findContinent($id)
  {
    $continent =  $this->continent;
    if (!is_array($id)) {
      return $continent->findOrFail($id);
    } else {
      return $continent->whereIn('id', $id)->get();
    }
  }

  public function updateContinent(array $data, int $id)
  {
    $data = [
      'title'=>$data['title']
    ];

    return $this->continent->where(['id'=>$id])->update($data);
  }

  public function deleteContinent($id){
    return $this->continent->where('id',$id)->delete($id);
  }
}
