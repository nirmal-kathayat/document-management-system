<?php

namespace App\Http\Controllers;

use App\Http\Requests\PassportRequest;
use Illuminate\Http\Request;
use App\Repository\PassportRepository;
class PassportController extends Controller
{
	private $repo;
	public function __construct(PassportRepository $repo){
		$this->repo = $repo;
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
			$this->repo->create($request->validated());
			return redirect()->back()->with(['message' => 'Passport uploaded successfully','type' => 'success']);
		} catch (Exception $e) {
			return redirect()->back()->with(['message' => $e->getMesage(),'type' => 'error']);
		}

	}

}