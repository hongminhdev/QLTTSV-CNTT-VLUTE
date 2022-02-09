<?php
    session_start();
    $link = new mysqli('localhost','root','','sinhvien') or die('failed');

    if(isset($_POST['add_sinhvien'])){
        $mssv = $_POST['them_mssv'];
        $malop = $_POST['them_ml'];
        $id_cn = $_POST['them_macn'];
         
        $hoten = $_POST['them_ht'];
        $ns = $_POST['them_ns'];
        $gt = $_POST['them_gt'];
        $sdt = $_POST['them_sdt'];
        $dc = $_POST['them_dc'];
        $cn = $_POST['them_cn'];
        $email = $_POST['them_email'];
        $pass = $_POST['them_pass'];
        $md5 = md5($pass);

        $back = $_POST['them_sv'];

        if(count($_POST) > 0){
            $a = mysqli_query($link, "SELECT *FROM sinhvien WHERE lopID='$back' ");
            $b = mysqli_fetch_array($a);
            if($sdt == $b['sodt'] && $email == $b['email']){
                $_SESSION['status'] = "Email và số điện thoại đã tồn tại";
                $_SESSION['status_code'] = "warning";
                header('Location: sinhvien.php?id='.$back.' ');
            }
            else if($sdt == $b['sodt']){
                $_SESSION['status'] = "Số điện thoại đã tồn tại";
                $_SESSION['status_code'] = "warning";
                header('Location: sinhvien.php?id='.$back.' ');
            }
            else if($email == $b['email']){
                $_SESSION['status'] = "Email đã tồn tại";
                $_SESSION['status_code'] = "warning";
                header('Location: sinhvien.php?id='.$back.' ');
            }
            else{
                $ht = trim($hoten);

                // function my_word_count($hoten, $myLangChars=“àáãâçêéíîóõôúÀÁÃÂÇÊÉÍÎÓÕÔÚ”) {
                //     return str_word_count($hoten, 0, $myLangChars);
                // }

                if( str_word_count(trim($ht)) > 1 ){

                    $query = "INSERT INTO sinhvien(MaSV,lopID,id_cn,hoten,ngaysinh,gioitinh,sodt,diachi,email,password) VALUES ('$mssv','$malop','$id_cn','$hoten','$ns','$gt','$sdt','$dc','$email','$md5')";
                    $query_run = mysqli_query($link, $query);

                    if($query_run){ 
                        $_SESSION['status'] = "Thêm sinh viên thành công";
                        $_SESSION['status_code'] = "success";
                        header('Location: sinhvien.php?id='.$back.' ');
                    }
                    else{
                        $_SESSION['status'] = "Thêm sinh viên không thành công";
                        $_SESSION['status_code'] = "error";
                        header('Location: sinhvien.php?id='.$back.' ');
                    }
                }
                else{
                    $_SESSION['status'] = "Họ tên phải có 2 từ trở lên";
                    $_SESSION['status_code'] = "info";
                    header('Location: sinhvien.php?id='.$back.' ');
                }
            }
        }

        
        // $run = mysqli_query("SELECT sodt FROM sinhvien");
        // while($row = mysqli_fetch_assoc($run)){
        //     if($sdt == $row['sodt']){
        //         $_SESSION['status'] = "Thêm không thành công";
        //         $_SESSION['status_code'] = "error";
        //         header('Location: sinhvien.php?id='.$back.' ');
        //     }
        // }

        
    }
?>