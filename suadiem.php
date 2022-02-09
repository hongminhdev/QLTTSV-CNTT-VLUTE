<?php
    $link = new mysqli('localhost','root','','sinhvien') or die('failed');
    

    // if(isset($_POST['checking_edit_btn'])){
    //     $s_id = $_POST['diemthi_id'];
    //     $result_array = [];

    //     $que = "SELECT *FROM diemthi WHERE diemthiID='$s_id'";
    //     $que_run = mysqli_query($link, $que);

    //     if(mysqli_num_rows($que_run) > 0){
    //         foreach($que_run as $row)
    //         {
    //             array_push($result_array, $row);
    //             header('Content-type: application/json');
    //             echo json_encode($result_array);
    //         }
    //     }
    //     else{
    //         echo $return = "<h5> Not Found </h5>";
    //     }
    // }
    
    if(isset($_POST['update_diem'])){
        $id = $_POST['edit_id'];
        $qt = $_POST['diemqt'];
        $gk = $_POST['diemgk'];
        $ck = $_POST['diemthi'];
        $dhp = $_POST['diemhp'];
        $dc = $_POST['diem_chu'];
        $hb = $_POST['hebon'];

        $query = "UPDATE diemthi SET quatrinh='$qt', giuaky='$gk', cuoiky='$ck', diem_hp='$dhp', diemchu='$dc', he4='$hb' WHERE diemthiID='$id'";
        $query_run = mysqli_query($link, $query);

        if($query_run){
            $_SESSION['username'] = "Chỉnh sửa thành công";
			header('Location: dsdiem.php ');
        }
        else{
            $_SESSION['username'] = "Chỉnh sửa không thành công";
			header('Location: index.php ');
        }
    }
?>