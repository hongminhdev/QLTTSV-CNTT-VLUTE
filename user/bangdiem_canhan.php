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
                $id = '';
                $query = "SELECT  *FROM sinhvien WHERE email = '$null' "; 
                
                $result = mysqli_query($link, $query);
                while($row = mysqli_fetch_array($result)){
                    $id = $row['sinhvienID'];
                }
            ?>
            <div class="main-container" style="background-color: white;">
                
                    <div id="menu">
                        <ol style="font-size: 20px; margin-left: -2px;" class="breadcrumb"> Bảng Điểm Cá Nhân</ol>
                    </div>

                <!-- bat dau -->
                <div id="listSV">
							<table width = "70%">
								<tr>
									<th> STT </th>
									<th> Mã học phần </th>
									<th> Tên học phần </th>
									<th> Số tín chỉ </th>
                                    <th> Quá trình </th>  
                                    <th> Giữa kỳ </th>   
                                    <th> Điểm thi </th>
                                    <th> Điểm HP </th>
                                    <th> Điểm chữ </th>
                                    <th> Hệ 4 </th>
								</tr>

                                <?php
                                    $d = 0;
                                    $kq1 = mysqli_query($link, "SELECT *FROM hocphan,sinhvien WHERE sinhvien.email='$null' AND hocphan.id_cn=sinhvien.id_cn ");
                                    // $kq2 = mysqli_query($link, "SELECT *FROM diemthi");
                                    // $run = mysqli_fetch_array($kq2);
                                    
                                    while($r = mysqli_fetch_assoc($kq1)){
                                        $d = $d + 1;
                                        $mon = $r['idmon'];
                                        ?>
                                            <tr>
                                                <td scope="row"><?php echo $d ?></td>
                                                <td><?php echo $r['mahp'] ?></td>
                                                <td><?php echo $r['tenhp'] ?></td>
                                                <td><?php echo $r['sotc'] ?></td>
                                                <td>
                                                    <?php $qt= mysqli_query($link, "SELECT quatrinh FROM diemthi WHERE MaSV='$id' AND idmon='$mon'");
                                                        while($r1 = mysqli_fetch_assoc($qt)){
                                                            ?>
                                                                <span><?php echo $r1['quatrinh'] ?></span>
                                                            <?php
                                                        } ?>
                                                </td>
                                                <td>
                                                    <?php $gk= mysqli_query($link, "SELECT giuaky FROM diemthi WHERE MaSV='$id' AND idmon='$mon'");
                                                        while($r2 = mysqli_fetch_assoc($gk)){
                                                            ?>
                                                                <span><?php echo $r2['giuaky'] ?></span>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php $ck= mysqli_query($link, "SELECT cuoiky FROM diemthi WHERE MaSV='$id' AND idmon='$mon'");
                                                        while($r3 = mysqli_fetch_assoc($ck)){
                                                            ?>
                                                                <span><?php echo $r3['cuoiky'] ?></span>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php $dhp= mysqli_query($link, "SELECT diem_hp FROM diemthi WHERE MaSV='$id' AND idmon='$mon'");
                                                        while($r4 = mysqli_fetch_assoc($dhp)){
                                                            ?>
                                                                <span><?php echo $r4['diem_hp'] ?></span>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php $dc= mysqli_query($link, "SELECT diemchu FROM diemthi WHERE MaSV='$id' AND idmon='$mon'");
                                                        while($r5 = mysqli_fetch_assoc($dc)){
                                                            ?>
                                                                <span><?php echo $r5['diemchu'] ?></span>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php $hb= mysqli_query($link, "SELECT he4 FROM diemthi WHERE MaSV='$id' AND idmon='$mon'");
                                                        while($r6 = mysqli_fetch_assoc($hb)){
                                                            ?>
                                                                <span><?php echo $r6['he4'] ?></span>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <!-- <td>  
                                                    <a class="edit_btn">
                                                        <i style="color: #0066CC; margin-left: 0%;" class="fa fa-edit"></i>
                                                    </a>
                                                </td> -->
                                            </tr>
                                        <?php
                                    }
                                ?>
							</table>
						</div>
                
                <!-- ket thuc -->
            
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
                           