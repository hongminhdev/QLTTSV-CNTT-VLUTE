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
    </head>
    <body>

        <!--wrapper start-->
        <div class="wrapper">
            <?php include 'header.php' ?>

            <div class="main-container">
				<div id="main-contain">
					<h2> HỒ SƠ SINH VIÊN </h2>
                        <div id="thongtin">
                            <div id="avtHoso">
                                <?php
                                    if (isset($_POST['upload'])){
                                        $file = $_FILES['avt'];
                                        move_uploaded_file($file['tmp_name'],"upload/".$file['name']);
                                        $link_avt = $file['name'];
                                        $q = 'UPDATE sinhvien SET avt = "'.$link_avt.'" WHERE  sinhvienID = "'.$_GET['id'].'"';
                                        mysqli_query($link, $q) or die('không cập nhật được');
                                        echo "<div> Đã cập nhật </div>";
                                    }  
                                    $query = 'SELECT * FROM sinhvien WHERE sinhvienID = "'.$_GET['id'].'" '; 
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
                                            $quequan = $r['diachi'];
                                            $email = $r['email'];
                                            $cn = $r['chuyennganh'];
                                            $avt = $r['avt'];
                                        }
                                    }
                                                                      
                                    $q = 'SELECT tenlop FROM lophoc WHERE lopID = "'.$lopID.'" '; 
                                    $rs = mysqli_query($link, $q);
                                    $r1 = mysqli_fetch_assoc($rs);
                                    $tenlop = $r1['tenlop'];

                                    $q1 = 'SELECT khoa FROM lophoc WHERE lopID = "'.$lopID.'" ';
                                    $rs1 = mysqli_query($link, $q1);
                                    $r2 = mysqli_fetch_assoc($rs1);
                                    $khoa = $r2['khoa'];
                                    //   echo $tenlop; 
                                
                                    if($avt == ""){
                                        echo '<img src= "image/test.jpg" width="200px" height="200px">';
                                    }
                                    else{
                                    echo '<img src= "upload/'.$avt.'" width="200px" height="200px">';
                                    }
                                    echo " <br><b> ".$ten."</b>";
                                    echo "<br> MSSV: ".$masv;
                                ?>
                                <!-- <form method="post" name="upload_avt" enctype="multipart/form-data">
                                    <input type="file" name = "avt" id="file" class="input_file"> 
                                    <label for ="file"> chọn file</label>
                                    <input type="submit" name = "upload" value= "upload">
  
                                </form> -->
                                
                            </div>
                            <div id="chi_tiet">
                                <?php
                                    echo "<big>Họ tên: ";
                                    echo $ten. "</big>";
                                    echo "<br>Ngày sinh: " .$ngaysinh. "<br>";
                                    echo "Giới tính: " .$gt. "<br>";
                                    echo "Mã số sinh viên: " .$mssv;
                                    echo "<br>Khóa: " .$khoa. "<br>";
                                    echo "Lớp: " .$tenlop. "<br>";
                                    echo "Chuyên ngành: " .$cn . "<br>";
                                    echo "Email: " .$email ."<br>";                                  
                                                                                            
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
</body>
</html>