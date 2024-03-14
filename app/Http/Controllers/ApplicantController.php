<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index(){

    }

    public function create(){
    	return view('applicant.form');
    }

  
}
