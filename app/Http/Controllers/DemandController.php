<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandRequest;
use App\Repository\DemandRepository;
use App\Repository\CountryRepository;
use App\Repository\JobPositionRepository;
use App\Repository\ExperienceRepository;
use DataTables;
use App\Exports\DemandExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
class DemandController extends Controller
{
  private $repo,$countryRepo,$positionRepo,$experienceRepo;
  public function __construct(DemandRepository $repo,CountryRepository $countryRepo,JobPositionRepository $positionRepo,ExperienceRepository $experienceRepo)
  {
    $this->repo = $repo;
    $this->countryRepo= $countryRepo;
    $this->positionRepo = $positionRepo;
    $this->experienceRepo = $experienceRepo;
  }


  public function index()
  {
    try {
      if(request()->ajax()){
        $data = $this->repo->dataTable([
          'search' => $_GET['search'] ?? null,
          'country' => $_GET['country'] ?? null,
          'position' => $_GET['position'] ?? null,
          'experience' => $_GET['experience'] ?? null,
          'from_date' => $_GET['from_date'] ?? null,
          'to_date' => $_GET['to_date'] ?? null,
        ]);
        return DataTables::of($data)
        ->addIndexColumn()
        ->rawColumns([])
        ->make(true);
      }
      $countries = $this->countryRepo->get();
      $positions = $this->positionRepo->get();
      $experiences = $this->experienceRepo->get();

      return view('demand.index')->with(['experiences'=>$experiences,'countries' =>$countries,'positions' => $positions]);
    } catch (\Exception $e) {
      return redirect()->back()->with(['message' => 'An error occurred while fetching  data.','type' => 'error']);
    }
  }
  public function create()
  {
    try {
      $experiences = $this->experienceRepo->get();
      $countries = $this->countryRepo->get();
      $positions = $this->positionRepo->get();
      return view('demand.form')->with(['experiences'=>$experiences,'countries' =>$countries,'positions' => $positions]);
    } catch (\Exception $e) {
      return redirect()->back()->with(['message' =>$e->getMessage(),'type'=>'error']);
    }
  }

  public function store(DemandRequest $request)
  {
    try {
      $this->repo->store($request->validated());
      return redirect()->route('admin.demand')->with(['message' => 'Demand created successfully!', 'type' => 'success']);
    } catch (\Exception $e) {
      return redirect()->back()->with(['message' => $e->getMessage(),'type'=>'error']);
    }
  }

  public function edit($id)
  {
    try{
      $experiences = $this->experienceRepo->get();
      $countries = $this->countryRepo->get();
      $positions = $this->positionRepo->get();

      $demand = $this->repo->find($id);
      return view('demand.form')->with(['demand'=>$demand,'experiences'=>$experiences,'countries' =>$countries,'positions' => $positions]);

    }catch(\Exception $e)
    {
      return redirect()->back()->with(['message' =>$e->getMessage(),'type'=>'error']);
    }
  }

  public function update(DemandRequest $request,$id)
  {
    try{
      $this->repo->update($request->validated(),$id);
      return redirect()->route('admin.demand')->with(['message'=>'Demand Updated successfully','type'=>'success']);
    }catch(\Exception $e)
    {
      return redirect()->back()->with(['message' =>$e->getMessage(),'type'=>'error']);

    }
  }

  public function delete($id)
  {
    try{
      $this->repo->delete($id);
      return redirect()->back()->with(['message'=>'Demand deleted successfully','type'=>'success']);
    }catch(\Exception $e)
    {
      return redirect()->back()->with(['message' =>$e->getMessage(),'type'=>'error']);
      
    }
  }

  public function export(Request $request){
    try {
      return Excel::download(new DemandExport(
       $this->repo->dataTable([
        'country' =>$request->country ?? null,
        'position' => $request->position ?? null,
        'experience' => $request->experience ?? null,
        'from_date' => $request->from_date ?? null,
        'to_date' => $request->to_date ?? null,
      ])->get()->toArray()
     ), 'demands.xlsx');
    } catch (Exception $e) {
      return redirect()->back()->with(['message' =>$e->getMessage(),'type' =>'error']);

    }
  }

  public function applicant($id){
    try {
      $data['demand'] =$this->repo->find($id);
       $data['positions'] = $this->positionRepo->get();
            $data['experiences'] = $this->experienceRepo->get();
            $data['countries'] = $this->countryRepo->get();
      if(request()->ajax()){
        $data = $this->repo->applicants([
          'search' => $_GET['search'] ?? null,
          'gender' => $_GET['gender'] ?? null,
          'country' => $_GET['country'] ?? null,
          'position' => $_GET['position'] ?? null,
          'experience' => $_GET['experience'] ?? null,
          'age' => $_GET['age'] ?? null,
          'from_date' => $_GET['from_date'] ?? null,
          'to_date' => $_GET['to_date'] ?? null,
        ],$id);
        return DataTables::of($data)
        ->addIndexColumn()
        ->rawColumns([])
        ->make(true);
      }

      return view('demand.applicant')->with($data);
    } catch (Exception $e) {
      return redirect()->back()->with(['message' =>$e->getMessage(),'type' =>'error']);

    }
  }

  public function removeApplicantFromDemand($id){
    try{
      $this->repo->removeApplicantFromDemand($id);
      return redirect()->back()->with(['message'=>'Demand deleted successfully','type'=>'success']);
    }catch(\Exception $e)
    {
      return redirect()->back()->with(['message' =>$e->getMessage(),'type'=>'error']);
      
    }
  }

}
