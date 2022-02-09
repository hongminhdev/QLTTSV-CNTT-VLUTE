<?php
	session_start();
	if (isset($_SESSION['username'])){
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
    </head>
    <body>

        <!--wrapper start-->
        <div class="wrapper">
            <?php include 'header.php' ?>
            
            <div class="main-container">
				<div id="main-contain">
					<h4> THÔNG TIN GIẢNG VIÊN </h4>
						<div id="thongtin">
							<div id="avtHoso">
								<?php
									$link = new mysqli('localhost','root','','sinhvien') or die('kết nối thất bại ');
									mysqli_query($link, 'SET NAMES UTF8');
									if (isset($_POST['upload'])){
										$file = $_FILES['avt'];
										move_uploaded_file($file['tmp_name'], "upload/".$file['name']);
										$link_avt = $file['name'];
										$query = 'UPDATE giangvien SET link_avt_GV = "'.$link_avt.'" WHERE  masoGV ="'.$_GET['id'].'"';
										mysqli_query($link, $query) or die('không thành công');
									}
									$query = 'SELECT * FROM giangvien WHERE masoGV = "'.$_GET['id'].'" ';
									$result = mysqli_query($link, $query);
									if( mysqli_num_rows($result) > 0 )
									{
										$i = 0;
										while($row= mysqli_fetch_assoc($result))
										{
											$i++;
											$maso = $row['masoGV'];
											$hotenGV = $row['hoten'];
											$trinhdoGV = $row['trinhdo'];
											$chucvu = $row['chucvu'];
											$chuyenmonGV = $row['chuyenmon'];
											$email = $row['email'];
											$sdt = $row['sdt'];
											$avt = $row['link_avt_GV'];
										}
									}
									if ($avt == '') {
										echo '<img src= "image/a.jpg" width="200px" height="200px">';
									}
									else 
										echo '<img src= "upload/'.$avt.'" width="200px" height="200px">';
										// echo " <br><b> ".$hotenGV."</b>"; 
										echo "<big><br><b> " .$hotenGV. "</big><br></b>";
								?>
								
								<form method="post" name="upload_avt" enctype="multipart/form-data">
									<input type="file" name = "avt" id="file" class="input_file">
									<label for ="file"> Chọn ảnh </label>
									<input type="submit" name="upload" value="Thay đổi">
								</form>

							</div>
							<div id="chi_tiet">
								<?php
									echo "<big> Họ tên: " .$hotenGV. "</big><br><br>";
									echo "Trình độ: " .$trinhdoGV . "<br>";
									echo "Chức vụ: " .$chucvu . "<br>";
									echo "Mã số giảng viên: " .$maso . "<br>";
									echo "Email: " .$email . "<br>";
									echo "Chuyên môn: " .$chuyenmonGV ;
								?>
							</div>
						</div>
 
		      </div>
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