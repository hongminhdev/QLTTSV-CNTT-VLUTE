<?php
   include 'connect/connect.php';
   session_start();
   if(isset($_SESSION['username'])){
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
         $tenlop = '';
         $id = $_GET['id'];
         echo $id;
         $res = mysqli_query($link, "SELECT *FROM lophoc WHERE lopID=$id");
         while($row = mysqli_fetch_array($res))
         {
             $tenlop = $row['tenlop'];
         }
    ?>     
    
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
            <!--header menu start-->
            <div class="header">
                <div class="header-menu">
                    <div class="title">Coding <span>Snow</span></div>
                    <div class="sidebar-btn">
                        <i class="fas fa-bars"></i>
                    </div>
                    <ul>
                        <!-- <li><a href="#"><i class="fas fa-search"></i></a></li>
                        <li><a href="#"><i class="fas fa-bell"></i></a></li> -->
                        <li><a href="dangxuat.php"><i class="fas fa-sign-out-alt"></i></a></li>
                    </ul>
                </div>
            </div>
            <!--header menu end-->
            <!--sidebar start-->
            <div class="sidebar">
                <div class="sidebar-menu">
                    <!-- <center class="profile">
                        <img src="1.jpg" alt="">
                        <p>Jessica</p>
                    </center> -->
                    <li class="item">
                        <a href="index.php" class="menu-btn">
                            <i class="fas fa-home"></i><span>Trang chính</span>
                        </a>
                    </li>
                    <li class="item" id="profile">
                        <a href="lop.php" class="menu-btn">
                            <i class="fas fa-users"></i><span>Lớp</span>
                        </a>
                    </li>
                    <!-- <li class="item">
                        <a href="dssv.php" class="menu-btn">
                            <i class="fas fa-user-graduate"></i><span>Sinh viên<i class="fas fa-chevron-down drop-down"></i></span>
                        </a>
                    </li> -->
                    <li class="item">
                        <a href="dssv.php" class="menu-btn">
                            <i class="fas fa-user-graduate"></i><span>Sinh viên</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="diemthi.php" class="menu-btn">
                            <i class="fas fa-book-open"></i><span>Bảng điểm</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="daotao.php" class="menu-btn">
                            <i class="fas fa-check"></i><span>Chương trình đào tạo</span> 
                        </a>
                    </li>
                    <li class="item">
                        <a href="giangvien.php" class="menu-btn">
                            <i class="fas fa-chalkboard-teacher"></i><span>Giảng viên</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="contact.php" class="menu-btn">
                            <i class="fas fa-address-book"></i><span>Contact</span>
                        </a>
                    </li>
                </div>
            </div>
            <!--sidebar end-->
            <!--main container start-->
            <div class="main-container">
				<div id="main-contain">
					<h2> DANH SÁCH SINH VIÊN LỚP <?php echo $tenlop ?> </h2>
                        <div id="listSV">
							<table width = "70%">
								<tr>
                                    <th> STT </th>
                                    <th> Mã số sinh viên</th>
                                    <th> Họ tên </th>
                                    <th> Ngày sinh </th>
                                    <th> Giới tính </th>
                                    <th> Số điện thoại </th>
                                    <th> Địa chỉ </th>
                                    <th> Chuyên ngành </th>
                                    <th> Email </th>
                                    <th> Chi tiết </th>
                                </tr>
                                
                                <?php
                                    $dem = 0;
                                    $query = "SELECT * FROM sinhvien WHERE sinhvien.lopID = '".$_GET['id']."'";
	                                $kq = mysqli_query($link, $query);
                                    // $kq = mysqli_query($link, "SELECT *FROM sinhvien");
                                    if(mysqli_num_rows($kq) > 0){
                                        while($row = mysqli_fetch_array($kq))
                                        {
                                        $dem += 1;
                                        ?>
                                            <tr>
                                                <td scope="row"> <?php echo $dem ?> </td>
                                                <td><?php echo $row['MaSV'] ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['ngaysinh'] ?></td>
                                                <td><?php echo $row['gioitinh'] ?></td>
                                                <td><?php echo $row['sodt'] ?></td>
                                                <td><?php echo $row['diachi'] ?></td>
                                                <td><?php echo $row['chuyennganh'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><a href="thongtinsv.php?id=<?php echo $row['sinhvienID'] ?>"><i class="fas fa-check-square"></i></a></td>
                                            </tr>
                                        <?php
                                        }
                                    }else{
                                        echo '<tr > <td colspan="10" align = "center">Chưa có sinh viên ở lớp này! </td></tr>';
                                    }                                 
                                ?>
							</table>
                            <br>
							    <p style="color: white; text-align:center;"><b> SĨ SỐ: <?php echo $dem;?> </b></p>
						</div>
					<!-- <form id="formChucnang">
						<a href="chucnang/themlop.php" ><input  id="btnThemSV" type="button" value="THÊM LỚP"> </a>
					</form> -->
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