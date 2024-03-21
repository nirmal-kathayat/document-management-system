<?php

namespace App\Http\Controllers;
use App\Models\Applicant;
class DashboardController extends Controller
{
    public function index()
    {
        try{
            $totalApplicant = Applicant::count();
            $totalMale = Applicant::
                                leftJoin('passports','passports.id','applicants.passport_id')->where('passports.gender','Male')->count();
            $totalFemale =   Applicant::
                                leftJoin('passports','passports.id','applicants.passport_id')->where('passports.gender','Female')->count();
        	$data = [
        		'total_applicant' => \DB::table('applicants')->count(),
                'applicants' => $applicants = Applicant::
                                leftJoin('passports','passports.id','applicants.passport_id')
                                    ->select('applicants.id','passports.first_name','passports.last_name','passports.dob','passports.gender','applicants.experiences')
                                    ->limit(15)
                                    ->orderBy('applicants.created_at','desc')
                                    ->get(),
                'stats' => [
                    'total_male_percentage' =>( $totalMale * 100 )/$totalApplicant,
                    'total_female_percentage' => ( $totalFemale * 100 )/$totalApplicant
                ]
        	];
            return view('dashboard.index')->with($data);
            
        }catch(\Exception $e)
        {
            return redirect()->back()->with(['type'=>'error', 'message'=>$e->getMessage()]);
        }
    }
}
