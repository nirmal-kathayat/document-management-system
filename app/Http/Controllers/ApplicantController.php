<?php

namespace App\Http\Controllers;
use App\Repository\ApplicantRepository;
use App\Repository\Passportrepository;
use App\Repository\ContinentRepository;
class ApplicantController extends Controller
{
	private $repo,$passportRepo,$continentRepo;
	public function __construct(ApplicantRepository $repo,Passportrepository $passportRepo,ContinentRepository $continentRepo){
		$this->repo = $repo;
		$this->passportRepo=$passportRepo;
		$this->continentRepo=$continentRepo;

	}
    public function index(){
    	return view('applicant.index');
    }

    public function create($id = null){
    	$passport = null;
    	$data = [];
    	if(!empty($id)){
    		$data['passport']  =  $this->passportRepo->find($id);
    	}
    	return view('applicant.form')->with($data);
    }

  
}
