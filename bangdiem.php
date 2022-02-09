<?php
	session_start();
	if (isset($_SESSION['username'])){
	$link = new mysqli('localhost','root','','sinhvien') or die('kết nối thất bại '); 
	mysqli_query($link, 'SET NAMES UTF8');
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
					<h2>DANH SÁCH BẢNG ĐIỂM HỌC PHẦN CÁC LỚP KHOA CÔNG NGHỆ THÔNG TIN</h2>
						<div class= "chucnang">
							<div class="infGiangvien">
							<div>
								<a href="dsdiem.php"><img src="image/xem.jpg" width="120px" height="120px";>  </a>
							</div>
							<div>
								<b> XEM ĐIỂM </b> </br>
							</div>
						</div>
						<div class="infGiangvien">
							<div>
								<a href="suadiem.php"><img src="image/sua.jpg" width="120px" height="120px";>  </a>
							</div>
							<div>
								<b> SỬA ĐIỂM  </b> </br>
							</div>
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

<?php include 'footer.php' ?>
   
<?php
	}
	else {
		header('location:login.php');
	}
?>
