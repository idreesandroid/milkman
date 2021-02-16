<?php

namespace App\Exports;
use Carbon\Carbon;
use App\Models\UserTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PaymentExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Query
    */
    use Exportable;
    protected $fromDate;
    protected $toDate;
	public function __construct($fromDate, $toDate, $userID)
	{
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->userID = $userID;
	}
    public function query()
    {
        $UserTransaction = UserTransaction::select(
                            'user_transactions.paymentMethod',
                            'user_transactions.transactionId',
                            'user_transactions.timeOfDeposit',
                            'user_transactions.amountPaid',
                            'users.name',
                            'user_transactions.status',
                            )
                            ->whereBetween('user_transactions.created_at', array($this->fromDate, $this->toDate))
                            ->leftJoin('users','users.id','=','user_transactions.verifiedBy')
                            ->where('user_transactions.user_id','=',$this->userID);
        return $UserTransaction;
    }

    public function headings() : array
    {
        return ["Payment Method", "Transection ID", "Deposit Time", "Amount Paid","Verified By", "Status"];
    }

    public function map($UserTransaction): array
    {
        return [
             $UserTransaction->paymentMethod,
             $UserTransaction->transactionId,
             Carbon::createFromFormat('Y-m-d H:i:s',$UserTransaction->timeOfDeposit),
             $UserTransaction->amountPaid,
             $UserTransaction->name,
             $UserTransaction->status,
         ];
    }
    public function columnFormats(): array {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }   
}