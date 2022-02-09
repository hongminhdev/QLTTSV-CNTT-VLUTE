<?php
    session_start();
    
    if (isset($_SESSION['email'])){
    $link = new mysqli('localhost','root','','sinhvien') or die('kết nối thất bại '); 
    mysqli_query($link, 'SET NAMES UTF8');
    
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

        <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="vendors/bootstrap/dist/js/bootstrap.min.js">
        <!-- <style>
            .footer {
                position: relative;
                display: block;
                left: 0;
                bottom: 0;
                width: 100%;
                height: 85px;
                background-color: blue;
                color: white;
                text-align: center;
            }
        </style> -->
        
    </head>
    <body>

        <!--wrapper start-->
        <div class="wrapper">
            <?php include 'header.php' ?>   

            <?php
                if(isset($_SESSION['stattus']) && $_SESSION['status'] != ''){
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
                    <div id="menu">
                        <ol style="font-size: 20px; margin-left: -2px;" class="breadcrumb"> DANH SÁCH CÁC LỚP KHOA CÔNG NGHỆ THÔNG TIN
                            <li style="margin-top: -3px;"> <a href="index.php" ><i class="fa fa-home"></i> Trang chính </a> </li> 
                            <span style="font-size: 11px; margin-top: 8px;"> > </span>
                            <!-- <li style="margin-top: -3px;"> <span> > </span> </li> -->
                            <li style="margin-top: -3px;"> <a href="lop.php"><i class="fa fa-users"></i> Lớp </a> </li>
                        </ol>
                    </div>
                    <?php echo $o ?>
                    <?php
                        $query = "SELECT * FROM lophoc";
                        $result = mysqli_query($link, $query);
                        if( mysqli_num_rows($result) > 0){
                            $i=0;
                            while ($r = mysqli_fetch_assoc($result)){
                                    $i++;
                                    $malop = $r['malop'];
                                    $tenlop = $r['tenlop'];
                                    $khoa = $r['khoa'];
                                    $covan =$r['covanhoctap'];                      
                            }
                        }
                    ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#classModal" style="margin-left: 20px">
                        Thêm lớp
                    </button>
                    <!-- <h2 >DANH SÁCH CÁC LỚP KHOA CÔNG NGHỆ THÔNG TIN  </h2> -->
						<div id="listSV">
							<table width = "70%">
								<tr>
                                    <th>STT</th>
                                    <th style="display: none;">#ID</th>
                                    <th>Mã lớp</th>
                                    <th>Tên lớp</th>
                                    <th>Khóa</th>
                                    <th>Cố vấn học tập</th>
                                    <th>Chỉnh sửa</th>
                                    <th>Xóa</th>
                                </tr>
                                
                                <?php
                                    $dem = 0;
                                    $kq = mysqli_query($link, "SELECT *FROM lophoc");
                                    while($row = mysqli_fetch_array($kq))
                                    {
                                        $dem += 1;
                                        ?>
                                            <tr>
                                                <td scope="row"><?php echo $dem ?></td>
                                                <td class="lop_id" style="display: none;"><?php echo $row['lopID'] ?></td>
                                                <td><?php echo $row['malop'] ?></td>
                                                <td><?php echo $row['tenlop'] ?></td>
                                                <td><?php echo $row['khoa'] ?></td>
                                                <td><?php echo $row['covanhoctap'] ?></td>
                                                <td>
                                                    <a href="" class="edit_btn">
                                                        <i style="color: #0066CC; margin-left: 0%;" class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="" class="delete_btn">
                                                        <i style="color: #0066CC; margin-left: -2%;" class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                ?>
							</table>
						</div>
					<!-- <form id="formChucnang">
						<a href="chucnang/themlop.php" ><input  id="btnThemSV" type="button" value="THÊM LỚP"> </a>
					</form> -->
                        <form method="POST" enctype="multipart/form-data" id="formChucnang">
                            <input type="file" name="file" id="btnThemSV" value="THEM HOC PHAN" required> <br>
                            <button type="submit" name="btnGui" style="padding: 8px; font-size: 14px;">THÊM LỚP</button>
                        </form>
		      	<!-- </div> -->
            </div>
            <!--main container end-->
        </div>
        <!--wrapper end-->

        <!-- Modal Add Class -->
        <div class="modal fade" id="classModal" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="classModalLabel">Thêm mới lớp</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="themlop.php" method="POST">
                        <div class="modal-body">
                            <!-- <input type="text" name="" id=""> -->
                            <div class="form-group">
                                <label for="">Mã lớp</label>
                                <input type="text" name="them_malop" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tên lớp</label>
                                <input type="text" name="them_tenlop" class="form-control" placeholder="Nhập tên lớp" minlength="10" maxlength="30" required>
                            </div>
                            <div class="form-group">
                                <label for="">Khóa</label>
                                <!-- <input type="text" name="them_khoa" class="form-control" required> -->
                                <select name="them_khoa" class="form-control" required>
                                    <option value="">
                                       <?php
                                            $khoahoc = mysqli_query($link, "SELECT khoa FROM lophoc ORDER by khoa DESC LIMIT 1");
                                            while($chay = mysqli_fetch_assoc($khoahoc)){?>
                                                <option><?php echo $chay['khoa']+1 ?></option>
                                                <?php
                                            }
                                       ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <!-- <input type="text" name="them_cvht" id="add_cvht" class="form-control"> -->
                                <label for="">Cố vấn học tập</label>
                                <select name="them_cvht" class="form-control">                                             
                                    <option style="text-align: center;"> <?php echo $covan ?> 
                                        <?php
                                            $r = mysqli_query($link,"SELECT *FROM giangvien");
                                            while($row = mysqli_fetch_array($r)){ ?> 
                                                <option> <?php echo $row['hoten']; ?> </option>  
                                                <?php  
                                            }
                                        ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Đóng </button>
                            <button type="submit" name="add_lop" class="btn btn-primary"> Lưu </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Delete Class -->
        <div class="modal fade" id="deleteClassModal" tabindex="-1" role="dialog" aria-labelledby="deleteClassModalLabel" aria-hidden="true" style="margin-top: 140px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteClassModalLabel">Xóa lớp</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="xoalop.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="lop_id" id="delete_id">
                            <h5>Bạn có muốn xóa lớp này không?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Hủy </button>
                            <button type="submit" name="delete_lop" class="btn btn-primary">Đồng ý</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Update Class -->
        <div class="modal fade" id="editClassModal" tabindex="-1" role="dialog" aria-labelledby="editClassModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editClassModalLabel">Chỉnh sửa thông tin lớp</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="sualop.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="edit_id" id="edit_id">
                            <div class="form-group">
                                <label for="">Mã lớp</label>
                                <input type="text" name="malop" id="edit_malop" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Tên lớp</label>
                                <input type="text" name="tenlop" id="edit_tenlop" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Khóa</label>
                                <!-- <input type="text" name="khoa" id="edit_khoa" class="form-control">  -->
                                <select name="khoa" id="edit_khoa" class="form-control"> 
                                    <option style="text-align: center;"> <?php echo $khoa ?>
                                            <?php
                                                $r = mysqli_query($link,"SELECT *FROM lophoc");
                                                while($row = mysqli_fetch_array($r)){ ?> 
                                                    <option> <?php echo $row['khoa']; ?> </option>  
                                                    <?php  
                                                }
                                                ?>
                                    </option>
                                </select>  
                            </div>
                            <div class="form-group">
                                <label for="">Cố vấn học tập</label>
                                <!-- <input type="text" name="cvht" id="edit_cvht" class="form-control"> -->
                                <select name="cvht" id="edit_cvht" class="form-control">                                             
                                    <option style="text-align: center;"> <?php echo $covan ?>
                                        <?php
                                            $r = mysqli_query($link,"SELECT *FROM giangvien");
                                            while($row = mysqli_fetch_array($r)){ ?> 
                                                <option> <?php echo $row['hoten']; ?> </option>  
                                                <?php  
                                            }
                                        ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Đóng </button>
                            <button type="submit" name="update_lop" class="btn btn-primary"> Cập nhật </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('.delete_btn').click(function (e) {
                    e.preventDefault();

                    var lop_id = $(this).closest('tr').find('.lop_id').text();
                    // console.log(lop_id);
                    $('#delete_id').val(lop_id);
                    $('#deleteClassModal').modal('show');
                });

                $('.edit_btn').click(function (e) {
                    e.preventDefault();

                    var lop_id = $(this).closest('tr').find('.lop_id').text();
                        // console.log(mon_id);

                    $.ajax({
                        type: "POST",
                        url: "sualop.php",
                        data: {
                            'checking_edit_btn': true,
                            'lop_id': lop_id,
                        },
                        success: function (response){
                            // console.log(response);
                            $.each(response, function (key, value) { 
                                    //  console.log(value['fname']);
                                $('#edit_id').val(value['lopID']);
                                $('#edit_malop').val(value['malop']);
                                $('#edit_tenlop').val(value['tenlop']);
                                $('#edit_khoa').val(value['khoa']);
                                $('#edit_cvht').val(value['covanhoctap']);
                            });
                            $('#editClassModal').modal('show');
                        }
                    });
                });
            });
        </script>
<?php
    }
    else{
        header('location: user_login.php');
    }
    
?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    
    <!-- <div class="footer">
        <p>© Website được thiết kế bởi Khắc Huy & Trung Khánh</p>
    </div> -->

    </body>
</html>

        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>
                           