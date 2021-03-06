<?php

namespace App\Exports\Orders;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class OrderExportExcel
{
    public function ExportOrder($bills, $hien_mau, $money, $priceIn)
    {
        // $fileType = IOFactory::identify(public_path('excels/template/order.xlsx'));
        // $objReader = IOFactory::createReader($fileType);
        // $objPHPExcel = $objReader->load(public_path('excels/template/order.xlsx'));
        $fileType = IOFactory::identify(public_path('excels/template/exportBill2.xlsx'));
        $objReader = IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load(public_path('excels/template/exportBill2.xlsx'));
        $money = $money;
        $priceIn = $priceIn;
        $this->addDataToExcelFileCell1($objPHPExcel->setActiveSheetIndex(0), $bills, $objPHPExcel, $money, $priceIn);
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Xlsx');

        if (!is_dir(public_path('excels'))) {
            mkdir(public_path('excels'));
        }

        if (!is_dir(public_path('excels/exports'))) {
            mkdir(public_path('excels/exports'));
        }

        $nameFileExcel = $bills->first()->So_Hoadon . '-export.Xlsx';

        $path = 'excels/exports/' . $nameFileExcel;
        $objWriter->save(public_path($path));
        return redirect($path);
    }

    public function addDataToExcelFileCell1($setCell, $bills, $objPHPExcel, $money, $priceIn)
    {
        $index = 1;
        $row = 8;
        $objPHPExcel->getActiveSheet()->getStyle('E8:E200')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
        foreach ($bills as $key => $items) {
            foreach ($items->listProduct as $item) {
                if ((strpos($item->urlimg, 'http') === 0)) {
                    $pic1 = $item->urlimg;
                } else {
                    $url = Str::after($item->urlimg, '../');
                    $pic2 = 'https://tomoniglobal.com/' . $url;
                }
                //thêm hình ảnh
                $namePic = Str::random(10);
                while (file_exists(public_path('images/' . $namePic . '.png'))) {
                    $namePic = Str::random(10);
                }
                $path = public_path('images/' . $namePic . '.png');

                $check = file_put_contents($path, file_get_contents($pic2));
                // Convert it to a jpeg file with 100% qualit
                if ($check) {
                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                    $drawing->setName('Paid');
                    $drawing->setDescription('Paid');
                    $drawing->setPath(public_path('images/' . $namePic . '.png'));
                    $drawing->setCoordinates('E' . $row);
                    $drawing->setOffsetX(55);
                    $drawing->setOffsety(28);
                    $drawing->setHeight(130);
                    $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(120); //fix chiều cao cột
                    $drawing->setWorksheet($objPHPExcel->getActiveSheet());
                }
                $setCell
                    ->setCellValue('A' . $row, $index) //date
                    ->setCellValue('B' . $row, $items->Codeorder) //invoice
                    ->setCellValue('C' . $row, $item->jan_code) //jancode
                    ->setCellValue('D' . $row, $item->ProductStandard->name_2) //tên hàng
                    // ->setCellValue('E' . $row, $item->ProductStandard->name_2)
                    ->setCellValue('F' . $row, $item->item_in_box) //Số thùng
                    ->setCellValue('G' . $row, $item->quantity / $item->item_in_box) //Số lượng trên 1 thùng
                    ->setCellValue('H' . $row, $item->quantity) //tổng số lượng
                    ->setCellValue('I' . $row, $item->price) //đơn giá
                    ->setCellValue('J' . $row, "") //TỔng phụ
                    ->setCellValue('K' . $row, $item->Tax) //Tax
                    ->setCellValue('L' . $row, "") //chiết khấu
                    ->setCellValue('M' . $row, $item->quantity * $item->price) // Tổng tiên
                    ->setCellValue('N' . $row, $item->ProductStandard->weight) //Khối lượng
                    ->setCellValue('O' . $row, $item->ProductStandard->height) // Cao
                    ->setCellValue('P' . $row, $item->ProductStandard->length) //Dài
                    ->setCellValue('Q' . $row, $item->ProductStandard->width) //rộng
                    ->setCellValue('R' . $row, $item->ProductStandard->weight) //cân nặng
                    ->setCellValue('S' . $row, $item->totalWeightkhoi) //số khối
                    ->setCellValue('T' . $row, "") //web order
                    ->setCellValue('U' . $row, $items->Order->date_payment) //hạn thanh toán
                    ->setCellValue('V' . $row,  $items->Order->date_delivery) //ngày có hàng
                    ->setCellValue('W' . $row, $item->ProductStandard->note); //Tình trạng
                // ->setCellValue('G' . $row, $item->price)
                // ->setCellValue('H' . $row, '=F' . $row . '*G' . $row); //them dong text vao cot H, su dung ham tinh toan mac dinh trong excel de tinh gia tri

                $index++;
                $row++;
               // chưa xóa hình trong folder
            }
        }
        $setCell->setCellValue('W4', $money);
        $setCell->setCellValue('W5', $priceIn);
        $setCell->getColumnDimension('D')->setAutoSize(true);
        $setCell->getColumnDimension('K')->setAutoSize(true);
        $setCell->getColumnDimension('F')->setAutoSize(true);
        // $setCell->getColumnDimension('E')->setAutoSize(true);
        $setCell->getColumnDimension('U')->setAutoSize(true);
        $setCell->getColumnDimension('V')->setAutoSize(true);
        // \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder() );
        // $setCell->getCell('A'.$row)->setValue('Please remit payment to the following bank account Bank Name： RAKUTEN BANK, LTD.\n
        // Branch Name： HEAD OFFICE\n
        // SWIFT Code / BIC　:RAKTJPJT( RAKTJPJTXXX)\n
        // Address： 2-16-5 KONAN, MINATO-KU, TOKYO, JAPAN\n
        // Account Number: 7991468 \n
        // Beneficiary Name: TOMONILOGISTICS CO.,LTD\n
        // Beneficiary Address: OAZA KAMINOKAWA 5101-1,KAWACHI GUN,KAMINOKAWAMACHI,\n
        // TOCHIGI KEN,329-0611,JAPAN ');
        // $setCell->setCellValue('A' . $row, 'Please remit payment to the following bank account Bank Name： RAKUTEN BANK, LTD.
        // Branch Name： HEAD OFFICE
        // SWIFT Code / BIC　:RAKTJPJT( RAKTJPJTXXX)
        // Address： 2-16-5 KONAN, MINATO-KU, TOKYO, JAPAN\n
        // Account Number: 7991468 
        // Beneficiary Name: TOMONILOGISTICS CO.,LTD
        // Beneficiary Address: OAZA KAMINOKAWA 5101-1,KAWACHI GUN,KAMINOKAWAMACHI,
        // TOCHIGI KEN,329-0611,JAPAN ')->getStyle('A' . $row)->getAlignment()->setWrapText(true);
        // $setCell->getColumnDimension('A')->setAutoSize(true);
        // $setCell->getRowDimension($row)->setRowHeight(140);
    }

    public function addDataToExcelFileCell2($setCell, $hien_mau)
    {
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
    function file_get_contents_curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
