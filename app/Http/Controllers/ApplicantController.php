<?php

namespace App\Http\Controllers;
use App\Repository\ApplicantRepository;
use App\Repository\Passportrepository;
use App\Repository\ContinentRepository;
use App\Repository\JobPositionRepository;
use App\Repository\ExperienceRepository;
use App\Http\Requests\ApplicantRequest;
class ApplicantController extends Controller
{
	private $repo,$passportRepo,$continentRepo,$jobPositionRepo,$experienceRepo;
	public function __construct(ApplicantRepository $repo,Passportrepository $passportRepo,ContinentRepository $continentRepo,JobPositionRepository $jobPositionRepo,ExperienceRepository $experienceRepo){
		$this->repo = $repo;
		$this->passportRepo=$passportRepo;
		$this->continentRepo=$continentRepo;
        $this->jobPositionRepo = $jobPositionRepo;
        $this->experienceRepo = $experienceRepo;

	}
    public function index(){
    	return view('applicant.index');
    }

    public function create(){
    	try {
            $step = $_GET['step'] ?? 'one';
            $passportId = $_GET['passport_id'] ?? null;
            $data = [];
            if($step == 'one'){
                $data['continents'] = $this->continentRepo->get();
                $data['positions'] = $this->jobPositionRepo->get();
            }
            if($step ==='two'){
                $data['experiences'] = $this->experienceRepo->get();
            }
            if(!empty($passportId)){
                $data['passport']  =  $this->passportRepo->find($passportId);
            }

            return view('applicant.form')->with($data); 
        }   
        catch (Exception $e) {
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' =>'error']);
        }
    }


    public function store(ApplicantRequest $request){
        try {
            $passportId = $_GET['passport_id'] ?? null;
            $data = $this->repo->store($request->validated(),$passportId);
            return redirect()->route('admin.applicant.edit',['id' => $data->id,'step' => 'two'])->with(['message'=> 'Applicant Created Successfully','type' => 'success']);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' =>'error']);
        }
    }


    public function edit($id){
        try {
            $step = $_GET['step'] ?? 'one';
            $data['applicant'] = $this->repo->find($id);
            if($step == 'one'){
                $data['continents'] = $this->continentRepo->get();
                $data['positions'] = $this->jobPositionRepo->get();
                $data['passport']  =  $this->passportRepo->find($data['applicant']->passport_id);

            }
            if($step ==='two'){
                $data['experiences'] = $this->experienceRepo->get();
            }
            return view('applicant.form')->with($data);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' =>'error']);
            
        }
    }


    public function update(ApplicantRequest $request,$id){
        try {
            $step = $_GET['step'] ?? 'one';
            $data= $this->repo->update($request->validated(),$id);
            if($step == 'one'){
                return redirect()->route('admin.applicant.edit',['id' => $data->id,'step' => 'two'])->with(['message'=> 'Applicant Updated Successfully','type' => 'success']);

            }else if($step =='two'){
                return redirect()->route('admin.applicant.edit',['id' => $data->id,'step' => 'three'])->with(['message'=> 'Applicant Updated Successfully','type' => 'success']);
            }else if($step =='three'){

                return redirect()->route('admin.applicant.edit',['id' => $data->id,'step' => 'four'])->with(['message'=> 'Applicant Updated Successfully','type' => 'success']);
            }
            else{
                return redirect()->route('admin.applicant')->with(['message'=> 'Applicant Updated Successfully','type' => 'success']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' =>'error']);
        }
    }


}
