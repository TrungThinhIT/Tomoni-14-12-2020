<?php

namespace App\Exports\PaymentCustomers;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\File;

class paymentCustomerExcel
{

    public function ExportProduct($PCustomers)
    {
        $fileType = IOFactory::identify(public_path('excels/template/productReality.xlsx'));
        $objReader = IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load(public_path('excels/template/productReality.xlsx'));

        $this->addDataToExcelFileCell1($objPHPExcel->setActiveSheetIndex(0), $PCustomers);
        // $this->addDataToExcelFileCell2($objPHPExcel->setActiveSheetIndex(1), $hien_mau);
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Xlsx');

        if (!is_dir(public_path('excels'))) {
            mkdir(public_path('excels'));
        }

        if (!is_dir(public_path('excels/exports'))) {
            mkdir(public_path('excels/exports'));
        }
        $nameFileExcel = 'paymentCustomer-export.xlsx';

        $path = 'excels/exports/' . $nameFileExcel;
        $objWriter->save(public_path($path));
        return redirect($path);
    }

    public function addDataToExcelFileCell1($setCell, $PCustomers)
    {
        $index = 1;
        $row = 26;
        foreach ($PCustomers as $key => $item) {
            $setCell
                ->setCellValue('A' . $row, $index)
                ->setCellValue('B' . $row, $item->deposit)
                ->setCellValue('C' . $row, $item->uname)
                ->setCellValue('D' . $row, $item->money)
                ->setCellValue('E' . $row, $item->note)
                ->setCellValue('F' . $row, $item->address)
                ->setCellValue('G' . $row, Carbon::parse($item->date_in)->format('d/m/Y h:m:i'));

            // ->setCellValue('G' . $row, $item->price)
            // ->setCellValue('H' . $row, '=F' . $row . '*G' . $row); //them dong text vao cot H, su dung ham tinh toan mac dinh trong excel de tinh gia tri

            $index++;

            $row++;
        }
    }
}
