<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContinentRequest;
use App\Repository\ContinentRepository;
use Illuminate\Http\Request;

class ContinentController extends Controller
{
    private $continentRepository;
    public function __construct(ContinentRepository $continentRepository)
    {
        $this->continentRepository = $continentRepository;
    }

    public function index()
    {
        try {
            $continents = $this->continentRepository->getAllContinents();
            return view('backup.addContinents.index')->with(['continents' => $continents]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'An error occurred while fetching continent data.']);
        }
    }
    public function create()
    {
        try {
            return view('backup.addContinents.form');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'An error occurred while fetching continent data.']);
        }
    }

    public function store(ContinentRequest $request)
    {
        // dd($request->all());
        try {
            $this->continentRepository->storeContinent($request->validated());
            return redirect()->route('admin.continent')->with(['message' => 'Continent created Successfully!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'An error occurred while fetching continent data.']);
        }
    }

    public function edit($id)
    {
        try {
            $editData = $this->continentRepository->findContinent($id);
            return view('backup.addContinents.form')->with(['editData' => $editData]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'An error occurred while fetching continent data.']);
        }
    }

    public function update(ContinentRequest $request, $id)
    {
        try {
            $this->continentRepository->updateContinent($request->validated(), $id);
            return redirect()->route('admin.continent')->with(['message' => 'Continent updated Successfully!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'An error occurred while fetching continent data.']);
        }
    }

    public function delete($id)
    {
        try{
            $this->continentRepository->deleteContinent($id);
            return redirect()->back()->with(['message' => 'Continent deleted Successfully!', 'type' => 'success']);

        }catch(\Exception $e){
            return redirect()->back()->with(['error' => 'An error occurred while fetching continent data.']);
        }
    }
}
