<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobPositionRequest;
use App\Repository\JobPositionRepository;
use DataTables;
use Illuminate\Http\Request;

class JobPositionController extends Controller
{
    private $jobPositionRepository;
    public function __construct(JobPositionRepository $jobPositionRepository)
    {
        $this->jobPositionRepository = $jobPositionRepository;
    }

    public function index()
    {
        try{
            if(request()->ajax()){
                $data = $this->jobPositionRepository->getAllJobs();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->rawColumns([])
                    ->make(true);
            }
            return view('jobPositions.index');
      }catch(\Exception $e){
        return redirect()->back()->with(['message' => 'An error occurred while fetching country data.','type' =>'error']);
      }
    }
    public function create()
    {
      try{
        return view('jobPositions.form');
      }catch(\Exception $e)
      {
        return redirect()->back()->with(['error' => 'An error occurred while fetching jobPosition data.']);
      }
    }

    public function store(JobPositionRequest $request)
    {
        // dd($request->all());
        try{
            $this->jobPositionRepository->storeJobPosition($request->validated());
            return redirect()->route('admin.jobPosition')->with(['message'=>'Job Position created successfully!','type'=>'success']);

        }catch(\Exception $e){
            return redirect()->back()->with(['error' => 'An error occurred while fetching jobPosition data.']);
        }
    }

    public function edit($id)
    {
        try{
            $editData = $this->jobPositionRepository->findJobs($id);
            return view('jobPositions.form')->with(['editData'=>$editData]);

        }catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => 'An error occurred while fetching jobPosition data.']);
        }
    }

    public function update(JobPositionRequest $request,$id)

    {
        try{
            $this->jobPositionRepository->updateJobs($request->validated(),$id);
            return redirect()->route('admin.jobPosition')->with(['message'=>'Job Position updated successfully!','type'=>'success']);
        }catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => 'An error occurred while fetching jobPosition data.']);
        }
    }

    public function delete($id)
    {
        try{
            $this->jobPositionRepository->deleteJobs($id);
            return redirect()->back()->with(['message'=>'Job Position deleted successfully!','type'=>'success']);

        }catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => 'An error occurred while fetching jobPosition data.']);
        }

    }
}
