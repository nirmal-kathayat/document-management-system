<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repository\UserRepository;
class ProfileController extends Controller
{
	private $userRepo;
	public function __construct(UserRepository $userRepo){
		$this->userRepo = $userRepo;
	}

	public function index(){
		return view('auth.profile');
	}

	public function update(Request $request){
		try {
			$data = $request->validate([
				'name' => 'required',
				'username' => 'required',
				'email' => 'required|email',
				'designation' => 'required',
				'dob' => 'required',
				'phone_no' => 'required',
				'image' => 'nullable'
			]);
			$this->userRepo->update($data,auth()->guard('admin')->user()->id);
			return redirect()->back()->with(['message'=> 'Profile update successfully','type' => 'success']);
		} catch (Exception $e) {
			return redirect()->back()->with(['message' => 'Somthing were wrong','type' => 'error']);
		}
	}
}
