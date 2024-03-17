<?php 
namespace App\Repository;
use App\Models\Applicant;
use App\Repository\PassportRepository;
class ApplicantRepository{
	private $query,$passportRepo;
	public function __construct(Applicant $query,PassportRepository $passportRepo){
		$this->query = $query;
		$this->passportRepo = $passportRepo;
	}



	public function store(array $data,$passportId=null){
		$passportDetails = $data['passport_details'] ?? null;
		if(!empty($passportId)){
			$passportDetails['id']= $passportId;
			$this->passportRepo->update($passportDetails,$passportId);
		}else{
			$passportDetails = $this->passportRepo->create($passportDetails)->toArray();
		}
		$data['passport_id'] = $passportDetails['id'];
		if(isset($data['passport_details'])){
			unset($data['passport_details']);
		}
		unset($data['step']);
		return $this->query->create(array_merge($data,['created_by' => auth()->guard('admin')->user()->id]));
	}


	public function find(int $id){
		return $this->query
					->findOrFail($id);
	}

	public function findByPassportNo(int $id){
		return $this->query->where('passport_id',$id)->firstOrFail();
	}


	public function update(array $data,$id){
		$query = $this->query->find($id);
		if($data['step'] == 'one'){
			$this->passportRepo->update($data['passport_details'],$query->passport_id);
		}
		if(isset($data['passport_details'])){
			unset($data['passport_details']);
		}
		unset($data['step']);
		$query->update($data);

		return $query;
	}

	
}
