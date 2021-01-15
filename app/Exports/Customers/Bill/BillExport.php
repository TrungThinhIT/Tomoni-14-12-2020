<?php

namespace App\Exports\Customers\Bill;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class BillExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle, WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $users;
    public function collection()
    {
        return $this->users;
    }

    public function __construct($users){
        $this->users = $users;
    }

    public function headings(): array
    {
        return [
            'Action',
            'Date Time',
            'Description',
            'Price In',
            'Price Out',
            'Price Debt'
        ];
    }

    public function map($user): array
    {
        $user->action == 'Mua' ? $des = $user->codeorder: $des = $user->depositID;
        // $user->action == 'Mua' ? $price = $user->total_all: $des = $user->price_in;
        return [
            $user->action,
            $user->dateget,
            $des,
            $user->price_in,
            $user->total_all,
            $user->deDebt
        ];
    }

    public function title(): string
    {
        return 'Danh sách người dùng';
    }

    public function startCell(): string
    {
        return 'A1';
    }
}
