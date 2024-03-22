<?php

namespace App\Http\Controllers;
use App\Repository\ApplicantRepository;
use App\Repository\Passportrepository;
use App\Repository\ContinentRepository;
use App\Repository\JobPositionRepository;
use App\Repository\ExperienceRepository;
use App\Repository\CountryRepository;
use App\Http\Requests\ApplicantRequest;
use DataTables;
use PDF;
use Carbon\Carbon;
use App\Exports\ApplicantExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
	private $repo,$passportRepo,$continentRepo,$positionRepo,$experienceRepo,$countryRepo;
	public function __construct(ApplicantRepository $repo,Passportrepository $passportRepo,ContinentRepository $continentRepo,JobPositionRepository $positionRepo,ExperienceRepository $experienceRepo,CountryRepository $countryRepo){
		$this->repo = $repo;
		$this->passportRepo=$passportRepo;
		$this->continentRepo=$continentRepo;
        $this->positionRepo = $positionRepo;
        $this->experienceRepo = $experienceRepo;
        $this->countryRepo = $countryRepo;

    }
    public function index(){
        try {
            if(request()->ajax()){
                $data = $this->repo->dataTable([
                    'search' => $_GET['search'] ?? null,
                    'gender' => $_GET['gender'] ?? null,
                    'country' => $_GET['country'] ?? null,
                    'position' => $_GET['position'] ?? null,
                    'experience' => $_GET['experience'] ?? null,
                    'age' => $_GET['age'] ?? null,
                    'from_date' => $_GET['from_date'] ?? null,
                    'to_date' => $_GET['to_date'] ?? null,
                    'isSelected' => isset($_GET['isSelected']) ? true : false

                ]);
                return DataTables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
            }
            $data['positions'] = $this->positionRepo->get();
            $data['experiences'] = $this->experienceRepo->get();
            $data['countries'] = $this->countryRepo->get();
            return view('applicant.index')->with($data);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' =>'error']);
            
        }
    }

    public function create(){
    	try {
            $step = $_GET['step'] ?? 'one';
            $passportId = $_GET['passport_id'] ?? null;
            $data = [];
            if($step == 'one'){
                $data['continents'] = $this->continentRepo->get();
                $data['positions'] = $this->positionRepo->get();
            }
            if($step ==='two'){
                $data['experiences'] = $this->experienceRepo->get();
                $data['positions'] = $this->positionRepo->get();
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
                $data['positions'] = $this->positionRepo->get();
                $data['passport']  =  $this->passportRepo->find($data['applicant']->passport_id);

            }
            if($step =='two'){
                $data['experiences'] = $this->experienceRepo->get();
                $data['positions'] = $this->positionRepo->get();
            }
            if($step=='three'){
                $data['selectedPosition'] = $this->positionRepo->find($data['applicant']->job_position_id);
            }
            if($step=='four'){
                $data['passport']  =  $this->passportRepo->find($data['applicant']->passport_id);
                
            }
            return view('applicant.form')->with($data);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' =>'error']);
            
        }
    }


    public function update(ApplicantRequest $request,$id){
        try {
            $step =$request->step;
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

    public function delete($id){
        try {
            $this->repo->delete($id);
            return redirect()->back()->with(['message' => 'Applicant deleted successfully','type' => 'success']);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' =>'error']);
            
        }
    }

    public function export(Request $request){
        try {
            return Excel::download(new ApplicantExport(
                 $this->repo->dataTable([
                    'gender' => $request->gender ?? null,
                    'country' =>$request->country ?? null,
                    'position' => $request->position ?? null,
                    'experience' => $request->experience ?? null,
                    'age' =>$request->age ?? null,
                    'from_date' => $request->from_date ?? null,
                    'to_date' => $request->to_date ?? null,
                    'isSelected' => $request->isSelected == 'on' ? true : false
                ])->get()->toArray()
            ), 'applicants.xlsx');
        } catch (Exception $e) {
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' =>'error']);
            
        }
    }


    public function move(){
        try {
           $ids = $_GET['ids'];
           $idArr =  array_map('intval',explode(',',$ids));
           $this->repo->multiUpdate([
                'is_selected' => true,
               
           ], $idArr);
           return redirect()->back()->with(['message' =>'Move to selected successfully','type' =>'success']);

        } catch (Exception $e) {
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' =>'error']); 
        }
    }


    public function info($id){
        try {
            $data['applicant'] = $this->repo->find($id);
            $data['passport'] = $this->passportRepo->find($data['applicant']->passport_id);
            if(!isset($_GET['type'])){
                $data['continents'] = $this->continentRepo->get();
                $data['positions'] = $this->positionRepo->get();
                $data['experiences'] = $this->experienceRepo->get();
            }
            if(isset($_GET['type'])&& $_GET['type'] == 'download'){
                 $pdf = PDF::loadView('applicant.cv', $data);
                 $pdf->getDomPDF()->getOptions()->set('defaultFont', 'Arial');
                return $pdf->download($data['passport']->first_name.'-'.$data['passport']->last_name.'.pdf');
            }else{
                return view('applicant.info')->with($data);
            }
            
        } catch (Exception $e) {
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' =>'error']);
            
        }
    }


}
