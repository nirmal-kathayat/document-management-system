<?php
namespace App\Repository;
use App\Models\Country;

class CountryRepository{
  private $country;
  public function __construct(Country $country)
  {
    $this->country = $country;
  }

  public function getAllCountries()
  {
    return Country::leftJoin('continents', 'continents.id', '=', 'countries.continent_id')
    ->select('countries.*', 'continents.title as continent_title')
    ->get();
  }

  public function storeCountries(array $data)
  {
    // dd($data);
    $data = [
      'continent_id'=>$data['continent_id'],
      'title'=>$data['title']
    ];

    return $this->country->create($data);
  }

  public function findCountry($id)
  {
    $country =  $this->country;
    if (!is_array($id)) {
      return $country->findOrFail($id);
    } else {
      return $country->whereIn('id', $id)->get();
    }
  }

  public function updateCountry(array $data, int $id)
  {
    $data = [
      'continent_id'=>$data['continent_id'],
      'title'=>$data['title']
    ];

    return $this->country->where('id',$id)->update($data);
  }

  public function deleteCountry($id)
  {
    return $this->country->where('id',$id)->delete($id);
  }
}