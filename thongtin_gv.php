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
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

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
        
        <style>
                        /* body{
                            margin: 0 auto;
                            padding: 0;
                            background: #fff;
                        } */
                        /* .left{
                            left: 25px;
                        }
                        .right{
                            right: 25px;
                        }
                        .center{
                            text-align: center;
                        }
                        .bottom{
                            position: absolute;
                            bottom: 25px;
                        } */
                        
                                           
    </style>        
    </head>
    <body>
        
        <!--wrapper start-->
        <div class="wrapper">
            <?php include 'header.php' ?>
            
            <?php
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
            ?>
            <div class="main-container" style="background-color: white;">
                <!-- <span style="font-size: 30px; font-family: Arial; font-weight: bold;">Trang Chủ</span> -->
                        
                    <!--Profile card start-->
                    <!-- <div id="gradient"></div>
                    <div id="card_gv">
                        <img src="image/u1.png" alt="">
                        <center><h1>Thông tin giảng viên</h1></center>
                        <p>Student</p>
                        <p>
                            djfhsjdjhjdghjgdhh,HTML5
                        </p>

                        <p>
                            djfhjfdhjffhjdfhdjfh

                            <br> <br>

                        
                        </p>

                        <span class="left bottom">Phan Anh Cang
                        </span>
                        <span class="right bottom">
                            
                        </span>
                    </div> -->

                    <div class="page-wrap" >

                        <div class="card-gv">
                        <div class="card-inner">
                            <div class="card-header">
                                <img src="image/u1.png" alt="Logo" class="logo" />
                                <h2> <?php echo "Giảng viên " .$hotenGV ?> </h2>
                                <div class="cross"></div>
                            </div>

                            <div class="card-body" style="background-color: #F2EFEF">
                                <h2>Thông tin giảng viên</h2>
                                <p><strong>Trình độ:</strong> <?php echo $trinhdoGV ?>  </p>
                                <p>
                                     Mã số giảng viên: <?php echo $maso ?>
                                </p>
                                <p>
                                    Chức vụ: <?php echo $chucvu ?>
                                </p>
                                <p> 
                                    Chuyên môn: <?php echo $chuyenmonGV ?> 
                                </p>
                                <p>
                                    Email: <?php echo $email ?>
                                </p>
                                
                            </div>

                            <div class="card-footer">
                                <div class="icons">
                                    <a href="#" class="icon instagram"></a>
                                    <a href="#" class="icon facebook"></a>
                                    <a href="#" class="icon twitter"></a>
                                    <a href="#" class="icon youtube"></a>
                                </div>
                            </div>
                        </div>
                        </div>

                    </div>
                    <div class="icons">
                        
                    </div>
                    <!--Profile card end-->
                <div>
                    <!-- <img src="image/spkt.jpg"> -->
                </div> 
            </div>
            <!--main container end-->
        </div>
        <!--wrapper end-->

<?php
    }
    else {
        header('location: login.php');
    }
?>
                    
    </body>
</html>
                           