<?php 
namespace App\Repository;
use App\Models\Passport;

class PassportRepository{
	private $query;
	public function __construct(Passport $query){
		$this->query = $query;
	}


	public function create(array $data){

		return $this->query->create(array_merge($data,['created_by' => auth()->guard('admin')->user()->id]));
	}


}