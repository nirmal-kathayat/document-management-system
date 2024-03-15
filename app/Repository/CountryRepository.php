<?php
namespace App\Repository;
use App\Models\Country;
class CountryRepository{
  private $query;
  public function __construct(Country $query)
  {
    $this->query = $query;
  }

  public function getAllCountries()
  {
    return Country::leftJoin('continents', 'continents.id', '=', 'countries.continent_id')
    ->select('countries.*', 'continents.title as continent_title')
    ->get();
  }

  public function dataTable($params = []){
      return $this->query
                  ->query()
                  ->leftJoin('continents', 'continents.id', '=', 'countries.continent_id')
                  ->select('countries.id','countries.title','continents.title as continent_title','countries.created_at')
                  ->orderBy('countries.created_at','desc');
  }

  public function storeCountries(array $data)
  {
    $data = [
      'continent_id'=>$data['continent_id'],
      'title'=>$data['title']
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
      'continent_id'=>$data['continent_id'],
      'title'=>$data['title']
    ];

    return $this->query->where('id',$id)->update($data);
  }

  public function deleteCountry($id)
  {
    return $this->query->where('id',$id)->delete($id);
  }
}