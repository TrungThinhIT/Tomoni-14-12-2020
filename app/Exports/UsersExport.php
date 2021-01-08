<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class UsersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle, WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $users;
    public function collection()
    {
        return User::all();
    }

    public function __construct($users){
        $this->users = $users;
    }

    public function headings(): array
    {
        return [
            'User name',
            'Full name',
            'Email',
            'Password',
            'Number phone',
            'Address'
        ];
    }

    public function map($user): array
    {
        return [
            $user->uname,
            $user->fname,
            $user->email,
            $user->password,
            $user->nphone,
            $user->address
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
