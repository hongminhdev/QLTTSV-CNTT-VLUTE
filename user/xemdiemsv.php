<?php
	session_start();
	if (isset($_SESSION['email'])){
	$link = new mysqli('localhost','root','','sinhvien') or die('kết nối thất bại '); 
	mysqli_query($link, 'SET NAMES UTF8');
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
            <div class="main-container">
				<!-- <div id="main-contain"> -->
                    <?php
                        $tensv = '';
                        $id = $_GET['id'];
                        $cn = $_GET['id_cn'];
                        $null = $_SESSION['email'];
                        //$query = "SELECT * FROM sinhvien WHERE chuyennganh.id_cn=sinhvien.id_cn AND email = '$null' ";
                        $res = mysqli_query($link, "SELECT *FROM sinhvien WHERE sinhvienID=$id AND email = '$null'");
                        while($row = mysqli_fetch_array($res))
                        {
                            $tensv = $row['hoten'];
                        }
                    ?>
                     <div id="menu">
                        <ol style="font-size: 20px; margin-left: -2px;" class="breadcrumb"> Bảng Điểm Của Sinh Viên <?php echo $tensv ?>
                            <!-- <li style="margin-top: -3px;"> <a href="index.php" ><i class="fa fa-home"></i> Trang chính </a> </li>  -->
                            <!-- <span style="font-size: 11px; margin-top: 8px;"> > </span> -->
                            <!-- <li style="margin-top: -3px;"> <a href="dsdiem.php"><i class="fa fa-users"></i> Danh sách lớp </a> </li> -->
                            &nbsp; &nbsp; <span style="font-size: 11px; margin-top: 8px;">  </span> &nbsp;  
                            <li style="margin-top: -3px;"> <a href=""><i class="fa fa-user"></i> Danh sách sinh viên <?php  ?></a> </li>
                            &nbsp; &nbsp; <span style="font-size: 11px; margin-top: 8px;"> > </span> &nbsp;  &nbsp;
                            <li style="margin-top: -3px;"> <a href="xemdiemsv.php?id=<?php echo $id ?>&id_cn=<?php echo $cn ?>"><i class="fa fa-user"></i> Bảng điểm cá nhân <?php  ?></a> </li>
                        </ol>
                    </div>
                    
					<!-- <h3>  </h3> -->
						<div id="listSV">
							<table width = "70%">
								<tr>
									<th> STT </th>
                                    <th style="display: none"> #ID </th>
									<th> Mã học phần </th>
									<th> Tên học phần </th>
									<th> Số tín chỉ </th>
                                    <th> Quá trình </th>  
                                    <th> Giữa kỳ </th>   
                                    <th> Điểm thi </th>
                                    <th> Điểm HP </th>
                                    <th> Điểm chữ </th>
                                    <th> Hệ 4 </th>
									<!-- <th> Chỉnh sửa</th> -->
									<!-- <th> Xóa </th> -->
								</tr>

                                <?php
                                    $d = 0;
                                    $kq1 = mysqli_query($link, "SELECT *FROM hocphan WHERE id_cn=$cn");
                                    // $kq2 = mysqli_query($link, "SELECT *FROM diemthi");
                                    // $run = mysqli_fetch_array($kq2);
                                    
                                    while($r = mysqli_fetch_assoc($kq1)){
                                        $d = $d + 1;
                                        $mon = $r['idmon'];
                                        ?>
                                            <tr>
                                                <td scope="row"><?php echo $d ?></td>
                                                <td class="diemthi_id" style="display: none">
                                                    <?php $id_diem = mysqli_query($link, "SELECT *FROM diemthi WHERE MaSV='$id' AND idmon='$mon'");
                                                        while($run = mysqli_fetch_assoc($id_diem)){
                                                            ?>
                                                                <span><?php echo $run['diemthiID'] ?></span>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $r['mahp'] ?></td>
                                                <td><?php echo $r['tenhp'] ?></td>
                                                <td><?php echo $r['sotc'] ?></td>
                                                <td>
                                                    <?php $qt= mysqli_query($link, "SELECT quatrinh FROM diemthi WHERE MaSV='$id' AND idmon='$mon'");
                                                        while($r1 = mysqli_fetch_assoc($qt)){
                                                            ?>
                                                                <span><?php echo $r1['quatrinh'] ?></span>
                                                            <?php
                                                        } ?>
                                                </td>
                                                <td>
                                                    <?php $gk= mysqli_query($link, "SELECT giuaky FROM diemthi WHERE MaSV='$id' AND idmon='$mon'");
                                                        while($r2 = mysqli_fetch_assoc($gk)){
                                                            ?>
                                                                <span><?php echo $r2['giuaky'] ?></span>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php $ck= mysqli_query($link, "SELECT cuoiky FROM diemthi WHERE MaSV='$id' AND idmon='$mon'");
                                                        while($r3 = mysqli_fetch_assoc($ck)){
                                                            ?>
                                                                <span><?php echo $r3['cuoiky'] ?></span>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php $dhp= mysqli_query($link, "SELECT diem_hp FROM diemthi WHERE MaSV='$id' AND idmon='$mon'");
                                                        while($r4 = mysqli_fetch_assoc($dhp)){
                                                            ?>
                                                                <span><?php echo $r4['diem_hp'] ?></span>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php $dc= mysqli_query($link, "SELECT diemchu FROM diemthi WHERE MaSV='$id' AND idmon='$mon'");
                                                        while($r5 = mysqli_fetch_assoc($dc)){
                                                            ?>
                                                                <span><?php echo $r5['diemchu'] ?></span>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php $hb= mysqli_query($link, "SELECT he4 FROM diemthi WHERE MaSV='$id' AND idmon='$mon'");
                                                        while($r6 = mysqli_fetch_assoc($hb)){
                                                            ?>
                                                                <span><?php echo $r6['he4'] ?></span>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <!-- <td>  
                                                    <a class="edit_btn">
                                                        <i style="color: #0066CC; margin-left: 0%;" class="fa fa-edit"></i>
                                                    </a>
                                                </td> -->
                                            </tr>
                                        <?php
                                    }
                                ?>
							</table>
						</div>
                        <!--  -->
						<!-- <form method="POST" enctype="multipart/form-data" id="formChucnang">
                            <input type="file" name="file" id="btnThemSV" value="THEM HOC PHAN" required> <br>
                            <button type="submit" name="btnGui" style="padding: 8px; font-size: 14px;">THÊM ĐIỂM HỌC PHẦN</button>
                        </form> -->
				<!-- </div> -->
            </div> 
            <!--main container end-->
        </div>
        <!--wrapper end-->

        <!-- Modal Update -->
        <div class="modal fade" id="editDiemModal" tabindex="-1" role="dialog" aria-labelledby="editDiemModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDiemModalLabel">Chỉnh sửa điểm học phần</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="suadiem.php" method="POST">
                        <div class="modal-body">
                            <input type="type" name="edit_id" id="edit_id">
                            <div class="form-group">
                                <label for="">Mã học phần</label>
                                <input type="text" name="mahp" id="edit_mahp" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Tên học phần</label>
                                <input type="text" name="tenhp" id="edit_tenhp" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Điểm quá trình</label>
                                <input type="text" name="diemqt" id="edit_diemqt" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Điểm giữa kỳ</label>
                                <input type="text" name="diemgk" id="edit_diemgk" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Điểm thi</label>
                                <input type="text" name="diemthi" id="edit_diemthi" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Điểm học phần</label>
                                <input type="text" name="diemhp" id="edit_diemhp" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Điểm chữ</label>
                                <!-- <input type="text" name="khoa" id="edit_khoa" class="form-control">  -->
                                <select name="diem_chu" id="edit_diemchu" class="form-control"> 
                                    <option> A </option>
                                    <option> B+ </option>
                                    <option> B </option>
                                    <option> C+ </option>
                                    <option> C </option>
                                    <option> D+ </option>
                                    <option> D </option>
                                    <option> F </option>
                                </select>  
                            </div>
                            <div class="form-group">
                                <label for="">Hệ 4</label>
                                <!-- <input type="text" name="cvht" id="edit_cvht" class="form-control"> -->
                                <select name="hebon" id="edit_hebon" class="form-control">                                             
                                    <option> 4.0 </option>
                                    <option> 3.5 </option>
                                    <option> 3.0 </option>
                                    <option> 2.5 </option>
                                    <option> 2.0 </option>
                                    <option> 1.5 </option>
                                    <option> 1.0 </option>
                                    <option> 0.0 </option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Đóng </button>
                            <button type="submit" name="update_diem" class="btn btn-primary"> Cập nhật </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('.edit_btn').click(function (e) {
                    e.preventDefault();

                    var diemthi_id = $(this).closest('tr').find('.diemthi_id').text();
                        // console.log(mon_id);

                    $.ajax({
                        type: "POST",
                        url: "suadiem.php",
                        data: {
                            'checking_edit_btn': true,
                            'diemthi_id': diemthi_id,
                        },
                        success: function (response){
                            // console.log(response);
                            $.each(response, function (key, value) { 
                                    //  console.log(value['fname']);
                                $('#edit_id').val(value['diemthiID']);
                                $('#edit_mahp').val(value['mahp']);
                                $('#edit_tenhp').val(value['tenhp']);
                                $('#edit_diemqt').val(value['quatrinh']);
                                $('#edit_diemgk').val(value['giuaky']);
                                $('#edit_diemthi').val(value['cuoiky']);
                                $('#edit_diemhp').val(value['diem_hp']);
                                $('#edit_diemchu').val(value['diemchu']);
                                $('#edit_hebon').val(value['he4']);
                            });
                            $('#editDiemModal').modal('show');
                        }
                    });
                });
            });
        </script>
<?php
	}
	else {
		header('location: user_login.php');
	}
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    
    </body>
</html>