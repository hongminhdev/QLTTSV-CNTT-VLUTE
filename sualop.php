<?php
    session_start();
    $link = new mysqli('localhost','root','','sinhvien') or die('failed');
    // $id = $_GET['id'];
    // $id1 = $_GET['id1'];

    if(isset($_POST['checking_edit_btn'])){
        $s_id = $_POST['lop_id'];
        $result_array = [];

        $que = "SELECT *FROM lophoc WHERE lopID='$s_id'";
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
    
    if(isset($_POST['update_lop'])){
        $id = $_POST['edit_id'];
        $tenlop = $_POST['tenlop'];
        $khoa = $_POST['khoa'];
        $cvht = $_POST['cvht'];

        $check = trim($tenlop);

        if(str_word_count($check) > 1){
            $query = "UPDATE lophoc SET tenlop='$tenlop', khoa='$khoa', covanhoctap='$cvht' WHERE lopID='$id'";
            $query_run = mysqli_query($link, $query);

            if($query_run){
                $_SESSION['status'] = "Chỉnh sửa thành công";
                $_SESSION['status_code'] = "success";   
                header('Location: lop.php ');
            }
            else{
                $_SESSION['status'] = "Chỉnh sửa không thành công";
                $_SESSION['status_code'] = "error";
                header('Location: lop.php ');
            }
        }
        else{
            $_SESSION['status'] = "Tên lớp phải có 2 từ trở lên";
            $_SESSION['status_code'] = "info";
            header('Location: lop.php ');
        }
    }
?>
