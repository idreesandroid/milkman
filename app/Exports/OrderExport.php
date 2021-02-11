<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
//use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class OrderExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Query
    */
    use Exportable;
	protected $request;
	// public function __construct($request)
	// {
	//     $this->request = $request;
	// }
    public function query()
    {
        //$invoice = Invoice::select('id','invoice_number','flag','created_at');
        

        $invoice = Invoice::select(
        	'invoices.created_at',
        	'invoices.total_amount',
        	'users.name as saler',
        	'invoices.updated_at',
        	'invoices.flag',
        )
                        ->leftJoin('users','users.id','=','invoices.seller_id');
        return $invoice;
    }

    public function headings() : array
    {
        return ["Order Date",
        "Total Amount",       
        "sold By",
        "Delivery Date",        
        "Order Status"
    ];
    }

    // public function map($invoice): array
    // {
    //     return [
    //         'idrees'.$invoice->invoice_number,
    //         'time'.$invoice->created_at,
    //         'id'.$this->request
    //     ];
    // }
}
