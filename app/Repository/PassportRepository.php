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
					->orderBy('first_name','asc');
	}

	public function create(array $data){
		return $this->query->create(array_merge($data,['created_by' => auth()->guard('admin')->user()->id]));
	}

	public function find(int $id){
		return $this->query->findOrFail($id);
	}

	public function update(array $data,int $id){
		$passport = $this->find($id);

		if(isset($data['image']) && !empty($passport->image) && file_exists( public_path() . '/uploaded/passports/'.$passport->image)){
			$file_path='uploaded/passports/'.$passport->image;
	        unlink($file_path);
		}
		
		return $passport->update($data);
	}


}