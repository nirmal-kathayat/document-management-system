<?php

namespace App\Repository;

use App\Models\Continent;

class ContinentRepository
{
  private $query;
  public function __construct(Continent $query)
  {
    $this->query = $query;
  }


  public function get(){
    return $this->query->get();
  }



}
