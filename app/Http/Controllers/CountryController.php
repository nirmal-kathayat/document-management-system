<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Repository\CountryRepository;
use App\Repository\ContinentRepository;

use Illuminate\Http\Request;

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
            $countries = $this->countryRepository->getAllCountries();
            return view('country.index')->with(['countries'=>$countries]);
      }catch(\Exception $e)
      {
        return redirect()->back()->with(['error' => 'An error occurred while fetching country data.']);
      }
    }
    public function create()
    {
        try{
            $continentsList = $this->continentRepository->getContinentForSelect();
            return view('country.form')->with(['continentsList'=>$continentsList]);

        }catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => 'An error occurred while fetching country data.']);
        }
    }

    public function store(CountryRequest $request)
    {
        
        try{
            $this->countryRepository->storeCountries($request->validated());
            return redirect()->route('admin.country')->with(['message'=>'Country Created Successfully!','type'=>'success']);
        }catch(\Exception $e)

        {
            // dd($e->getMessage());
            return redirect()->back()->with(['error' => 'An error occurred while fetching country data.']);
        }
    }

    public function edit($id)
    {
        try{
            $editData = $this->countryRepository->findCountry($id);
            $continentsList = $this->continentRepository->getContinentForSelect();
            return view('country.form')->with(['editData'=>$editData, 'continentsList'=>$continentsList]);

        }catch(\Exception $e){
            return redirect()->back()->with(['error' => 'An error occurred while fetching country data.']);
        }
    }

    public function update(CountryRequest $request,$id)
    {
        try{
            $this->countryRepository->updateCountry($request->validated(),$id);
            return redirect()->route('admin.country')->with(['message'=>'Country updated Successfully!','type'=>'success']);

        }catch(\Exception $e){
            return redirect()->back()->with(['error' => 'An error occurred while fetching country data.']);
        }
    }

    public function delete($id)
    {
        try{
            $this->countryRepository->deleteCountry($id);
            return redirect()->back()->with(['message'=>'Country deleted Successfully!','type'=>'success']);

        }catch(\Exception $e){
            return redirect()->back()->with(['error' => 'An error occurred while fetching country data.']);
        }
    }
}
