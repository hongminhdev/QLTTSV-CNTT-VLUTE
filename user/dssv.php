<?php
    session_start();
    if(isset($_SESSION['email']))
    {
    $link = new mysqli('localhost','root','','sinhvien') or die('failed');
    mysqli_query($link, 'SET NAMES UTF8');
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
				<!-- <div id="main-contain"> style="text-align: center;" -->
                <div id="menu">
                        <ol style="font-size: 20px; margin-left: -2px;" class="breadcrumb"> DANH SÁCH SINH VIÊN CÁC LỚP KHOA CÔNG NGHỆ THÔNG TIN
                            <li style="margin-top: -3px;"> <a href="index.php" ><i class="fa fa-home"></i> Trang chính </a> </li> 
                            <span style="font-size: 11px; margin-top: 8px;"> > </span> &nbsp;  &nbsp; &nbsp; 
                            <li style="margin-top: -3px;"> <a href="dssv.php"><i class="fa fa-users"></i> Danh sách sinh viên</a> </li>
                            <!-- &nbsp; &nbsp; <span style="font-size: 11px; margin-top: 8px;"> > </span> &nbsp;  &nbsp; &nbsp; -->
                            
                        </ol>
                </div>
					<!-- <h2 >  </h2> -->
						<div id="listSV">
							<table width = "70%">
								<tr>
                                    <th>STT</th>
                                    <th>Mã lớp</th>
                                    <th>Tên lớp</th>
                                    <th>Khóa</th>
                                    <th>Cố vấn học tập</th>
                                    <th>Xem danh sách sinh viên</th>
                                </tr>
                                
                                <?php
                                    $dem = 0;
                                    $kq = mysqli_query($link, "SELECT *FROM lophoc");
                                    while($row = mysqli_fetch_array($kq))
                                    {
                                        $dem += 1;
                                        ?>
                                            <tr>
                                                <td scope="row"><?php echo $dem ?></td>
                                                <td><?php echo $row['malop'] ?></td>
                                                <td><?php echo $row['tenlop'] ?></td>
                                                <td><?php echo $row['khoa'] ?></td>
                                                <td><?php echo $row['covanhoctap'] ?></td>
                                                <td><a href="sinhvien.php?id=<?php echo $row['lopID']; ?>" style="margin-left: 5%;"><i  class="fa fa-eye"></i></a></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
							</table>
						</div>
					<!-- <form id="formChucnang">
						<a href="chucnang/themlop.php" ><input  id="btnThemSV" type="button" value="THÊM LỚP"> </a>
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
    else{
        header('location: user_login.php');
    }
?>
</body>
</html>

        <!-- <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script> -->
                           