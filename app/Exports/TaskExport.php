<?php

namespace App\Exports;
use Carbon\Carbon;
use App\Models\TaskArea;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TaskExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Query
    */
    use Exportable;
    protected $fromDate;
    protected $toDate;
	public function __construct($fromDate, $toDate, $collectorID)
	{
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->collectorID = $collectorID;
	}
    public function query()
    {
        $collectorTask = TaskArea::select(
                                    'task_areas.created_at',
                                    'collections.title as coltitle',
                                    'task_areas.shift',
                                    'task_areas.assignFrom',
                                    'task_areas.assignTill',
                                    'task_areas.taskAreaStatus'
                                )
                          ->whereBetween('task_areas.created_at', array($this->fromDate, $this->toDate))
                          ->leftJoin('collections','collections.id','=','task_areas.area_id')
                          ->Where('task_areas.collector_id','=',$this->collectorID);
        return $collectorTask;
    }

    public function headings() : array
    {
        return ["Assign At", "Collection Area", "Morning/Evening Shift", "Assign From", "Assign To", "Status"];
    }

    public function map($collectorTask): array
    {
        return [
             Carbon::createFromFormat('Y-m-d H:i:s',$collectorTask->created_at),
             $collectorTask->coltitle,
             $collectorTask->shift,
             $collectorTask->assignFrom,
             $collectorTask->assignTill,
             $collectorTask->taskAreaStatus,
         ];
    }
    public function columnFormats(): array {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }   
}