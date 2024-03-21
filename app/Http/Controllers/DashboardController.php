<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try{
        	$data = [
        		'total_applicant' => \DB::table('applicants')->count() 
        	];
            return view('dashboard.index')->with($data);
            
        }catch(\Exception $e)
        {
            return redirect()->back()->with(['type'=>'error', 'message'=>'something went wrong']);
        }
    }
}
