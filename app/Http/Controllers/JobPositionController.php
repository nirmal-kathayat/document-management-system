<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobPositionRequest;
use App\Repository\JobPositionRepository;
use Illuminate\Http\Request;
use DataTables;
class JobPositionController extends Controller
{
    private $repo;
    public function __construct(JobPositionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        try{
            if(request()->ajax()){
                $data = $this->repo->dataTable();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->rawColumns([])
                    ->make(true);
            }
            return view('position.index');
        }catch(\Exception $e){
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' => 'error']);
        }
    }
    public function create()
    {
      try{
        return view('position.form');
      }catch(\Exception $e)
      {
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' => 'error']);
      }
    }

    public function store(JobPositionRequest $request)
    {
        try{
            $this->repo->store($request->validated());
            return redirect()->route('admin.position')->with(['message'=>'Job Position created successfully!','type'=>'success']);

        }catch(\Exception $e){
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' => 'error']);
            
        }
    }

    public function edit($id)
    {
        try{
            $position = $this->repo->find($id);
            dd($position);
            return view('position.form')->with(['position'=>$position]);

        }catch(\Exception $e)
        {
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' => 'error']);
           
        }
    }

    public function update(JobPositionRequest $request,$id)

    {
        try{
            $this->repo->update($request->validated(),$id);
            return redirect()->route('admin.position')->with(['message'=>'Job Position updated successfully!','type'=>'success']);
        }catch(\Exception $e)
        {
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' => 'error']);
           
        }
    }

    public function delete($id)
    {
        try{
            $this->repo->delete($id);
            return redirect()->back()->with(['message'=>'Job Position deleted successfully!','type'=>'success']);

        }catch(\Exception $e)
        {
            return redirect()->back()->with(['message' =>$e->getMessage(),'type' => 'error']);
            
        }

    }
}
