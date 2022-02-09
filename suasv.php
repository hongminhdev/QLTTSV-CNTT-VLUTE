<?php
    session_start();
    $link = new mysqli('localhost','root','','sinhvien') or die('failed');
    // $id = $_GET['id'];
    // $id1 = $_GET['id1'];

    if(isset($_POST['checking_edit_btn'])){
        $s_id = $_POST['sv_id'];
        $result_array = [];

        $que = "SELECT *FROM sinhvien WHERE sinhvienID='$s_id'";
        $que_run = mysqli_query($link, $que);

        if(mysqli_num_rows($que_run) > 0){
            foreach($que_run as $row)
            {
                array_push($result_array, $row);
                header('Content-type: application/json');
                echo json_encode($result_array);
            }
        }
        else{
            echo $return = "<h5> Not Found </h5>";
        }
    }
    
    if(isset($_POST['update_sv'])){
        $back = $_POST['sua_sv'];
        $id = $_POST['edit_id'];
        $hoten = $_POST['hoten'];
        $ns = $_POST['ngaysinh'];
        $sdt = $_POST['sdt'];
        $dc = $_POST['diachi'];
        $cn = $_POST['sua_chuyennganh'];

        if(count($_POST) > 0){
            $a = mysqli_query($link, "SELECT *FROM sinhvien WHERE lopID='$back' ");
            $b = mysqli_fetch_array($a);
            if($sdt == $b['sodt']){
                $_SESSION['status'] = "Số điện thoại đã tồn tại";
                $_SESSION['status_code'] = "warning";
                header('Location: sinhvien.php?id='.$back.' ');
            }
            else{
                $ht = trim($hoten);

                // function my_word_count($ht1, $myLangChars=“àáãâçêéíîóõôúÀÁÃÂÇÊÉÍÎÓÕÔÚ”) {
                //     return str_word_count($ht1, 0, $myLangChars);
                // }

                if(str_word_count($ht) > 1){
                    
                    $query = "UPDATE sinhvien SET id_cn='$cn', hoten='$hoten', ngaysinh='$ns', sodt='$sdt', diachi='$dc' WHERE sinhvienID='$id'";
                    $query_run = mysqli_query($link, $query);
        
                    if($query_run){
                        $_SESSION['status'] = "Chỉnh sửa thành công";
                        $_SESSION['status_code'] = "success";
                        header('Location: sinhvien.php?id='.$back.' ');
                    }
                    else{
                        $_SESSION['status'] = "Chỉnh sửa không thành công";
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
    }
?>