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
    
    if(isset($_POST['reset_pass'])){
        $id = $_POST['edit_id'];
        $mssv = $_POST['mssv'];
        $hoten = $_POST['hoten'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $pass_new = $_POST['pass_new'];
        $md5 = md5($pass_new);
        $md5_pass = md5($pass);

        $lop = $_POST['lop'];

        if($pass != $md5){
            $query = "UPDATE sinhvien SET password='$md5' WHERE sinhvienID ='$id'";
            $query_run = mysqli_query($link, $query);

            if($query_run){
                $_SESSION['status'] = "Reset password thành công";
                $_SESSION['status_code'] = "success";
                header('Location: thongtin_user.php?id='.$lop.' ');
            }
            else{
                $_SESSION['username'] = "Chỉnh sửa không thành công";
                header('Location: thongtin_user.php?id='.$lop.' ');
            }
        }
        else{
            $_SESSION['status'] = "Không thể reset password";
            $_SESSION['status_code'] = "info";
            header('Location: thongtin_user.php?id='.$lop.' ');
        }
    }
?>