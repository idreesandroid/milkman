<?php

namespace App\Exports;
use Carbon\Carbon;
use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class OrderExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Query
    */
    use Exportable;
	protected $request;
    protected $fromDate;
    protected $toDate;
	public function __construct($fromDate, $toDate)
	{
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
	}
    public function query()
    {
        $invoice = Invoice::select(
            'invoices.created_at',
             'invoices.total_amount', 'users.name as saler',
                            	'invoices.updated_at', 'invoices.flag')
                            ->leftJoin('users','users.id','=','invoices.seller_id')
                            ->whereBetween('invoices.created_at', array($this->fromDate, $this->toDate));
        return $invoice;
    }

    public function headings() : array
    {
        return ["Order Date", "Total Amount", "sold By", "Delivery Date", "Order Status"];
    }

    public function map($invoice): array
    {
        return [
             Carbon::createFromFormat('Y-m-d H:i:s',$invoice->created_at),
             $invoice->total_amount,
             $invoice->saler,
             Carbon::createFromFormat('Y-m-d H:i:s',$invoice->updated_at),
             $invoice->flag,
         ];
    }
    public function columnFormats(): array {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }   
}