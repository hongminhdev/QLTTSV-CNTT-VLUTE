<?php
	session_start();
	$link = new mysqli('localhost','root','','sinhvien') or die('failed');

	if(isset($_POST['delete_lop'])){
		$id_lop = $_POST['lop_id'];

		$query = "DELETE FROM lophoc WHERE lopID='$id_lop'";
		$query_run = mysqli_query($link, $query);

		if($query_run){
			$_SESSION['status'] = "Xóa lớp thành công";
			$_SESSION['status_code'] = "success";
			header('Location: lop.php ');
		}else{
			$_SESSION['status'] = "Xóa lớp không thành công";
			$_SESSION['status_code'] = "error";
			header('Location: index.php');
		}
	}
?>


	<!-- $link = new mysqli('localhost','root','','sinhvien') or die('failed');
	$id = $_GET['id'];
	$query = "DELETE FROM lophoc WHERE lopID=$id";
	mysqli_query($link, $query);
	


<script type="text/javascript">
    window.location = "lop.php";
</script> -->

