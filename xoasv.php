<?php
	session_start();
	$link = new mysqli('localhost','root','','sinhvien') or die('failed');
	// $id = $_GET['id'];
	// $id1 = $_GET['id1'];

	if(isset($_POST['delete_sinhvien'])){
		$back = $_POST['xoa_sv'];
		$id_sv = $_POST['sinhvien_id'];

		$query = "DELETE FROM sinhvien WHERE sinhvienID='$id_sv'";
		$query_run = mysqli_query($link, $query);

		if($query_run){
			$_SESSION['status'] = "Xóa sinh viên thành công";
			$_SESSION['status_code'] = "success";
			header('Location: sinhvien.php?id='.$back.' ');
		}else{
			$_SESSION['status'] = "Xóa không thành công";
			$_SESSION['status_code'] = "error";
			header('Location: index.php');
		}
	}
?>



	
	<!-- $link = new mysqli('localhost','root','','sinhvien') or die('kết nối thất bại '); 
	// mysqli_query($link, 'SET NAMES UTF8');   
    $id = $_GET['id'];
    $id1 = $_GET['id1'];
    mysqli_query($link, "DELETE FROM sinhvien WHERE sinhvienID=$id");


<script type="text/javascript"> 
    window.location = "sinhvien.php?id= echo $id1; ?>";
</script> -->

