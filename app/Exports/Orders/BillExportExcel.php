<?php

namespace App\Exports\Orders;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class BillExportExcel implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle, WithCustomStartCell
{
    protected $bills;

    public function __construct($bills){
        $this->bills = $bills;
    }

    public function collection()
    {
        return $this->bills;
    }

    public function headings(): array
    {
        return [
            'Số hoá đơn',
            'User name',
            'Price In',
            'Price Out',
            'Total',
            'Price Debt',
            'Date Create'
        ];
    }

    public function map($bill): array
    {

        return [
            $bill->So_Hoadon,
            $bill->uname,
            number_format($bill->PriceIn, 0),
            number_format($bill->totalPriceOut, 0),
            $bill->total,
            number_format($bill->PriceIn - $bill->totalPriceOut, 0),
            Carbon::parse($bill->Date_Create)->format('d/m/Y h:m:i')
        ];
    }

    public function title(): string
    {
        return 'Danh sách hoá đơn';
    }

    public function startCell(): string
    {
        return 'A1';
    }

}