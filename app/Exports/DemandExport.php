<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class DemandExport implements FromCollection, WithHeadings
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
        foreach ($this->data as $key=>$demand) {
            $rowData = [
                $key + 1,
                $applicant['date'],
                $applicant['position_name'],
                $applicant['country_name'],
                $applicant['salary'],
                $applicant['experience'],
            ];
            $rows[] = $rowData;
        }
        return collect($rows);
    }


    public function headings(): array
    {
        return [
        	'S.No',
        	'Date',
            'Position',
            'Country',
            'Salary',
            'Experience',
        ];
    }
}
