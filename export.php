<?php
    include 'connect/connect.php';
    $xuat = $_POST['xuat'];
    session_start();
    
            require ('Classes/PHPExcel.php');
            if(isset($_POST['btnExport'])){
                $objExcel = new PHPExcel;
            
                $numSheet = 0;
                $sql = "SELECT *FROM lophoc WHERE lopID=$xuat";
                // $result = $mysqli->query($sql);
                $result = mysqli_query($link, $sql);
                while($lop = mysqli_fetch_assoc($result)){
                    // print_r($lop); die;
                    $objExcel->createSheet();
                    $objExcel->setActiveSheetIndex($numSheet);
                    $sheet = $objExcel->getActiveSheet()->setTitle($lop['malop']);
            
                    $numRow = 2;
                    $sheet ->getDefaultRowDimension()->setRowHeight(20);
                    $sheet ->mergeCells('A1:G1');
                    $sheet ->setCellValue('A1','DANH SÁCH SINH VIÊN LỚP ' .$lop['malop']);

                    $sheet->setCellValue("A$numRow",'Mã số sinh viên');
                    $sheet->setCellValue("B$numRow",'Họ tên');
                    $sheet->setCellValue("C$numRow",'Ngày sinh');
                    $sheet->setCellValue("D$numRow",'Giới tính');
                    $sheet->setCellValue("E$numRow",'Số điện thoại');
                    $sheet->setCellValue("F$numRow",'Địa chỉ');
                    $sheet->setCellValue("G$numRow",'Chuyên ngành');

                    $sheet ->getStyle('A1')->getFont()->setSize(16); 
                    $sheet ->getRowDimension(2)->setRowHeight(15);
    
                    $sheet ->getStyle('A1:C1')->getFont()->setSize(14);
                    $sheet ->getColumnDimension("A")->setAutoSize(true);
                    $sheet ->getColumnDimension("B")->setAutoSize(true);
                    $sheet ->getColumnDimension("C")->setAutoSize(true);
                    $sheet ->getColumnDimension("E")->setAutoSize(true);
                    $sheet ->getColumnDimension("F")->setAutoSize(true);
                    $sheet ->getColumnDimension("G")->setAutoSize(true);

                    $sheet->getPageMargins()->setTop(0.7); // ~ 1.78cm
                    $sheet->getPageMargins()->setHeader(0.4); // ~1.02cm
                    $sheet->getPageMargins()->setRight(0.68); // ~
                    $sheet->getPageMargins()->setLeft(0.7); // ~1.78cm
                    $sheet->getPageMargins()->setBottom(0.68); // ~1.73cm
                    $sheet->getPageMargins()->setFooter(0.4); // ~1.02cm
                    $sheet ->getStyle('A1')->getFont()->setBold(true);
                    $sheet ->getStyle('A2:G2')->getFont()->setBold(true);
                    $sheet ->getPageMargins()->setLeft(0.8);
                    $sheet ->getStyle('A1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('D6DCE4');
                    $sheet ->getStyle('A2:G2')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('9BC2E6');
                    $sheet ->getStyle('A2:G2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $sheet ->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                     
                    $sql1 = "SELECT MaSV,hoten,ngaysinh,gioitinh,sodt,diachi,tencn FROM chuyennganh,sinhvien WHERE sinhvien.id_cn=chuyennganh.id_cn AND lopID=$xuat";
                    $sinhvien = mysqli_query($link, $sql1);
            
                    while($sv = mysqli_fetch_assoc($sinhvien)){
                        $numRow++;
                        $sheet->setCellValue("A$numRow",$sv['MaSV']); 
                        $sheet->setCellValue("B$numRow",$sv['hoten']);
                        $sheet->setCellValue("C$numRow",$sv['ngaysinh']);
                        $sheet->setCellValue("D$numRow",$sv['gioitinh']);
                        $sheet->setCellValue("E$numRow",$sv['sodt']);
                        $sheet->setCellValue("F$numRow",$sv['diachi']);
                        $sheet->setCellValue("G$numRow",$sv['tencn']);
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
                $sheet->getStyle('A2:G2')->applyFromArray($stylename);
                $sheet->getStyle('A1:' . 'G'.($numRow))->applyFromArray($styleArray);
                $sheet->getStyle('B3:' . 'G'.($numRow))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
                $filename = "danhsach_sinhvien.xlsx";
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














        