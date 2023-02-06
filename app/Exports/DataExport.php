<?php
namespace App\Exports;

use App\Models\Demand;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection, WithHeadings
{
    
    public function __construct(
        private array $reportData
    )
    {}
    
   /** 
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return collect($this->reportData);
    }

    public function headings(): array
    {
        return array_keys($this->reportData[0]);
    }

}