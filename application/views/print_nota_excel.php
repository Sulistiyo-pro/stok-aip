<?php
$wkt = explode(' ', $ket['waktu']);
$tgl = explode('-', $wkt[0]);
//membuat objek PHPExcel
$objPHPExcel = new PHPExcel();
$objDrawing = new PHPExcel_Worksheet_Drawing();

$objDrawing->setName('Logo');        //set name to image
$objDrawing->setDescription('Logo'); //set description to image
$logo = 'assets/logo.jpg';    //Path to signature .jpg file
$objDrawing->setPath($logo);
$objDrawing->setOffsetX(10);                       //setOffsetX works properly
$objDrawing->setOffsetY(5);                       //setOffsetY works properly
//$objDrawing->setCoordinates('A1');        //set image to cell
$objDrawing->setWidth(320);                 //set width, height
//$objDrawing->setHeight(70);  
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  //save
//
// bagian atas
$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('C1', 'Kepada Yth:')
        ->setCellValue('C2', 'No. Faktur')
        ->setCellValue('C3', 'Tgl. Faktur')
        ->setCellValue('C4', 'Jatuh Tempo')
        ->setCellValue('E2', ': '.sprintf('%03s',$ket['nota_manual']).'/AIP/'.$tgl[1].'/'.$tgl[0])
        ->setCellValue('E3', ': '.implode('/', array_reverse($tgl)))
        ->setCellValue('E4', ': ')
        ->setCellValue('A3', 'FAKTUR PENJUALAN')
        ->setCellValue('A4', '(KWITANSI)');
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(60);
$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

//header table
$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A6', 'No')
        ->setCellValue('B6', 'Nama Barang')
        ->setCellValue('C6', 'Quantitas')
        ->setCellValue('D6', 'Satuan')
        ->setCellValue('E6', 'Harga Satuan Rp.')
        ->setCellValue('F6', 'Jumlah Rp.');

// bagian isi data
$i = 7;
$n = 1;
$g = 0;
foreach ($data as $r) {
    $g += $r['total'];
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $i, $n)
            ->setCellValue('B' . $i, $r['nama'])
            ->setCellValue('C' . $i, $r['qty'])
            ->setCellValue('D' . $i, $r['satuan'])
            ->setCellValue('E' . $i, $r['harga'])
            ->setCellValue('F' . $i, $r['total']);
    $i++;
    $n++;
}
for ($x = $n; $x <= 25; $x++) {
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $i, $n);
    $i++;
    $n++;
}

// bagian bawah
$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('E32', 'Jumlah Rp.')
        ->setCellValue('F32', $g)
        ->setCellValue('A33', 'Terbilang: ' . ucfirst(number_to_words($g)) . ' rupiah')
        ->setCellValue('A35', 'Barang yang sudah dibeli tidak bisa ditukar/dikembalikan')
        ->setCellValue('A36', 'Pembayaran dengan cheque/billyet giro dianggap sah setelah proses kliring')
        ->setCellValue('C35', 'Gudang')
        ->setCellValue('E35', 'Accounting')
        ->setCellValue('F35', 'Penerima');
$objPHPExcel->getActiveSheet()->getRowDimension(32)->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension(33)->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getStyle('A32:F33')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

// set width
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(45);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(17);

// merging
$objPHPExcel->getActiveSheet()->mergeCells('A32:D32');
$objPHPExcel->getActiveSheet()->mergeCells('A33:F33');
$objPHPExcel->getActiveSheet()->mergeCells('C35:D35');
$objPHPExcel->getActiveSheet()->mergeCells('C36:D37');
$objPHPExcel->getActiveSheet()->mergeCells('C38:D38');
$objPHPExcel->getActiveSheet()->mergeCells('E36:E37');
$objPHPExcel->getActiveSheet()->mergeCells('F36:F37');
$objPHPExcel->getActiveSheet()->mergeCells('A3:B3');
$objPHPExcel->getActiveSheet()->mergeCells('A4:B4');

// format number
$objPHPExcel->getActiveSheet()->getStyle('E7:E31')->getNumberFormat()->setFormatCode('#,##0');
$objPHPExcel->getActiveSheet()->getStyle('F7:F32')->getNumberFormat()->setFormatCode('#,##0');

// styling
$allBorderStyle = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);
$outlineBorderStyle = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);
$alignCenter = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    )
);
$alignRight = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
    )
);
$fontSize = [
    'font' => [
        'size' => 7
    ]
];

$objPHPExcel->getActiveSheet()->getStyle('A6:F33')->applyFromArray($allBorderStyle);
$objPHPExcel->getActiveSheet()->getStyle('C1:F1')->applyFromArray($outlineBorderStyle);
$objPHPExcel->getActiveSheet()->getStyle('C2:F4')->applyFromArray($outlineBorderStyle);
$objPHPExcel->getActiveSheet()->getStyle('A6:F6')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('C35:F35')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('A3:B4')->applyFromArray($alignCenter);
$objPHPExcel->getActiveSheet()->getStyle('E32')->applyFromArray($alignRight);
$objPHPExcel->getActiveSheet()->getStyle('A35:A36')->applyFromArray($fontSize);
$objPHPExcel->getActiveSheet()->getStyle('C35:F38')->applyFromArray($allBorderStyle);

// fit one page
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);

//set title pada sheet (me rename nama sheet)
$objPHPExcel->getActiveSheet()->setTitle('Faktur Penjualan');
//mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5          
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//sesuaikan headernya 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//ubah nama file saat diunduh
header('Content-Disposition: attachment;filename="faktur_penjualan_' . time() . '.xlsx"');
//unduh file
$objWriter->save("php://output");
