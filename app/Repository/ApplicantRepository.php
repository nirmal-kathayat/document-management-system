<?php 
namespace App\Repository;
use App\Models\Applicant;

class ApplicantRepository{
	private $query;
	public function __construct(Applicant $query){
		$this->query = $query;
	}
}
