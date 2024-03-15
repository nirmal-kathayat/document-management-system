<?php
namespace App\Repository;
use App\Models\Country;
class CountryRepository{
  private $query;
  public function __construct(Country $query)
  {
    $this->query = $query;
  }


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