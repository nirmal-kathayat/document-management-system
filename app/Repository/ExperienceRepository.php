<?php
namespace App\Repository;
use App\Models\Experience;
class ExperienceRepository{
	private $query;
	public function __construct(Experience $query){
		$this->query = $query;
	}

	public function get(){
		return $this->query->orderBy('created_at','asc')->get();
	}
}