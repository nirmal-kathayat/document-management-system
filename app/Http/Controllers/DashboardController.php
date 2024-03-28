<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Passport;
use App\Models\JobPosition;
class DashboardController extends Controller
{
    public function index()
    {
        try {
            $totalApplicant = Applicant::count();
            $totalPassport = Passport::count();
            $totalMale = Applicant::
                                leftJoin('passports','passports.id','applicants.passport_id')->where('passports.gender','Male')->count();
            $totalFemale =   Applicant::
                                leftJoin('passports','passports.id','applicants.passport_id')->where('passports.gender','Female')->count();
            $applicants = Applicant::
                                leftJoin('passports','passports.id','applicants.passport_id')
                                    ->select('applicants.id','passports.first_name','passports.last_name','passports.dob','passports.gender','applicants.experiences')
                                    ->limit(15)
                                    ->orderBy('applicants.created_at','desc')
                                    ->get();
            $totalApplicantApproved = \DB::table('demand_applicants')->where('status','Approved')->count();
            $positions = JobPosition::get();
        	$data = [
        		'total_applicant' => $totalApplicant,
                'total_passport' =>  $totalPassport,
                'total_approved' => $totalApplicantApproved,
                'applicants' => $applicants,
                'positions' => $positions,
                'stats' => [
                    'total_male_percentage' => $totalApplicant > 0 ? ( $totalMale * 100 )/ $totalApplicant : 0,
                    'total_female_percentage' =>$totalApplicant > 0 ?  ( $totalFemale * 100 ) / $totalApplicant : 0
                ]
            ];
            return view('dashboard.index')->with($data);
        } catch (\Exception $e) {
            return redirect()->back()->with(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
