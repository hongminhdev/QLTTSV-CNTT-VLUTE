<?php
    include 'connect/connect.php';
    $xuat = $_POST['xuat'];
    $xuat_cn = $_POST['xuat_cn'];
    session_start();
        
    require ('Classes/PHPExcel.php');
    if(isset($_POST['Export_hp'])){
        $objExcel = new PHPExcel;
    
        $numSheet = 0;
        $sql = "SELECT *FROM sinhvien WHERE sinhvienID=$xuat";
        // $result = $mysqli->query($sql);
        $result = mysqli_query($link, $sql);
        while($sinhvien = mysqli_fetch_assoc($result)){
            // print_r($lop); die;
            $objExcel->createSheet();
            $objExcel->setActiveSheetIndex($numSheet);
            $sheet = $objExcel->getActiveSheet()->setTitle($sinhvien['MaSV']);
    
            $numRow = 2;
            $sheet ->getDefaultRowDimension()->setRowHeight(20);
            $sheet ->mergeCells('A1:I1');
            $sheet ->setCellValue('A1','Bảng Điểm Của Sinh Viên ' .$sinhvien['hoten']);

            $sheet->setCellValue("A$numRow",'Mã học phần');
            $sheet->setCellValue("B$numRow",'Tên học phần');
            $sheet->setCellValue("C$numRow",'Số tín chỉ');
            $sheet->setCellValue("D$numRow",'Điểm quá trình');
            $sheet->setCellValue("E$numRow",'Điểm giữa kỳ');
            $sheet->setCellValue("F$numRow",'Điểm thi');
            $sheet->setCellValue("G$numRow",'Điểm học phần');
            $sheet->setCellValue("H$numRow",'Điểm chữ');
            $sheet->setCellValue("I$numRow",'Hệ 4');

            $sheet ->getStyle('A1')->getFont()->setSize(16); 
            $sheet ->getRowDimension(2)->setRowHeight(15);
    
            $sheet ->getStyle('A1:C1')->getFont()->setSize(14);
            $sheet ->getColumnDimension("A")->setAutoSize(true);
            $sheet ->getColumnDimension("B")->setAutoSize(true);
            $sheet ->getColumnDimension("C")->setAutoSize(true);
            $sheet ->getColumnDimension("D")->setAutoSize(true);
            $sheet ->getColumnDimension("E")->setAutoSize(true);
            $sheet ->getColumnDimension("F")->setAutoSize(true);
            $sheet ->getColumnDimension("G")->setAutoSize(true);
            $sheet ->getColumnDimension("H")->setAutoSize(true);
            $sheet ->getColumnDimension("I")->setAutoSize(true);

            $sheet->getPageMargins()->setTop(0.7); // ~ 1.78cm
            $sheet->getPageMargins()->setHeader(0.4); // ~1.02cm
            $sheet->getPageMargins()->setRight(0.68); // ~
            $sheet->getPageMargins()->setLeft(0.7); // ~1.78cm
            $sheet->getPageMargins()->setBottom(0.68); // ~1.73cm
            $sheet->getPageMargins()->setFooter(0.4); // ~1.02cm
            $sheet ->getStyle('A1')->getFont()->setBold(true);
            $sheet ->getStyle('A2:I2')->getFont()->setBold(true);
            $sheet ->getPageMargins()->setLeft(0.8);
            $sheet ->getStyle('A1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('D6DCE4');
            $sheet ->getStyle('A2:I2')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('9BC2E6');
            $sheet ->getStyle('A2:I2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet ->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             
            $sql1 = "SELECT mahp,tenhp,sotc,quatrinh,giuaky,cuoiky,diem_hp,diemchu,he4 FROM hocphan,diemthi WHERE hocphan.idmon=diemthi.idmon AND MaSV=$xuat AND id_cn=$xuat_cn";
            $hocphan = mysqli_query($link, $sql1);
    
            while($hp = mysqli_fetch_assoc($hocphan)){
                $numRow++;
                $sheet->setCellValue("A$numRow",$hp['mahp']); 
                $sheet->setCellValue("B$numRow",$hp['tenhp']);
                $sheet->setCellValue("C$numRow",$hp['sotc']);
                $sheet->setCellValue("D$numRow",$hp['quatrinh']);
                $sheet->setCellValue("E$numRow",$hp['giuaky']);
                $sheet->setCellValue("F$numRow",$hp['cuoiky']);
                $sheet->setCellValue("G$numRow",$hp['diem_hp']);
                $sheet->setCellValue("H$numRow",$hp['diemchu']);
                $sheet->setCellValue("I$numRow",$hp['he4']);
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
        $sheet->getStyle('A2:I2')->applyFromArray($stylename);
        $sheet->getStyle('A1:' . 'I'.($numRow))->applyFromArray($styleArray);
        $sheet->getStyle('B3:' . 'I'.($numRow))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
        $filename = "bangdiem.xlsx";
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