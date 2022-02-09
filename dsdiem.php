<?php
	include 'connect/connect.php';
    session_start();
    if(isset($_SESSION['username'])){
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
                    <div id="menu">
                        <ol style="font-size: 20px; margin-left: -2px;" class="breadcrumb"> DANH SÁCH ĐIỂM HỌC PHẦN CÁC LỚP KHOA CNTT
                            <li style="margin-top: -3px;"> <a href="index.php" ><i class="fa fa-home"></i> Trang chính </a> </li> 
                            <span style="font-size: 11px; margin-top: 8px;"> > </span>
                            <!-- <li style="margin-top: -3px;"> <span> > </span> </li> -->
                            <li style="margin-top: -3px;"> <a href="dsdiem.php"><i class="fa fa-users"></i> Danh sách lớp </a> </li>
                        </ol>
                    </div>
					<!-- <h2>  </h2> -->
						<div id="listSV">
							<table width = "70%">
								<tr>
									<th> STT </th>
                                    <th> Mã lớp </th>
									<th> Tên lớp </th>
									<th> Khóa </th>
									<th> Chọn lớp </th>
                                </tr>
                                
                                <?php
                                    $dem = 0;
                                    $kq = mysqli_query($link, "SELECT *FROM lophoc");
                                    while($row = mysqli_fetch_array($kq))
                                    {
                                        $dem += 1;
                                        ?>
                                            <tr>
                                                <td ><?php echo $dem ?></td>
                                                <td><?php echo $row['malop'] ?></td>
                                                <td><?php echo $row['tenlop'] ?></td>
                                                <td><?php echo $row['khoa'] ?></td>                                 
                                                <td><a href="xemdiem.php?id=<?php echo $row['lopID']; ?>"><i class="fas fa-check-circle " style="margin-left: 1%;"></i></a></td>
                                            </tr>                                           
                                        <?php
                                    }
                                ?>
							</table>
						</div>
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

<!-- fa-spin fa-1x -->
