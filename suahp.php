<?php
session_start();
    $link = new mysqli('localhost','root','','sinhvien') or die('failed');
    // $id = $_GET['id'];
    // $chuyennganh = $_POST['back'];

    if(isset($_POST['checking_edit_btn'])){
        $s_id = $_POST['mon_id'];
        $result_array = [];

        $que = "SELECT *FROM hocphan WHERE idmon='$s_id'";
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
    
    if(isset($_POST['update_hp'])){
        $chuyennganh = $_POST['back'];
        $id = $_POST['edit_id'];
        $tenhp = $_POST['tenhp'];
        $sotc = $_POST['sotc'];
        $tclt = $_POST['tclt'];
        $tcth = $_POST['tcth'];
        $ghichu = $_POST['gc'];

        $sum = $tclt + $tcth;
        if($sum != $sotc){
            $_SESSION['status'] = "Chỉnh sửa không thành công";
            $_SESSION['status_code'] = "error";
            header('Location: chuyennganh.php?id='.$chuyennganh.' ');
        }
        else{
            $check = trim($tenhp);
            
            // function my_word_count($check, $myLangChars=“àáãâçêéíîóõôúÀÁÃÂÇÊÉÍÎÓÕÔÚ”) {
            //     return str_word_count($check, 1, $myLangChars);
            // }


            if(str_word_count($check) > 1)
            {
                
                $query = "UPDATE hocphan SET tenhp='$tenhp', sotc='$sotc', tclt='$tclt', tcth='$tcth', ghichu='$ghichu' WHERE idmon='$id'";
                $query_run = mysqli_query($link, $query);

                if($query_run){
                    $_SESSION['status'] = "Chỉnh sửa thành công";
                    $_SESSION['status_code'] = "success";
                    header('Location: chuyennganh.php?id='.$chuyennganh.' ');
                }
                else{
                    $_SESSION['status'] = "Chỉnh sửa không thành công";
                    $_SESSION['status_code'] = "error";
                    header('Location: daotao.php ');
                }
            }
            else{
                $_SESSION['status'] = "Tên học phần phải có 2 từ trở lên";
                $_SESSION['status_code'] = "warning";
                header('Location: chuyennganh.php?id='.$chuyennganh.' ');
            }
        }
        
    }
?>