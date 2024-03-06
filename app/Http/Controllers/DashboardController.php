<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try{
            return view('dashboard.index');
            
        }catch(\Exception $e)
        {
            return redirect()->back()->with(['type'=>'error', 'message'=>'something went wrong']);
        }
    }
}
