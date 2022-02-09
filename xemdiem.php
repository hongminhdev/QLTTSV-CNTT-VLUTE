<?php
   include 'connect/connect.php';
   session_start();
   if(isset($_SESSION['username'])){
?>

<?php
    error_reporting(0);
?>

<?php
    require ('Classes/PHPExcel.php');
    if (isset($_POST['btnGui'])){
        $file = $_FILES['file']['tmp_name'];
        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
        $objReader->setLoadSheetsOnly('Sheet1'); 
    
        $objExcel = $objReader->load($file);
        $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);
        
        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
        for($row = 3; $row <= $highestRow; $row++){
            $masv= $sheetData[$row]['A'];
            $ma_mon = $sheetData[$row]['B'];

            $dqt = $sheetData[$row]['C'];
            $dgk = $sheetData[$row]['D'];
            $dck = $sheetData[$row]['E'];
            $dhp = $sheetData[$row]['F'];
            $dchu = $sheetData[$row]['G'];
            $heb = $sheetData[$row]['H'];

            $excel_masv = mysqli_query($link, "SELECT *FROM sinhvien");
            while($chay = mysqli_fetch_array($excel_masv))
            {
                if($masv == $chay['MaSV']){
                    $masv = $chay['sinhvienID'];
                }
            }  

            
            $excel_mamon3 = mysqli_query($link, "SELECT *FROM hocphan,sinhvien WHERE sinhvienID='$masv' AND hocphan.id_cn=sinhvien.id_cn");
            while($chay1 = mysqli_fetch_array($excel_mamon3))
            {
                // if($chay1['id_cn'] == "2"){
                    if($ma_mon == $chay1['mahp']){
                        $ma_mon = $chay1['idmon'];
                    }
                // }
            }     
            
    
            $sql = "INSERT INTO diemthi(MaSV,idmon,quatrinh,giuaky,cuoiky,diem_hp,diemchu,he4) VALUES ($masv,$ma_mon,$dqt,$dgk,$dck,$dhp,'$dchu',$heb)";
            $link->query($sql);
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Student Information Manager</title>
        <link rel="shortcut icon" href="image/vlute.ico">
        <link rel="stylesheet" href="style/style1.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

        <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>
        
    </head>
    <body>

        <!--wrapper start-->
        <div class="wrapper">
            <?php include 'header.php' ?>
            
            <div class="main-container">
				<!-- <div id="main-contain"> -->
                    <?php 
                        $tenlop = '';
                        $idlop = $_GET['id'];
                        $kq = mysqli_query($link, "SELECT *FROM lophoc WHERE lopID=$idlop");
                        while($row = mysqli_fetch_assoc($kq)){
                            $tenlop = $row['malop'];
                        }
                        
                    ?>
                    <div id="menu">
                        <ol style="font-size: 20px; margin-left: -2px;" class="breadcrumb"> Danh Sách Bảng Điểm Sinh Viên Lớp <?php echo $tenlop ?>
                            <!-- <li style="margin-top: -3px;"> <a href="index.php" ><i class="fa fa-home"></i> Trang chính </a> </li>  -->
                            <!-- <span style="font-size: 11px; margin-top: 8px;"> > </span> -->
                            <!-- <li style="margin-top: -3px;"> <span> > </span> </li> -->
                            <li style="margin-top: -3px;"> <a href="dsdiem.php"><i class="fa fa-users"></i> Danh sách lớp </a> </li>
                            &nbsp; &nbsp; <span style="font-size: 11px; margin-top: 8px;"> > </span> &nbsp;  &nbsp; 
                            <li style="margin-top: -3px;"> <a href="xemdiem.php?id=<?php echo $idlop ?>"><i class="fa fa-user"></i> Danh sách sinh viên <?php  ?></a> </li>
                        </ol>
                    </div>
					<!-- <h2>  </h2> -->
                        <div id="listSV">
							<table width = "70%">
								<tr>
                                    <th> STT </th>
                                    <th> Họ tên </th>
                                    <th> Mã số sinh viên</th>                                  
                                    <th> Chuyên ngành </th>
                                    <th> Email </th>
                                    <th> Xem điểm </th>
                                </tr>
                                
                                <?php									
									$query = "SELECT * FROM chuyennganh,sinhvien WHERE chuyennganh.id_cn=sinhvien.id_cn AND sinhvien.lopID = '".$_GET['id']."' ORDER BY MaSV ASC";
									
                                    $dem = 0;
                                    // $query = "SELECT * FROM sinhvien WHERE sinhvien.lopID = '".$_GET['id']."'";
	                                $kq = mysqli_query($link, $query);
                                    // $kq = mysqli_query($link, "SELECT *FROM sinhvien");
                                    if(mysqli_num_rows($kq) > 0){
                                        while($row = mysqli_fetch_array($kq))
                                        {
                                        	$dem += 1;
                                        	?>
                                            <tr>
                                                <td scope="row"> <?php echo $dem ?> </td>
                                                <td><?php echo $row['hoten'] ?></td>
                                                <td><?php echo $row['MaSV'] ?></td>
                                                <td><?php echo $row['tencn'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><a href="xemdiemsv.php?id=<?php echo $row['sinhvienID']; ?>&id_cn=<?php echo $row['id_cn']; ?>"><i class="fa fa-eye" style="margin-left: 1%;"></i></a></td>
                                            </tr>
                                        	<?php 
                                        }
                                    }
                                    else{
                                        echo '<tr > <td colspan="12" align = "center"> Không có dữ liệu </td></tr>';
                                    }                        
                                ?>
							</table>
                            
						</div>
                        <form method="POST" enctype="multipart/form-data" id="formChucnang">
                            <input type="file" name="file" id="btnThemSV" value="THEM HOC PHAN" required> <br>
                            <button type="submit" name="btnGui" style="padding: 8px; font-size: 14px;">THÊM ĐIỂM HỌC PHẦN</button>
                        </form>
		      <!-- </div> -->
            </div>
            <!--main container end-->
        </div>
        <!--wrapper end-->

        <script type="text/javascript">
        $(document).ready(function(){
            $(".sidebar-btn").click(function(){
                $(".wrapper").toggleClass("collapse");
            });
        });
        </script>
<?php
	}
	else {
		header('location:login.php');
	}
?>
</body>
</html>