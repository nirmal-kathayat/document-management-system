<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandRequest;
use App\Repository\DemandRepository;
use App\Repository\CountryRepository;
use Illuminate\Http\Request;

class DemandController extends Controller
{
  private $repo, $countryRepo;
  public function __construct(DemandRepository $repo, CountryRepository $countryRepo)
  {
    $this->repo = $repo;
    $this->countryRepo = $countryRepo;
  }

  public function index()
  {
    try {
      if (request()->ajax()) {
        $data = $this->repo->getAllDemands();
        return DataTables::of($data)
          ->addIndexColumn()
          ->rawColumns([])
          ->make(true);
      }
      return view('demand.index');
    } catch (\Exception $e) {
      return redirect()->back()->with(['message' => 'An error occurred while fetching demand data.', 'type' => 'error']);
    }
  }
  public function create()
  {
    try {
      $experiences = $this->repo->getAllExperiences();
      $countries = $this->countryRepo->get();
      return view('demand.form')->with(['experiences' => $experiences, 'countries' => $countries]);
    } catch (\Exception $e) {
      return redirect()->back()->with(['message' => 'An error occurred while fetching  data.', 'type' => 'error']);
    }
  }

  public function store(Demandrequest $request)
  {
    try {
      $this->repo->store($request->validated());
      return redirect()->route('admin.demand')->with(['message' => 'Demand created successfully!', 'type' => 'success']);
    } catch (\Exception $e) {
      return redirect()->back()->with(['message' => 'An error occurred while fetching  data.', 'type' => 'error']);
    }
  }

  public function edit($id)
  {
    try {
      $experiences = $this->repo->getAllExperiences();
      $countries = $this->countryRepo->get();

      $demand = $this->repo->find($id);
      return view('demand.form')->with(['demand' => $demand, 'experiences' => $experiences, 'countries' => $countries]);
    } catch (\Exception $e) {
      return redirect()->back()->with(['message' => 'An error occurred while fetching  data.', 'type' => 'error']);
    }
  }

  public function update(Demandrequest $request, $id)
  {
    try {
      $this->repo->update($request->validated(), $id);
      return redirect()->route('admin.demand')->with(['message' => 'Demand Updated successfully', 'type' => 'success']);
    } catch (\Exception $e) {
      return redirect()->back()->with(['message' => 'An error occurred while fetching  data.', 'type' => 'error']);
    }
  }

  public function delete($id)
  {
    try {
      $this->repo->delete($id);
      return redirect()->back()->with(['message' => 'Demand deleted successfully', 'type' => 'success']);
    } catch (\Exception $e) {
      return redirect()->back()->with(['message' => 'An error occurred while fetching  data.', 'type' => 'error']);
    }
  }
}
