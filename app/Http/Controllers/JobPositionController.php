<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobPositionRequest;
use App\Repository\JobPositionRepository;
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
            $jobPositions = $this->jobPositionRepository->getAllJobs();
            return view('jobPositions.index')->with(['jobPositions'=>$jobPositions]);

        }catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => 'An error occurred while fetching jobPosition data.']);
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
