<?php
    include '../connect/connect.php';
    session_start();
    if(isset($_SESSION['email'])){
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
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
        <!-- <link rel="stylesheet" href="profile.css"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

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
            
            <?php
                $null = $_SESSION['email'];
                $query = "SELECT * FROM chuyennganh,sinhvien WHERE chuyennganh.id_cn=sinhvien.id_cn AND email = '$null' "; 
                $result = mysqli_query($link, $query);
                if( mysqli_num_rows($result) > 0 )
                {
                    $i = 0;
                    while($r= mysqli_fetch_assoc($result))
                    {
                        $i++;
                        $lopID = $r['lopID'];
                        $masv=$r['sinhvienID'];
                        $mssv = $r['MaSV'];
                        $ten= $r['hoten'];
                        $ngaysinhsql =$r['ngaysinh'];
                        $ngaysinh = date("d-m-Y", strtotime($ngaysinhsql));
                        $gt = $r['gioitinh'];
                        $sdt = $r['sodt'];
                        $diachi = $r['diachi'];
                        // $email = $r['email'];
                        // $pass = $r['password'];
                        $cn = $r['tencn'];
                        $avt = $r['avt'];
                    }
                }
                $l = 'SELECT lopID FROM lophoc WHERE lopID = "'.$lopID.'" '; 
                $run = mysqli_query($link, $l);
                $r0 = mysqli_fetch_assoc($run);
                $id_lop = $r0['lopID'];

                $q = 'SELECT tenlop FROM lophoc WHERE lopID = "'.$lopID.'" '; 
                $rs = mysqli_query($link, $q);
                $r1 = mysqli_fetch_assoc($rs);
                $tenlop = $r1['tenlop'];

                $q1 = 'SELECT khoa FROM lophoc WHERE lopID = "'.$lopID.'" ';
                $rs1 = mysqli_query($link, $q1);
                $r2 = mysqli_fetch_assoc($rs1);
                $khoa = $r2['khoa'];

                $q2 = 'SELECT malop FROM lophoc WHERE lopID = "'.$lopID.'" ';
                $rs2 = mysqli_query($link, $q2);
                $r3 = mysqli_fetch_assoc($rs2);
                $malop = $r3['malop'];
            ?>
            <div class="main-container" style="background-color: #F2EFEF;">
                
            
                <div class="wrapper1">
                    <div class="left">
                        <img src="../image/u1.png" 
                        alt="user" width="100">
                        <h4><?php echo $ten ?></h4>
                        <h5><?php echo "Mã số sinh viên " .$mssv; ?></h5>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>THÔNG TIN SINH VIÊN</h3>
                            <div class="info_data">
                                <div class="data">
                                    <h4>Lớp</h4>
                                    <p><?php echo $tenlop ?></p>
                                </div>
                                <div class="data">
                                    <h4>Mã lớp</h4>
                                    <p><?php echo $malop ?></p>
                                </div>
                            </div>
                            <div class="info_data">
                                <div class="data">
                                    <h4>Ngày sinh</h4>
                                    <p><?php echo $ngaysinh ?></p>
                                </div>
                                <div class="data">
                                    <h4>Giới tính</h4>
                                    <p><?php echo $gt ?></p>
                                </div>
                            </div>
                            <div class="info_data">
                                <div class="data">
                                    <h4>Địa chỉ</h4>
                                    <p><?php echo $diachi ?></p>
                                </div>
                                <div class="data">
                                    <h4>Số điện thoại</h4>
                                    <p><?php echo $sdt ?></p>
                                </div>
                            </div>
                            <div class="info_data">
                                <div class="data">
                                    <h4>Chuyên ngành</h4>
                                    <p><?php echo $cn ?></p>
                                </div>
                                <div class="data">
                                    <h4>Khóa</h4>
                                    <p><?php echo $khoa ?></p>
                                </div>
                            </div>
                        </div>
                    
                        <!-- <div class="projects">
                            <h3>THÔNG TIN TÀI KHOẢN</h3>
                            <div class="projects_data">
                                <div class="data">
                                    <h4>Email</h4>
                                    <p><?php echo $email ?></p>
                                </div>
                                <div class="data">
                                    <h4>Password</h4>
                                    <p><?php echo $pass ?></p>
                                </div>
                            </div>
                        </div> -->
                    
                        <div class="social_media">
                            <ul>
                            
                            </ul>
                        </div>
                    </div>
                </div>
                
            
                    <!--Profile card end-->
                <div> 
                    
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
                           