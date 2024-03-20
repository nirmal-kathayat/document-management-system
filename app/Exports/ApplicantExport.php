<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
class ApplicantExport implements FromCollection, WithHeadings
{
	private $data;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($data){
    	
    	$this->data = $data;
    }
    public function collection()
    {
        $rows = [];
        foreach ($this->data as $key=>$applicant) {
        	$dateOfBirth = Carbon::createFromFormat('Y-m-d',  $applicant['dob']); 
        	$exp = null;
        	if(is_array($applicant['experiences'])){
        		$exp=$applicant['experiences']['professionals'][0]['duration'];
        	}
            $rowData = [
                $key + 1,
                $applicant['first_name'],
                $applicant['last_name'],
                $applicant['position_name'],
                $applicant['country_name'],
                $exp,
                $applicant['gender'],
              	$dateOfBirth->age,
            ];
            $rows[] = $rowData;
        }
        return collect($rows);
    }

    public function headings(): array
    {
        return [
        	'S.No',
            'Given Name',
            'Surename',
            'Job Position',
            'Country',
            'Experience',
            'Gender',
            'Age'
        ];
    }
}
