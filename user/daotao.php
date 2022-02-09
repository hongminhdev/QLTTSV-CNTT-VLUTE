<?php
	session_start();
	include '../connect/connect.php';
	if (isset($_SESSION['email'])){
	$link = new mysqli('localhost','root','','sinhvien') or die('kết nối thất bại '); 
	mysqli_query($link, 'SET NAMES UTF8');
	$query = "SELECT *FROM chuyennganh";
	$kq = mysqli_query($link, $query);
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
		
		<link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
        <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
        
        
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="../vendors/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		
    </head>
    <body>

        <!--wrapper start-->
        <div class="wrapper">
            <?php include 'header.php' ?>

            <div class="main-container">
				<div id="main-contain">
					<h4> CHUYÊN NGÀNH ĐÀO TẠO CÔNG NGHỆ THÔNG TIN </h4>
						<?php
							if(mysqli_num_rows($kq)>0){
								$i = 0;
								while($row = mysqli_fetch_assoc($kq))
								{
									$i++;
									$id = $row['id_cn'];
									$macn = $row['macn'];
									$tencn = $row['tencn'];
									$avt = $row['avt'];
									echo '<div class="infGiangvien">
									<div>
										<a href="chuyennganh.php?id='.$id.'"><img src="../image/';
										if($avt == '' && $id == 1){
											echo 'cb.jfif';
										}else if($avt == '' && $id == 2){
											echo 'sw.jfif';
										}else if($avt == '' && $id == 3){
											echo 'mmt.jpg';
										}else if($avt == '' && $id == 4){
											echo 'httt.jpg';
										}else if($avt == '' && $id == 5){
											echo 'khmt.jpg';
										}
										else{
											echo $avt;
										}
										echo '" width="120px" height = "120px">  </a>
									</div>
									<div>
                                    ';
                                    echo "<i><small>$tencn</small></i><br>";
                                    // echo "<i><small>$trinhdoGV</small></i><br>";
                                    // echo "<i><small>email: $email</small></i><br>";
                                    echo "</div>";
                                    echo "</div>"; 
								}
							}
						?>
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
		header('location: user_login.php');
	}
?>
</body>
</html>