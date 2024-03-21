<?php 
namespace App\Repository;
use App\Models\Applicant;
use App\Repository\PassportRepository;
use Carbon\Carbon;
class ApplicantRepository{
	private $query,$passportRepo;
	public function __construct(Applicant $query,PassportRepository $passportRepo){
		$this->query = $query;
		$this->passportRepo = $passportRepo;
	}


	public function dataTable($params = []){
		$query =$this->query
					->query()
					->where('applicants.is_selected',$params['isSelected']);
		if(isset($params['search']) && !empty($params['search'])){
			$query = $query->where('passports.first_name','like','%' . strtoupper($params['search']) . '%')
							->orWhere('passports.last_name','like','%' . strtoupper($params['search']) . '%');
		}	

		if(isset($params['gender']) && !empty($params['gender'])){
			$query = $query->where('passports.gender',$params['gender']);
		}
		if(isset($params['country']) && !empty($params['country'])){
			$query = $query->where('applicants.country_id',$params['country']);
		}
		if(isset($params['position']) && !empty($params['position'])){
			$query = $query->where('applicants.job_position_id',$params['position']);
		}

		if(isset($params['age']) && !empty($params['age'])){
			$birthDate = Carbon::now()->subYears((int)$params['age'])->format('Y');
			$query = $query->whereYear('passports.dob', '>=', $birthDate);
		}

		if(isset($params['experience']) && !empty($params['experience'])){
 			$query = $query->where(\DB::raw("IFNULL(JSON_UNQUOTE(JSON_EXTRACT(applicants.experiences, '$.professionals[0].duration')), NULL)"), $params['experience']);

		}

		if(isset($params['from_date']) && isset($params['to_date']) && !empty($params['from_date']) && !empty($params['to_date'])){
			$query = $query->whereDate('passports.created_at', '>=', $params['from_date'])
                  			 ->whereDate('passports.created_at', '<=', $params['to_date']);
		}

		$query = $query
				->leftJoin('passports','passports.id','applicants.passport_id')
				->leftJoin('job_positions','job_positions.id','applicants.job_position_id')
				->leftJoin('countries','countries.id','applicants.country_id')
				->select('applicants.id',\DB::raw("IFNULL(JSON_UNQUOTE(JSON_EXTRACT(applicants.experiences, '$.professionals[0].duration')), NULL) AS experience"),'passports.first_name','passports.last_name','passports.id as passport_id','applicants.job_position_id','job_positions.title as position_name','applicants.country_id','countries.title as country_name','passports.gender','passports.dob','applicants.created_at','applicants.is_selected')
				->orderBy('applicants.created_at','desc');
		return $query;
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
				->leftJoin('continents','continents.id','applicants.continent_id')
				->leftJoin('countries','countries.id','applicants.country_id')
				->leftJoin('job_positions','job_positions.id','applicants.job_position_id')
				->select('applicants.*','continents.title as continent_name','countries.title as country_name','job_positions.title as position_name')
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

	public function delete($id){
		$query =$this->find($id);
		if(is_array($query->attachments)){
			foreach($query->attachments as $attachment){
				if(!empty($attachment)){
					$this->unlinkAttachment($attachment);
				}
			}
		}

		return $query->delete();
	}


	public function multiUpdate(array $data,$ids){
		return $this->query->whereIn('id',$ids)->update($data);
	}


	public function uploadAttachment($file,$params = []){
		$imageName = $params['image_name'].'.'.pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
		$file->move($params['destination'],$imageName);
		if(!empty($params['existing_file'])){
			$this->unlinkAttachment($params['existing_file']);
		}
		return $params['destination'].'/'.$imageName;
	}

	public function unlinkAttachment($path){
		if(file_exists( public_path().'/'.$path)){
			unlink($path);
				
		}
		return;
	}



	
}
