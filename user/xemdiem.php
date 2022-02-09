<?php
   include '../connect/connect.php';
   session_start();
   if(isset($_SESSION['email'])){
?>

<?php
    error_reporting(0);
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Student Information Manager</title>
        <link rel="shortcut icon" href="../image/vlute.ico">
        <link rel="stylesheet" href="../style/style1.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
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
                                ?>
							</table>
                            
						</div>
                        <!-- <form method="POST" enctype="multipart/form-data" id="formChucnang">
                            <input type="file" name="file" id="btnThemSV" value="THEM HOC PHAN" required> <br>
                            <button type="submit" name="btnGui" style="padding: 8px; font-size: 14px;">THÊM ĐIỂM HỌC PHẦN</button>
                        </form> -->
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
		header('location: user_login.php');
	}
?>
</body>
</html>