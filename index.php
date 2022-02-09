<?php
    // session_start();
    // if(isset($_SESSION['username'])){

    // $link = new mysqli('localhost','root','','sinhvien') or die('failed');
    // mysqli_query($link, 'SET NAMES UTF8');
    // $query = 'SELECT * FROM tintuc';
    // $kq = mysqli_query($link, $query);

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
        <?php
            $count_sv = '';
            $sv = mysqli_query($link, "SELECT *FROM sinhvien");
            while($row = mysqli_fetch_assoc($sv)){
                $count_sv++;
            }

            $lop = mysqli_query($link, "SELECT *FROM lophoc");
            $count_lop = '';
            while($row = mysqli_fetch_assoc($lop)){
                $count_lop++;
            }

            $cn = mysqli_query($link, "SELECT *FROM chuyennganh");
            $count_cn = '';
            while($row = mysqli_fetch_assoc($cn)){
                $count_cn++;
            }

            $gv = mysqli_query($link, "SELECT *FROM giangvien");
            $count_gv = '';
            while($row = mysqli_fetch_assoc($gv)){
                $count_gv++;
            }
        ?>
        
        <!--wrapper start-->
        <div class="wrapper">
            <?php include 'header.php' ?>
            
            <div class="main-container" style="background: #F2EFEF;">
                <!-- <span style="font-size: 30px; font-family: Arial; font-weight: bold;">Trang Chủ</span> -->

                <div class="right">
                    <div class="right__content">
                        <div class="right__title"> QUẢN LÝ THÔNG TIN SINH VIÊN </div>
                        <p class="right__desc"> Thống kê </p>
                        <div class="right__cards">
                            <a class="right__card" href="dssv.php">
                                <div class="right__cardTitle"> Tổng số sinh viên </div>
                                <div class="right__cardNumber"><?php echo $count_sv ?></div>
                                <div class="right__cardDesc">Xem Chi Tiết <img src="image/arrow-right.svg" alt=""></div>
                            </a>
                            <a class="right__card" href="lop.php">
                                <div class="right__cardTitle"> Tổng số lớp </div>
                                <div class="right__cardNumber"><?php echo $count_lop ?></div>
                                <div class="right__cardDesc">Xem Chi Tiết <img src="image/arrow-right.svg" alt=""></div>
                            </a>
                            <a class="right__card" href="daotao.php">
                                <div class="right__cardTitle"> Tổng số chuyên ngành </div>
                                <div class="right__cardNumber"><?php echo $count_cn ?></div>
                                <div class="right__cardDesc">Xem Chi Tiết <img src="image/arrow-right.svg" alt=""></div>
                            </a>
                            <a class="right__card" href="giangvien.php">
                                <div class="right__cardTitle"> Tổng số giảng viên </div>
                                <div class="right__cardNumber"><?php echo $count_gv ?></div>
                                <div class="right__cardDesc">Xem Chi Tiết <img src="image/arrow-right.svg" alt=""></div>
                            </a>
                            <a class="right__card" href="danhsach_user.php">
                                <div class="right__cardTitle"> Thông tin users </div>
                                <div class="right__cardNumber"><?php echo $count_sv ?></div>
                                <div class="right__cardDesc">Xem Chi Tiết <img src="image/arrow-right.svg" alt=""></div>
                            </a>
                            <a class="right__card" href="dsdiem.php">
                                <div class="right__cardTitle"> Bảng điểm sinh viên </div>
                                <div class="right__cardNumber"><h5></h5></div>
                                <div class="right__cardDesc">Xem Chi Tiết <img src="image/arrow-right.svg" alt=""></div>
                            </a>
                            <a class="right__card" href="admin.php">
                                <div class="right__cardTitle"> Thông tin cá nhân </div>
                                <div class="right__cardNumber"><h5>Admin</h5></div>
                                <div class="right__cardDesc">Xem Chi Tiết <img src="image/arrow-right.svg" alt=""></div>
                            </a>
                        </div>
                        
                        </div>
                    </div>
                </div>

                <div>
                    <!-- <img src="image/spkt.jpg"> -->
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
        header('location: login.php');
    }
?>
        

</body>
</html>
                           