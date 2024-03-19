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


	public function dataTable($params = []){
		return $this->query
					->query()
					->select('')
					->orderBy('created_at','desc');
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
		if(isset($data['attachments'])){
			$attachments = $data['attachments'];
			$data['attachments'] = $query->attachments ?? [];
			if(isset($attachments['passport_img'])){
				$passportImage = $this->uploadAttachment($attachments['passport_img'],[
					'existing_file' => $passport->image,
					'destination' => 'uploaded/passports',
					'image_name' => now()
				]);
				$this->passportRepo->update([
					'image' => $passportImage,
				],$query->passport_id);

			}
			if(isset($attachments['profile_img'])){
				$data['attachments']['profile_img']= $this->uploadAttachment($attachments['profile_img'],[
					 'existing_file' => $query->attachments['profile_img'] ?? null,
					 'destination' => 'uploaded/applicants/'.$query->passport_id,
					 'image_name' => 'profile'
				]);
			}
			if(isset($attachments['education_1']) && !empty($attachments['education_1'])){
				$data['attachments']['education_1']= $this->uploadAttachment($attachments['education_1'],[
					 'existing_file' => $query->attachments['education_1'] ?? null,
					 'destination' => 'uploaded/applicants/'.$query->passport_id,
					 'image_name' => 'education_1'
				]);
			}
			if(isset($attachments['education_2']) && !empty($attachments['education_2'])){
				$data['attachments']['education_2']= $this->uploadAttachment($attachments['education_2'],[
					 'existing_file' => $query->attachments['education_2'] ?? null,
					 'destination' => 'uploaded/applicants/'.$query->passport_id,
					 'image_name' => 'education_2'
				]);
			}

			if(isset($attachments['education_3']) && !empty($attachments['education_3'])){
				$data['attachments']['education_3']= $this->uploadAttachment($attachments['education_3'],[
					 'existing_file' => $query->attachments['education_3'] ?? null,
					 'destination' => 'uploaded/applicants/'.$query->passport_id,
					 'image_name' => 'education_3'
				]);
			}

			if(isset($attachments['full_body_img']) && !empty($attachments['full_body_img'])){
				$data['attachments']['full_body_img'] = $this->uploadAttachment($attachments['full_body_img'],[
					 'existing_file' => $query->attachments['full_body_img'] ?? null,
					 'destination' => 'uploaded/applicants/'.$query->passport_id,
					 'image_name' => 'full_body_img'
				]);
			}

			if(isset($attachments['training_1']) && !empty($attachments['training_1'])){
				$data['attachments']['training_1'] = $this->uploadAttachment($attachments['training_1'],[
					 'existing_file' => $query->attachments['training_1'] ?? null,
					 'destination' => 'uploaded/applicants/'.$query->passport_id,
					 'image_name' => 'training_1'
				]);
			}

			if(isset($attachments['training_2']) && !empty($attachments['training_2'])){
				$data['attachments']['training_2'] = $this->uploadAttachment($attachments['training_2'],[
					 'existing_file' => $query->attachments['training_2'] ?? null,
					 'destination' => 'uploaded/applicants/'.$query->passport_id,
					 'image_name' => 'training_2'
				]);
			}

			if(isset($attachments['other_img']) && !empty($attachments['other_img'])){
				$data['attachments']['other_img'] = $this->uploadAttachment($attachments['other_img'],[
					 'existing_file' => $query->attachments['other_img'] ?? null,
					 'destination' => 'uploaded/applicants/'.$query->passport_id,
					 'image_name' => 'other_img'
				]);
			}
		}

		$query->update($data);
		return $query;
	}


	public function uploadAttachment($file,$params = []){
		$imageName = $params['image_name'].'.'.pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
		$file->move($params['destination'],$imageName);
		if(!empty($params['existing_file'])){
			if(file_exists( public_path().'/'.$params['existing_file'])){

	        	unlink($params['existing_file']);
			}
		}
		return $params['destination'].'/'.$imageName;
	}

	
}
