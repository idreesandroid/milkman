<?php

namespace App\Exports;
use Carbon\Carbon;
use App\Models\SubTask;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class vendorCollectionExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Query
    */
    use Exportable;

    protected $fromDate;
    protected $toDate;
	public function __construct($fromDate, $toDate, $vendorID)
	{
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->vendorID = $vendorID;
	}
    public function query()
    {
        $vendorCollection = SubTask::select(
                                    'sub_tasks.updated_at',
                                    'sub_tasks.milkCollected',
                                    'sub_tasks.taskShift',
                                    'sub_tasks.fat',
                                    'sub_tasks.Lactose',
                                    'sub_tasks.Ash',
                                    'users.name',
                                    'sub_tasks.status'
                                )
                            ->whereBetween('sub_tasks.updated_at', array($this->fromDate, $this->toDate))
                            ->leftJoin('users','users.id','=','sub_tasks.AssignTo')
                            ->where('sub_tasks.vendor_id','=',$this->vendorID);
        return $vendorCollection;
    }

    public function headings() : array
    {
        return ["Date", "Amount", "Shift", "Fat", "Lactose", "Ash", "Assign To", "Status"];
    }

    public function map($vendorCollection): array
    {
        return [
             Carbon::createFromFormat('Y-m-d H:i:s',$vendorCollection->updated_at),
             $vendorCollection->milkCollected,
             $vendorCollection->taskShift,
             $vendorCollection->fat,
             $vendorCollection->Lactose,
             $vendorCollection->Ash,
             $vendorCollection->name,
             $vendorCollection->status
         ];
    }
    public function columnFormats(): array {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }   
}