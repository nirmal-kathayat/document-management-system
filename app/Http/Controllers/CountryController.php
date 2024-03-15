<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Repository\CountryRepository;
use App\Repository\ContinentRepository;
use DataTables;
class CountryController extends Controller
{
    private $countryRepository,$continentRepository;
    public function __construct(CountryRepository $countryRepository,ContinentRepository $continentRepository )
    {
        $this->countryRepository = $countryRepository;
        $this->continentRepository = $continentRepository;
    }

    public function index()
    {
      try{
            if(request()->ajax()){
                $data = $this->countryRepository->dataTable();
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
            $continents = $this->continentRepository->getContinentForSelect();
            return view('country.form')->with(['continents'=>$continents]);

        }catch(\Exception $e)
        {
            return redirect()->back()->with(['message' => 'An error occurred while fetching country data.','type' => 'error']);
        }
    }

    public function store(CountryRequest $request)
    {
        
        try{
            $this->countryRepository->storeCountries($request->validated());
            return redirect()->route('admin.country')->with(['message'=>'Country Created Successfully!','type'=>'success']);
        }catch(\Exception $e) {
            return redirect()->back()->with(['message' => 'An error occurred while fetching country data.','type' => 'error']);
        }
    }

    public function edit($id)
    {
        try{
            $country = $this->countryRepository->findCountry($id);
            $continents = $this->continentRepository->getContinentForSelect();
            return view('country.form')->with(['country'=>$country, 'continents'=>$continents]);

        }catch(\Exception $e){
            return redirect()->back()->with(['message' => 'An error occurred while fetching country data.','type' => 'error']);
        }
    }

    public function update(CountryRequest $request,$id)
    {
        try{
            $this->countryRepository->updateCountry($request->validated(),$id);
            return redirect()->route('admin.country')->with(['message'=>'Country updated Successfully!','type'=>'success']);

        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with(['message' => 'An error occurred while fetching country data.','type' => 'error']);
        }
    }

    public function delete($id)
    {
        try{
            $this->countryRepository->deleteCountry($id);
            return redirect()->back()->with(['message'=>'Country deleted Successfully!','type'=>'success']);

        }catch(\Exception $e){
            return redirect()->back()->with(['type' => 'An error occurred while fetching country data.','type' => 'error']);
        }
    }
}
