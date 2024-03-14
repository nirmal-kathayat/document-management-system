<?php

namespace App\Http\Controllers;

use App\Http\Requests\Demandrequest;
use App\Repository\DemandRepository;

use Illuminate\Http\Request;

class DemandController extends Controller
{
  private $demandRepository;
  public function __construct(DemandRepository $demandRepository)
  {
    $this->demandRepository = $demandRepository;
  }

  public function index()
  {
    try {
      $demands = $this->demandRepository->getAllDemands();
      return view('demand.index')->with(['demands'=>$demands]);
    } catch (\Exception $e) {

      return redirect()->back()->with(['error' => 'An error occurred while fetching  data.']);
    }
  }
  public function create()
  {
    try {
      $experiences = $this->demandRepository->getAllExperiences();
      return view('demand.form')->with(['experiences'=>$experiences]);
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => 'An error occurred while fetching  data.']);
    }
  }

  public function store(Demandrequest $request)
  {
    try {
      $this->demandRepository->storeDemands($request->validated());
      return redirect()->route('admin.demand')->with(['message' => 'Demand created successfully!', 'type' => 'success']);
    } catch (\Exception $e) {
      dd($e->getMessage());
      return redirect()->back()->with(['error' => 'An error occurred while fetching  data.']);
    }
  }

  public function edit($id)
  {
    try{
      $experiences = $this->demandRepository->getAllExperiences();
      $editData = $this->demandRepository->findDemand($id);
      return view('demand.form')->with(['editData'=>$editData,'experiences'=>$experiences]);

    }catch(\Exception $e)
    {
      return redirect()->back()->with(['error' => 'An error occurred while fetching data.']);
    }
  }

  public function update(Demandrequest $request,$id)
  {
    try{
      // dd($request->all());
      $this->demandRepository->updateDemand($request->validated(),$id);
      return redirect()->route('admin.demand')->with(['message'=>'Demand Updated successfully','type'=>'success']);
    }catch(\Exception $e)
    {
      // dd($e->getMessage());
      return redirect()->back()->with(['error' => 'An error occurred while fetching data.']);
    }
  }

  public function delete($id)
  {
    try{
      $this->demandRepository->deleteDemand($id);
      return redirect()->back()->with(['message'=>'Demand deleted successfully','type'=>'success']);
    }catch(\Exception $e)
    {
      return redirect()->back()->with(['error' => 'An error occurred while fetching data.']);
    }
  }
}
