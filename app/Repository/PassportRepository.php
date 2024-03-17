<?php 
namespace App\Repository;
use App\Models\Passport;

class PassportRepository{
	private $query;
	public function __construct(Passport $query){
		$this->query = $query;
	}

	public function dataTable($params=[]){
		return $this->query
					->query()
					->leftJoin('applicants', function($join) {
				        $join->on('applicants.passport_id', '=', 'passports.id');
				    })
				    ->select('passports.*', \DB::raw('IF(applicants.passport_id IS NULL, false, true) AS isApplicant'),\DB::raw('IF(applicants.passport_id IS NULL, NULL, applicants.id) AS applicant_id'))
					->orderBy('first_name','asc');
	}

	public function create(array $data){
		return $this->query->create(array_merge($data,['created_by' => auth()->guard('admin')->user()->id]));
	}

	public function find(int $id){
		return $this->query->findOrFail($id);
	}

	public function update(array $data,int $id){
		$query = $this->find($id);

		if(isset($data['image']) && !empty($query->image) && file_exists( public_path() . '/uploaded/passports/'.$query->image)){
			$file_path='uploaded/passports/'.$query->image;
	        unlink($file_path);
		}
		
		$query->update($data);

		return $query;
	}


}