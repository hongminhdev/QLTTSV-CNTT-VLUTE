<?php
	session_start();
	$link = new mysqli('localhost','root','','sinhvien') or die('failed');
	// $id = $_GET['id'];
	// $id1 = $_GET['id1'];

	if(isset($_POST['delete_hp'])){
		$chuyennganh = $_POST['back1'];
		$id_mon = $_POST['hocphan_id'];

		$query = "DELETE FROM hocphan WHERE idmon='$id_mon'";
		$query_run = mysqli_query($link, $query);

		if($query_run){
			$_SESSION['status'] = "Xóa học phần thành công";
            $_SESSION['status_code'] = "success";
			header('Location: chuyennganh.php?id='.$chuyennganh.' ');
		}else{
			$_SESSION['status'] = "Xóa không thành công";
            $_SESSION['status_code'] = "error";
			header('Location: index.php');
		}
	}
?>

<!-- https://www.youtube.com/watch?v=4I5tctrbl84 -->



