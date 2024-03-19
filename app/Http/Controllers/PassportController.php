<?php

namespace App\Http\Controllers;

use App\Http\Requests\PassportRequest;
use App\Repository\PassportRepository;
use DataTables;

class PassportController extends Controller
{
	private $repo;
	public function __construct(PassportRepository $repo){
		$this->repo = $repo;
	}

	public function index(){
		try {
			if(request()->ajax()){
                $data = $this->repo->dataTable();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->rawColumns([])
                    ->make(true);
            }
			return view('passport.index');
		} catch (Exception $e) {
			return redirect()->back()->with(['message' => $e->getMesage(),'type' => 'error']);
		}
	}

	public function create(){
		try {
			return view('passport.form');
		} catch (Exception $e) {
			return redirect()->back()->with(['message' => $e->getMesage(),'type' => 'error']);
		}
	}


	public function store(PassportRequest $request){
		try {
			$data = $this->repo->create($request->validated());
			return redirect()->route('admin.applicant.create',['passport_id' => $data->id])->with(['message' => 'Passport uploaded successfully','type' => 'success']);
		} catch (Exception $e) {
			return redirect()->back()->with(['message' => $e->getMesage(),'type' => 'error']);
		}

	}

	public function edit($id){
		try {
			$passport = $this->repo->find($id);
			return view('passport.form')->with(['passport' => $passport]);
		} catch (Exception $e) {
			return redirect()->back()->with(['message' => $e->getMesage(),'type' => 'error']);
			
		}
	}

	public function update(PassportRequest $request,$id){
		try {
			$this->repo->update($request->validated(),$id);
			return redirect()->route('admin.passport')->with(['message' => 'Passport updated successfully','type' => 'success']);
			
		} catch (Exception $e) {
			return redirect()->back()->with(['message' => $e->getMesage(),'type' => 'error']);
		}
	}
}