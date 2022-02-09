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
        <link rel="shortcut icon" href="image/lgvlute.png">
        <link rel="stylesheet" href="style/style1.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    </head>
    <body>

        <!--wrapper start-->
        <div class="wrapper">
            <?php echo include 'header.php' ?>
            <div class="main-container">
                <!-- <div id="main-contain">  -->
                    <?php
                        $malop = '';
                        $id = $_GET['id'];
                        // $res = mysqli_query($link, "SELECT *FROM lophoc WHERE lopID=$id");
                        $query = "SELECT * FROM lophoc WHERE lopID =$id ";
                        $result = mysqli_query($link, $query);
                        // while($row = mysqli_fetch_array($res))
                        // {
                        //  $malop = $row['malop'];
                        // }
                        
                        if( mysqli_num_rows($result) > 0){
                            $i=0;
                            while ($r = mysqli_fetch_assoc($result)){
                                    $i++;
                                    $malop = $r['malop'];
                                    $tenlop = $r['tenlop'];
                                    $khoa = $r['khoa'];
                                    $covan =$r['covanhoctap'];                      
                            }
                        }
                    ?>
                    <h2> CHỈNH SỬA THÔNG TIN LỚP </h2>
                    
                        <div class="form">
                            <span style="font-size: 25px; color: blue; "><b> Cập nhật thông tin lớp <?php echo $malop ?></b>
                            </span> <br> <span style="color: black; font-style: italic;">(Chú ý điền đầy đủ thông tin)</span>
                            <br> <br>
                            <form method="POST">
                                <table>
                                    <tr>
                                        <td>Mã lớp: </td>
                                        <td> <input type="text" name="malop" disabled style="width: 120%;" value="<?php echo $malop ?>"> </td>
                                    </tr>
                                    <tr>
                                        <td>Tên lớp: </td>
                                        <td> <input type="text" name="tenlop" style="width: 120%;" value="<?php echo $tenlop ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Khóa: </td>
                                        <td> 
                                            <select name="khoa" style="width: 120%;">
                                                <option style="text-align: center;"> <?php echo $khoa ?>
                                                    <?php
                                                        $r = mysqli_query($link,"SELECT *FROM lophoc");
                                                        while($row = mysqli_fetch_array($r)){ ?> 
                                                            <option> <?php echo $row['khoa']; ?> </option>  <?php  
                                                        }
                                                    ?>
                                                </option>
                                            </select>                                   
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cố vấn học tập: </td>
                                        <td>
                                            <select name="gv" style="width: 120%;">                                             
                                                <option style="text-align: center;"> <?php echo $covan ?>
                                                    <?php
                                                        $r = mysqli_query($link,"SELECT *FROM giangvien");
                                                        while($row = mysqli_fetch_array($r)){ ?> 
                                                            <option> <?php echo $row['hoten']; ?> </option>  <?php  
                                                        }
                                                    ?>
                                                </option>
                                            </select>   
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=2>
                                            <input id="btnChapNhan" type="submit" value="Cập nhật" name="sua">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <br><span style="color: black;">Chọn menu bên trái hoặc click vào </span> <a href="lop.php" style="color: blue; text-decoration: underline">đây</a>
                            <span style="color: black;">để quay lại danh sách lớp </span>
                            
                            <?php
                                if(isset($_POST['sua']))
                                {
                                    if(empty($_POST['malop']) or empty($_POST['tenlop']))
                                    {
                                        echo'</br> <p style="color:red; text-align: center;"> Vui lòng không để trống các trường! </p> </br>';
                                    }
                                    else{
                                        $malop1 = $_POST['malop'];
                                        $tenlop1 = $_POST['tenlop'];
                                        $khoa1 = $_POST['khoa'];
                                        $covan1 = $_POST['gv'];
                                        $query = "UPDATE lophoc SET malop='$malop1', tenlop='$tenlop1', khoa='$khoa1', covanhoctap='$covan1' WHERE lopID='$id'";
                                        mysqli_query($link, $query) or die ("Chỉnh sửa không thành công");
                                        ?>
                                            <script type="text/javascript">
                                                window.location = "lop.php";
                                            </script>
                                        <?php
                                        
                                    }
                                }
                            ?>
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

    </body>
</html>

<?php
    }
    else{
        header('location:../login.php');
    }
?>
                           

