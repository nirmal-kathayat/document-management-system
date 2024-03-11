<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddApplicantController extends Controller
{
    public function create()
    {
        return view('addApplicants.form');
    }
}
