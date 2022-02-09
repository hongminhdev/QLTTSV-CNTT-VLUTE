<?php
    session_start();
    $link = new mysqli('localhost','root','','sinhvien') or die('failed');

    if(isset($_POST['add_lop'])){
        $malop = $_POST['them_malop'];
        $tenlop = $_POST['them_tenlop'];
        $khoa = $_POST['them_khoa'];
        $cvht = $_POST['them_cvht'];

        $query = "INSERT INTO lophoc(malop,tenlop,khoa,covanhoctap) VALUES ('$malop','$tenlop','$khoa','$cvht')";
        $query_run = mysqli_query($link, $query);

        if($query_run){
            $_SESSION['status'] = "Thêm lớp thành công";
			$_SESSION['status_code'] = "success";
            header('Location: lop.php ');
        }
        else{
            $_SESSION['status'] = "Thêm lớp không thành công";
			$_SESSION['status_code'] = "error";
            header('Location: lop.php ');
        }
    }
?>