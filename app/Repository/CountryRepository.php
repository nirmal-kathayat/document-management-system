<?php

namespace App\Repository;

use App\Models\Country;

class CountryRepository
{
  private $query;
  public function __construct(Country $query)
  {
    $this->query = $query;
  }

<<<<<<< HEAD
  public function getAllCountries()
  {
    return Country::leftJoin('continents', 'continents.id', '=', 'countries.continent_id')
      ->select('countries.*', 'continents.title as continent_title')
      ->get();
  }

  public function dataTable($params = [])
  {
    return $this->query
      ->query()
      ->leftJoin('continents', 'continents.id', '=', 'countries.continent_id')
      ->select('countries.id', 'countries.title', 'continents.title as continent_title', 'countries.created_at')
      ->orderBy('countries.created_at', 'desc');
=======

  public function get($params = []){
    $query = $this->query;
    if(isset($params['continent_id'])){
      $query = $query->where('continent_id',$params['continent_id']);
    }
    $query =    $query
                ->select('id','title','created_at')
                ->orderBy('title','asc')
                ->get();
    return $query;
  }

  public function dataTable($params = []){
      return $this->query
                  ->query()
                  ->leftJoin('continents', 'continents.id', '=', 'countries.continent_id')
                  ->select('countries.id','countries.title','continents.title as continent_title','countries.created_at')
                  ->orderBy('countries.title','asc');
>>>>>>> b222d5bbc6fcf2f08755ba2a13b61cbb0dc86edd
  }

  public function storeCountries(array $data)
  {
    $data = [
      'continent_id' => $data['continent_id'],
      'title' => $data['title']
    ];

    return $this->query->create($data);
  }

  public function findCountry($id)
  {
    return  $this->query->findOrFail($id);
  }

  public function updateCountry(array $data, int $id)
  {
    $data = [
      'continent_id' => $data['continent_id'],
      'title' => $data['title']
    ];

    return $this->query->where('id', $id)->update($data);
  }

  public function deleteCountry($id)
  {
    return $this->query->where('id', $id)->delete($id);
  }
}
