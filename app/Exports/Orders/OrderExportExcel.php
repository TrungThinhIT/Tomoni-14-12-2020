<?php

namespace App\Exports\Orders;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;

class OrderExportExcel
{
    public function ExportOrder($bills, $hien_mau){
        $fileType = IOFactory::identify(public_path('excels/template/order.xlsx'));
        $objReader = IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load(public_path('excels/template/order.xlsx'));
        
        $this->addDataToExcelFileCell1($objPHPExcel->setActiveSheetIndex(0), $bills);
        $this->addDataToExcelFileCell2($objPHPExcel->setActiveSheetIndex(1), $hien_mau);
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Xlsx');
        
        if (!is_dir(public_path('excels'))) {
            mkdir(public_path('excels'));
        }

        if (!is_dir(public_path('excels/exports'))) {
            mkdir(public_path('excels/exports'));
        }

        $path = 'excels/exports/' . time() . 'export.xlsx';
        $objWriter->save(public_path($path));
        return redirect($path);
    }

    public function addDataToExcelFileCell1($setCell, $bills){
        $index = 1;
        $row = 26;
        foreach ($bills as $key => $item) {

            $setCell
                ->setCellValue('A' . $row, $index)
                ->setCellValue('B' . $row, $item->Codeorder)
                ->setCellValue('C' . $row, $item->uname)
                ->setCellValue('D' . $row, $item->Product->jan_code)
                ->setCellValue('E' . $row, $item->Product->ProductStandard->name_2)
                ->setCellValue('F' . $row, $item->Product->quantity / $item->Product->item_in_box)
                ->setCellValue('H' . $row, $item->Product->quantity)
                ->setCellValue('I' . $row, $item->Product->quantity * $item->Product->ProductStandard->weight)
                ->setCellValue('J' . $row, $item->Product->quantity * $item->totalWeightkhoi)
                ->setCellValue('K' . $row, $item->Product->ProductStandard->height)
                ->setCellValue('L' . $row, $item->Product->ProductStandard->length)
                ->setCellValue('M' . $row, $item->Product->ProductStandard->width)
                ->setCellValue('N' . $row, $item->Product->ProductStandard->weight);
                // ->setCellValue('G' . $row, $item->price)
                // ->setCellValue('H' . $row, '=F' . $row . '*G' . $row); //them dong text vao cot H, su dung ham tinh toan mac dinh trong excel de tinh gia tri

            $index++;

            $row++;
        }
    }

    public function addDataToExcelFileCell2($setCell, $hien_mau){
        $index = 1;
        $row = 26;
        foreach ($hien_mau as $key => $item) {

            $setCell
                ->setCellValue('A' . $row, $index)
                ->setCellValue('B' . $row, Carbon::parse($item->dateget)->format('d/m/Y h:m:i'))
                ->setCellValue('C' . $row, $item->price_in)
                ->setCellValue('D' . $row, $item->priceIn)
                ->setCellValue('E' . $row, $item->depositID);
                // ->setCellValue('G' . $row, $item->price)
                // ->setCellValue('H' . $row, '=F' . $row . '*G' . $row); //them dong text vao cot H, su dung ham tinh toan mac dinh trong excel de tinh gia tri

            $index++;

            $row++;
        }
    }
}
