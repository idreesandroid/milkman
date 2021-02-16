<?php

namespace App\Exports;
use Carbon\Carbon;
use App\Models\milkmanAsset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class CollectorInventoryExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting
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
        $assets = milkmanAsset::select(
                                'milkman_assets.updated_at',
                                'milkman_assets.assetName',
                                'assets_types.typeName',
                                'milkman_assets.assetCapacity',
                                'milkman_assets.assetCode',
                            )
                          ->join('assets_types','assets_types.id','=','milkman_assets.type_id')
                          ->whereBetween('milkman_assets.updated_at', array($this->fromDate, $this->toDate))
                          ->Where('milkman_assets.user_id','=',$this->collectorID);
        return $assets;
    }

    public function headings() : array
    {
        return ["Assign At", "Asset Name", "Asset Type", "Capacity", "Asset Code"];
    }

    public function map($assets): array
    {
        return [
             Carbon::createFromFormat('Y-m-d H:i:s',$assets->updated_at),
             $assets->assetName,
             $assets->typeName,
             $assets->assetCapacity,
             $assets->assetCode
         ];
    }
    public function columnFormats(): array {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }   
}