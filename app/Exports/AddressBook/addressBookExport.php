<?php

namespace App\Exports\AddressBook;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class addressBookExport
{

    public function ExportAddressBook($addressBook)
    {
        $fileType = IOFactory::identify(public_path('excels/template/addressBookExport.xlsx'));
        $objReader = IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load(public_path('excels/template/addressBookExport.xlsx'));

        $this->addDataToExcelFileCell1($objPHPExcel->setActiveSheetIndex(0), $addressBook);
        // $this->addDataToExcelFileCell2($objPHPExcel->setActiveSheetIndex(1), $hien_mau);
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Xlsx');

        if (!is_dir(public_path('excels'))) {
            mkdir(public_path('excels'));
        }

        if (!is_dir(public_path('excels/exports'))) {
            mkdir(public_path('excels/exports'));
        }

        $nameFileExcel = 'Sổ địa chỉ' . 'export.xlsx';

        $path = 'excels/exports/' . $nameFileExcel;
        $objWriter->save(public_path($path));
        return redirect($path);
    }

    public function addDataToExcelFileCell1($setCell, $addressBook)
    {
        $index = 1;
        $row = 26;
        foreach ($addressBook as $key => $item) {

            $setCell
                ->setCellValue('A' . $row, $index)
                ->setCellValue('B' . $row, $item->addcode)
                ->setCellValue('C' . $row, $item->address)
                ->setCellValue('D' . $row, $item->phonenumber)
                ->setCellValue('E' . $row, $item->uname)
                ->setCellValue('F' . $row,  Carbon::parse($item->delivery_time)->format('d/m/Y h:m:i'))
                ->setCellValue('G' . $row, $item->add_default == 1 ? "Mặc đinh" : "");
            // ->setCellValue('H' . $row, Carbon::parse($item->delivery_time)->format('d/m/Y h:m:i'));

            // ->setCellValue('G' . $row, $item->price)
            // ->setCellValue('H' . $row, '=F' . $row . '*G' . $row); //them dong text vao cot H, su dung ham tinh toan mac dinh trong excel de tinh gia tri

            $index++;

            $row++;
        }
    }
}
