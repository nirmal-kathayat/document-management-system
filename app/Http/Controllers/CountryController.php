<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Repository\CountryRepository;
use App\Repository\ContinentRepository;
use DataTables;
class CountryController extends Controller
{
    private $repo,$continentRepository;
    public function __construct(CountryRepository $repo,ContinentRepository $continentRepository )
    {
        $this->repo = $repo;
        $this->continentRepository = $continentRepository;
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
            return view('country.index');
      }catch(\Exception $e){
        return redirect()->back()->with(['message' => 'An error occurred while fetching country data.','type' =>'error']);
      }
    }
    public function create()
    {
        try{
            $continents = $this->continentRepository->get();
            return view('country.form')->with(['continents'=>$continents]);

        }catch(\Exception $e)
        {
            return redirect()->back()->with(['message' => 'An error occurred while fetching country data.','type' => 'error']);
        }
    }

    public function store(CountryRequest $request)
    {
        
        try{
            $this->repo->store($request->validated());
            return redirect()->route('admin.country')->with(['message'=>'Country Created Successfully!','type'=>'success']);
        }catch(\Exception $e) {
            return redirect()->back()->with(['message' => 'An error occurred while fetching country data.','type' => 'error']);
        }
    }

    public function edit($id)
    {
        try{
            $country = $this->repo->find($id);
            $continents = $this->continentRepository->getContinentForSelect();
            return view('country.form')->with(['country'=>$country, 'continents'=>$continents]);

        }catch(\Exception $e){
            return redirect()->back()->with(['message' => 'An error occurred while fetching country data.','type' => 'error']);
        }
    }

    public function update(CountryRequest $request,$id)
    {
        try{
            $this->repo->update($request->validated(),$id);
            return redirect()->route('admin.country')->with(['message'=>'Country updated Successfully!','type'=>'success']);

        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with(['message' => 'An error occurred while fetching country data.','type' => 'error']);
        }
    }

    public function delete($id)
    {
        try{
            $this->repo->delete($id);
            return redirect()->back()->with(['message'=>'Country deleted Successfully!','type'=>'success']);

        }catch(\Exception $e){
            return redirect()->back()->with(['type' => 'An error occurred while fetching country data.','type' => 'error']);
        }
    }

    public function fetch(){
        try {
            $data = $this->repo->get([
                'continent_id' => $_GET['continent_id'] ?? null
            ]);
            return response()->json(['message' => 'Success','type' => 'success','data' => $data]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error while fetching','type' => 'error']);
        }
    }
}
