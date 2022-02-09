<?php
   include 'connect/connect.php';
   session_start();
   if(isset($_SESSION['username'])){
?>

<?php
    error_reporting(0);
?>

<?php
    require ('Classes/PHPExcel.php');
    if (isset($_POST['btnGui'])){
        $file = $_FILES['file']['tmp_name'];
        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
        $objReader->setLoadSheetsOnly('Sheet1'); 
    
        $objExcel = $objReader->load($file);
        $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);

        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
        for($row = 2; $row <= $highestRow; $row++){
            $masv = $sheetData[$row]['A'];
            $idlop = $sheetData[$row]['B'];
            $hoten = $sheetData[$row]['C'];
            $ngaysinh = $sheetData[$row]['D'];
            $gt = $sheetData[$row]['E'];
            $sdt = $sheetData[$row]['F'];
            $dc = $sheetData[$row]['G'];
            $cn = $sheetData[$row]['H'];
            $email = $sheetData[$row]['I'];
    
            $sql = "INSERT INTO sinhvien(MaSV,lopID,hoten,ngaysinh,gioitinh,sodt,diachi,chuyennganh,email) VALUES ('$masv','$idlop',$hoten,$ngaysinh,$gt,'$sdt',$dc,$cn,$email)";
            $link->query($sql);
        }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Student Information Manager</title>
        <link rel="shortcut icon" href="image/vlute.ico">
        <link rel="stylesheet" href="style/style1.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
        <script src="vendors/js/sweetalert.min.js"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
 

    </head>
    <body>

        <!--wrapper start-->
        <div class="wrapper">
            <?php include 'header.php' ?>
            <?php
                if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
                    ?>
                    <script>
                        swal({
                        title: "<?php echo $_SESSION['status']; ?>",
                        // text: "You clicked the button!",
                        icon: "<?php echo $_SESSION['status_code']; ?>",
                        button: "Xác nhận",
                        });
                    </script>
                    <?php
                    unset($_SESSION['status']);
                }
            ?>
            <div class="main-container">
				<!-- <div id="main-contain"> -->
                    <?php
                        $malop = '';
                        $idlop = $_GET['id'];
                        $res = mysqli_query($link, "SELECT *FROM lophoc WHERE lopID=$idlop");
                        while($row = mysqli_fetch_array($res))
                        {
                            $malop = $row['malop'];
                        }
                    ?>   
                    <div id="menu">
                        <ol style="font-size: 20px; margin-left: -2px;" class="breadcrumb"> DANH SÁCH USER LỚP <?php echo $malop ?>
                        <!-- &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; 
                        &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; 
                        &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  -->
                            <!-- <li> -->
                                <li style="margin-top: -3px;"> <a href="index.php" ><i class="fa fa-home"></i> Trang chính </a> </li> 
                                <span style="font-size: 11px; margin-top: 8px;"> > </span> &nbsp;  &nbsp; &nbsp; 
                                <li style="margin-top: -3px;"> <a href="danhsach_user.php"><i class="fa fa-users"></i> Danh sách user</a> </li>
                            <!-- </li> -->
                        </ol>
                    </div>  
					<!-- <h2 style="text-align: center;">  </h2> -->
                        <form method="post" id="f1_search" > <input type="txtSearch" type="search" name="search" style="padding: 5px; width: 300px; margin-top: 30px;" placeholder = "Nhập tên hoặc MSSV">
                                <input id="btnSearch" type="submit" name="timkiem" value="" style="margin-top: 30px;">
                        </form>
                        <div id="listSV" style="margin-top: 50px;">
							
							<table width = "70%">
								<tr>
                                    <th> STT </th>
                                    <th style="display: none;"> #ID </th>
                                    <th> Họ tên </th>
                                    <th> Mã số sinh viên</th>
                                    <th> Email </th>
                                    <th> Password </th>
                                    <th> Reset password </th>
                                    <!-- <th> Xóa </th> -->
                                </tr>
                                
                                <?php
                                    if (isset($_POST['timkiem'])){
                                        $giatri = $_POST['search'];
                                        // echo $giatri;
                                        if (empty($giatri))
                                        {
                                            ?>
                                                <script>
                                                    swal({
                                                    title: "Không tìm thấy kết quả",
                                                    text: "Vui lòng thử lại",
                                                    icon: "info",
                                                    button: "OK",
                                                    });
                                                </script>
                                            <?php
                                            $query = "SELECT * FROM sinhvien WHERE sinhvien.lopID = '".$_GET['id']."' ORDER BY MaSV ASC";                                            
                                        }
                                        else
                                        {
                                            $query = "SELECT * FROM sinhvien WHERE sinhvien.lopID = '".$_GET['id']."' and hoten LIKE '%$giatri%' or sinhvien.lopID = '".$_GET['id']."' and sinhvien.MaSV = '$giatri' ";
                                        }
                                    }
                                    else
                                    {
                                        $query = "SELECT * FROM sinhvien WHERE sinhvien.lopID = '".$_GET['id']."' ORDER BY MaSV ASC";
                                    }
                                    $kq = mysqli_query($link, $query);
                                    $dem = 0;
                                    if(mysqli_num_rows($kq) > 0)
                                    {                                      
                                        while($row = mysqli_fetch_assoc($kq))
                                        {
                                            $dem ++;
                                            ?>
                                                <tr>
                                                    <td scope="row"> <?php echo $dem ?> </td>
                                                    <td class="sv_id" style="display: none;"><?php echo $row['sinhvienID'] ?></td>
                                                    <td><?php echo $row['hoten'] ?></td>
                                                    <td><?php echo $row['MaSV'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['password']?></td>
                                                    <td>
                                                        <a href="" class="edit_btn">
                                                            <i style="color: #0066CC;" class="fa fa-refresh"></i>
                                                        </a>
                                                    </td>
                                                    <!-- <td><a href="xoasv.php?id= echo $row['sinhvienID']; ?>&id1= echo $idlop; ?>"><i style="color: #0066CC; margin-left: 20%;" class="fas fa-trash"></i></a></td> -->
                                                </tr>
                                            <?php
                                            
                                        }
                                    }
                                    else{
                                        echo '<tr > <td colspan="12" align = "center"> Không có dữ liệu </td></tr>';
                                        // echo '<script> alert("Ko") </script>';
                                    }
                                ?>

							</table>
                            <br>
							    <!-- <p style="color: black; text-align:center;"><b> SĨ SỐ: <?php echo $dem;?> </b></p> -->
						</div>
                        <!-- <form method="POST" enctype="multipart/form-data" id="formChucnang">
                            <input type="file" name="file" id="btnThemSV" value="THEM HOC PHAN"> <br>
                            <button type="submit" name="btnGui" style="padding: 8px; font-size: 14px;">THÊM SINH VIÊN</button>
                        </form> -->
					<!-- <form id="formChucnang">
						<a href="chucnang/themlop.php" ><input  id="btnThemSV" type="button" value="THÊM LỚP"> </a>
					</form> -->
		      <!-- </div> -->
            </div>
            <!--main container end-->
        </div>
        <!--wrapper end-->

        <!-- Modal Reset Password -->
        <div class="modal fade" id="editPassModal" tabindex="-1" role="dialog" aria-labelledby="editPassModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPassModalLabel">Reset password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="reset_pass.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="lop" value="<?php echo $idlop ?>">
                            <input type="hidden" name="edit_id" id="edit_id">
                            <div class="form-group">
                                <label for="">Mã số sinh viên</label>
                                <input type="text" name="mssv" id="edit_mssv" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Họ tên sinh viên</label>
                                <input type="text" name="hoten" id="edit_hoten" class="form-control" disabled> 
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" id="edit_email" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for=""></label>
                                <input type="hidden" name="pass" id="edit_pass" class="form-control" >
                                <input type="hidden" name="pass_new" value="1" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close </button>
                            <button type="submit" name="reset_pass" class="btn btn-primary"> Reset </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php
	}
	else {
		header('location:login.php');
	}
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function () {
            $('.edit_btn').click(function (e) {
                e.preventDefault();

                var sv_id = $(this).closest('tr').find('.sv_id').text();
                // console.log(mon_id);

                $.ajax({
                    type: "POST",
                    url: "reset_pass.php",
                    data: {
                    'checking_edit_btn': true,
                    'sv_id': sv_id,
                    },
                    success: function (response){
                        $.each(response, function (key, value) {
                        //  console.log(value['fname']);
                            $('#edit_id').val(value['sinhvienID']);
                            $('#edit_mssv').val(value['MaSV']);
                            $('#edit_hoten').val(value['hoten']);
                            $('#edit_email').val(value['email']);
                            $('#edit_pass').val(value['password']);
                        });
                        $('#editPassModal').modal('show');
                    }
                });
            });
        });
    </script>

    

    </body>
</html>