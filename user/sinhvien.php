<?php
   include '../connect/connect.php';
   session_start();
   if(isset($_SESSION['email'])){
?>

<?php
    error_reporting(0);
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Student Information Manager</title>
        <link rel="shortcut icon" href="../image/vlute.ico">
        <link rel="stylesheet" href="../style/style1.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
        <script src="vendors/js/sweetalert.min.js"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
        <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">

        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="../vendors/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../assets/js/main.js"></script>
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
                        <ol style="font-size: 20px; margin-left: -2px;" class="breadcrumb"> DANH SÁCH SINH VIÊN LỚP <?php echo $malop ?>
                            <li style="margin-top: -3px;"> <a href="index.php" ><i class="fa fa-home"></i> Trang chính </a> </li> 
                            <span style="font-size: 11px; margin-top: 8px;"> > </span> &nbsp;  &nbsp; &nbsp; 
                            <li style="margin-top: -3px;"> <a href="dssv.php"><i class="fa fa-users"></i> Danh sách sinh viên</a> </li>
                            &nbsp; &nbsp; <span style="font-size: 11px; margin-top: 8px;"> > </span> &nbsp;  &nbsp; &nbsp;
                            <li style="margin-top: -3px;"> <a href="sinhvien.php?id=<?php echo $idlop?>"><i class="fa fa-user"></i> Sinh viên <?php echo $malop ?></a> </li>
                        </ol>
                    </div>
                         
					<!-- <h2 style="text-align: center;">  </h2> -->
                        <form action="export.php" method="POST" >
                            <input type="hidden" value="<?php echo $idlop ?>" name="xuat">
                            <button class="export fa fa fa-user" type="submit" name="btnExport" id="xuatfile"> Tìm kiếm </button>
                            
                        </form>
                        <form method="post" id="f_search"> <input type="txtSearch" type="search" name="search" style="padding: 5px; width: 300px;" placeholder = "Nhập tên hoặc MSSV">
                                <input id="btnSearch" type="submit" name="timkiem" value="" require>
                        </form>
                        <div id="listSV">
							<!-- <form method="post" id="f_search"> <input type="txtSearch" type="search" name="search" required style="padding: 5px; width: 300px;" placeholder = "Nhập tên hoặc MSSV">
                                <input id="btnSearch" type="submit" name="timkiem" value="" require>
                            </form> -->
							<table width = "70%">
								<tr>
                                    <th> STT </th>
                                    <th style="display: none;"> #ID </th>
                                    <th> Họ tên </th>
                                    <th> Mã sinh viên </th>
                                    <th style="display: none;"> Ngày sinh </th>
                                    <th style="display: none;"> Giới tính </th>
                                    <th style="display: none;"> Số điện thoại </th>
                                    <th style="display: none;"> Địa chỉ </th>
                                    <th > Chuyên ngành </th>
                                    <!-- <th> Email </th> -->
                                    <th> Thông tin </th>
                                    <!-- <th> Chỉnh sửa </th>
                                    <th> Xóa </th> -->
                                </tr>
                                
                                <?php
                                    if (isset($_POST['timkiem'])){
                                        $giatri = $_POST['search'];
                                        // echo $giatri;
                                        if (empty($giatri))
                                        {
                                            ?>
                                                <!-- <script type="text/javascript">
                                                    alert('Không có tìm thấy kết quả');
                                                </script> -->
                                            <?php
                                            $query = "SELECT * FROM sinhvien WHERE sinhvien.lopID = '".$_GET['id']."' ORDER BY MaSV ASC";                                            
                                        }
                                        else
                                        {
                                            $query = "SELECT * FROM sinhvien WHERE sinhvien.lopID = '".$_GET['id']."' and hoten LIKE '%$giatri%' or sinhvien.lopID = '".$_GET['id']."' and sinhvien.MaSV LIKE '%$giatri%' ";
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
                                            $ma_cn = $row['id_cn'];
                                            ?>
                                                <tr>
                                                    <td scope="row"> <?php echo $dem ?> </td>
                                                    <td class="sv_id" style="display: none;"><?php echo $row['sinhvienID'] ?></td>
                                                    <td><?php echo $row['hoten'] ?></td>
                                                    <td><?php echo $row['MaSV'] ?></td>
                                                    <td style="display: none;"><?php echo $row['ngaysinh'] ?></td>
                                                    <td style="display: none;"><?php echo $row['gioitinh'] ?></td>
                                                    <td style="display: none;"><?php echo $row['sodt'] ?></td>
                                                    <td style="display: none;"><?php echo $row['diachi'] ?></td>
                                                    
                                                    <td>
                                                        <?php
                                                            $chuyennganh = mysqli_query($link, "SELECT *FROM chuyennganh WHERE id_cn='$ma_cn'");
                                                            while($row1 = mysqli_fetch_array($chuyennganh)){?>
                                                                    <span><?php echo $row1['tencn'] ?></span>
                                                                <?php
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><a href="thongtin_sv.php?id=<?php echo $row['sinhvienID'] ?>"><i style="color: #0066CC; margin-left: 0%;" class="fas fa-eye"></i></a></td>
                                                    
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
							    <p style="color: black; text-align:center;"><b> SỈ SỐ: <?php echo $dem;?> </b></p>
						</div>
                        <!-- <form method="POST" enctype="multipart/form-data" id="formChucnang">
                            <input type="file" name="file" id="btnThemSV" value="THEM HOC PHAN" required> <br>
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

        <!-- Modal Add Students -->
        

    <?php
        }
        else {
            header('location: user_login.php');
        }
    ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="3a7a5c16bb3520291edcacfb-|49" defer=""></script>

        <script>
                $(document).ready(function () {
                    $('.delete_btn').click(function (e) {
                        e.preventDefault();

                        var sv_id = $(this).closest('tr').find('.sv_id').text();
                        console.log(sv_id);
                        $('#delete_id').val(sv_id);
                        $('#deleteStudentModal').modal('show');
                    });

                    $('.edit_btn').click(function (e) {
                        e.preventDefault();

                        var sv_id = $(this).closest('tr').find('.sv_id').text();
                        // console.log(mon_id);

                        $.ajax({
                            type: "POST",
                            url: "suasv.php",
                            data: {
                                'checking_edit_btn': true,
                                'sv_id': sv_id,
                            },
                            success: function (response){
                                // console.log(response);
                                $.each(response, function (key, value) { 
                                    //  console.log(value['fname']);
                                    $('#edit_id').val(value['sinhvienID']);
                                    $('#edit_mssv').val(value['MaSV']);
                                    $('#edit_hoten').val(value['hoten']);
                                    $('#edit_ns').val(value['ngaysinh']);
                                    $('#edit_sdt').val(value['sodt']);
                                    $('#edit_dc').val(value['diachi']);
                                    $('#edit_cn').val(value['tencn']);
                                });
                                $('#editStudentModal').modal('show');
                            }
                        });
                    });
                });
        </script>

        <script type="3a7a5c16bb3520291edcacfb-text/javascript">
            /* code from qodo.co.uk */
            // create as many regular expressions here as you need:
            var digitsOnly = /[1234567890]/g;
            var integerOnly = /[0-9\.]/g;
            var alphaOnly = /[A-Z Đ á à ả ã ạ ă ặ ắ ằ â ậ ấ ầ ẩ ẫ đ ẻ ẽ é è ẹ ệ ế ề ể ễ ọ ỏ õ ó ò ộ ô ố ồ ổ ỗ ơ ớ ờ ở ỡ ị í ì ỉ ĩ ụ ủ ũ ú ù ự ứ ừ ử ữ ỵ ỷ ỹ ý ỳ ướ a-z]/g;

            function restrictCharacters(myfield, e, restrictionType) {
                if (!e) var e = window.event
                if (e.keyCode) code = e.keyCode;
                else if (e.which) code = e.which;
                var character = String.fromCharCode(code);

                // if they pressed esc... remove focus from field...
                if (code==27) { this.blur(); return false; }
                
                // ignore if they are press other keys
                // strange because code: 39 is the down key AND ' key...
                // and DEL also equals .
                if (!e.ctrlKey && code!=9 && code!=8 && code!=36 && code!=37 && code!=38 && (code!=39 || (code==39 && character=="'")) && code!=40) {
                    if (character.match(restrictionType)) {
                        return true;
                    } else {
                        return false;
                    }
                    
                }
            }
        </script>
        
    </body>
</html>