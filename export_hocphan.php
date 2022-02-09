<?php
    include 'connect/connect.php';
    $xuat = $_POST['xuat'];
    session_start();
        
    require ('Classes/PHPExcel.php');
    if(isset($_POST['Export_hp'])){
        $objExcel = new PHPExcel;
    
        $numSheet = 0;
        $sql = "SELECT *FROM chuyennganh WHERE id_cn=$xuat";
        // $result = $mysqli->query($sql);
        $result = mysqli_query($link, $sql);
        while($chuyennganh = mysqli_fetch_assoc($result)){
            // print_r($lop); die;
            $objExcel->createSheet();
            $objExcel->setActiveSheetIndex($numSheet);
            $sheet = $objExcel->getActiveSheet()->setTitle($chuyennganh['tencn']);
    
            $numRow = 2;
            $sheet ->getDefaultRowDimension()->setRowHeight(20);
            $sheet ->mergeCells('A1:F1');
            $sheet ->setCellValue('A1','Danh Sách Học Phần ' .$chuyennganh['tencn']);

            $sheet->setCellValue("A$numRow",'Mã học phần');
            $sheet->setCellValue("B$numRow",'Tên học phần');
            $sheet->setCellValue("C$numRow",'Số tín chỉ');
            $sheet->setCellValue("D$numRow",'Tín chỉ lý thuyết');
            $sheet->setCellValue("E$numRow",'Tín chỉ thực hành');
            $sheet->setCellValue("F$numRow",'Ghi chú');

            $sheet ->getStyle('A1')->getFont()->setSize(16); 
            $sheet ->getRowDimension(2)->setRowHeight(15);
    
            $sheet ->getStyle('A1:C1')->getFont()->setSize(14);
            $sheet ->getColumnDimension("A")->setAutoSize(true);
            $sheet ->getColumnDimension("B")->setAutoSize(true);
            $sheet ->getColumnDimension("C")->setAutoSize(true);
            $sheet ->getColumnDimension("D")->setAutoSize(true);
            $sheet ->getColumnDimension("E")->setAutoSize(true);
            $sheet ->getColumnDimension("F")->setAutoSize(true);

            $sheet->getPageMargins()->setTop(0.7); // ~ 1.78cm
            $sheet->getPageMargins()->setHeader(0.4); // ~1.02cm
            $sheet->getPageMargins()->setRight(0.68); // ~
            $sheet->getPageMargins()->setLeft(0.7); // ~1.78cm
            $sheet->getPageMargins()->setBottom(0.68); // ~1.73cm
            $sheet->getPageMargins()->setFooter(0.4); // ~1.02cm
            $sheet ->getStyle('A1')->getFont()->setBold(true);
            $sheet ->getStyle('A2:F2')->getFont()->setBold(true);
            $sheet ->getPageMargins()->setLeft(0.8);
            $sheet ->getStyle('A1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('D6DCE4');
            $sheet ->getStyle('A2:F2')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('9BC2E6');
            $sheet ->getStyle('A2:F2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet ->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             
            $sql1 = "SELECT mahp,tenhp,sotc,tclt,tcth,ghichu FROM hocphan WHERE id_cn=$xuat";
            $hocphan = mysqli_query($link, $sql1);
    
            while($hp = mysqli_fetch_assoc($hocphan)){
                $numRow++;
                $sheet->setCellValue("A$numRow",$hp['mahp']); 
                $sheet->setCellValue("B$numRow",$hp['tenhp']);
                $sheet->setCellValue("C$numRow",$hp['sotc']);
                $sheet->setCellValue("D$numRow",$hp['tclt']);
                $sheet->setCellValue("E$numRow",$hp['tcth']);
                $sheet->setCellValue("F$numRow",$hp['ghichu']);
            }
        // Tạo nhiều sheet
            // $numSheet++;
        } 

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $style = array(
        'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => '002060'),
            'size'  => 18
        ));
        $stylename = array(
        'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => '002060'),
            'size'  => 13
        ));
        $sheet->getStyle('A1')->applyFromArray($style);
        $sheet->getStyle('A2:F2')->applyFromArray($stylename);
        $sheet->getStyle('A1:' . 'F'.($numRow))->applyFromArray($styleArray);
        $sheet->getStyle('B3:' . 'F'.($numRow))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
        $filename = "danhsach_hocphan.xlsx";
        $objWriter->save($filename);
    
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
        header('Content-Length: ' . filesize($filename));
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: no-cache');
        readfile($filename);
        return;
    }
?>