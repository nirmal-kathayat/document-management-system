<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index(){

    }

    public function upload(){
    	try {
    		return view('applicant.upload');
    	} catch (Exception $e) {
    		return redirect()->back()->with(['message' => $e->getMesage(),'type' => 'error']);
    	}
    }
}
