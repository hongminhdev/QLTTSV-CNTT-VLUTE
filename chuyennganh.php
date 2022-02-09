<?php
	session_start();
	if (isset($_SESSION['username'])){
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
        <link rel="shortcut icon" href="image/vlute.ico">
        <link rel="stylesheet" href="style/style1.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
        <script src="vendors/js/sweetalert.min.js"></script>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    </head>
    <body>
        <?php
            require ('Classes/PHPExcel.php');
            if (isset($_POST['btnGui'])){
                $file = $_FILES['file']['tmp_name'];
                $objReader = PHPExcel_IOFactory::createReaderForFile($file);
                $objReader->setLoadSheetsOnly('Sheet1');  
            
                $objExcel = $objReader->load($file);
                $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);

                $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
                for($row = 3; $row <= 60; $row++){
                    $cn = $sheetData[$row]['A'];
                    $mahp = $sheetData[$row]['B'];
                    $tenhp = $sheetData[$row]['C'];
                    $sotc = $sheetData[$row]['D'];
                    $lt = $sheetData[$row]['E'];
                    $th = $sheetData[$row]['F'];
                    $gc = $sheetData[$row]['G'];

                    if($cn == "CNPM"){
                        $cn = 2;
                    }
                    else if($cn == "MMT"){
                        $cn = 3;
                    }
                    else if($cn == "HTTT"){
                        $cn = 4;
                    }
                    else{
                        $cn = 5;
                    }
            
                    $count = 0;
                    $excel_hocphan = mysqli_query($link, "SELECT *FROM hocphan WHERE id_cn='$cn'");
                    while($a = mysqli_fetch_array($excel_hocphan)){
                        if($a['mahp'] == $mahp || $a['tenhp'] == $tenhp){
                            $count++;
                        }
                    }

                    $count_tinchi = 0;
                    if( $sotc == 0 || $lt == 0 ){
                        $count_tinchi++;
                    }

                    if( $count == 0){
                        
                        $sql = "INSERT INTO hocphan(id_cn,mahp,tenhp,sotc,tclt,tcth,ghichu) VALUES ($cn,'$mahp','$tenhp',$sotc,$lt,$th,'$gc')";
                        $link->query($sql);
                        
                    }
                    // 
                    else{
                        ?>
                            <script>
                                swal({
                                title: "Import file không thành công",
                                text: "Vui lòng thử lại",
                                icon: "error",
                                button: "Xác nhận",
                                });
                            </script>
                        <?php
                    }
                }
                
            }
        ?>
        <!--wrapper start-->
        <div class="wrapper">
            <?php include 'header.php' ?>
            <?php  ?>
            <div class="main-container">
				<!-- <div id="main-contain"> -->
                    <?php
                        $tencn = '';
                        $id_cn = $_GET['id'];
                        $query = "SELECT *FROM chuyennganh WHERE id_cn=$id_cn";
                        $kq = mysqli_query($link, $query);
                        while($row = mysqli_fetch_assoc($kq)){
                            $tencn = $row['tencn'];
                        }
                    ?>
                    <div id="menu">
                        <ol style="font-size: 20px; margin-left: -2px;" class="breadcrumb"> Chuyên Ngành <?php echo $tencn ?>
                            <li style="margin-top: -3px;"> <a href="index.php" ><i class="fa fa-home"></i> Trang chính </a> </li> 
                            <span style="font-size: 11px; margin-top: 8px;"> > </span> &nbsp;  &nbsp; &nbsp; 
                            <li style="margin-top: -3px;"> <a href="daotao.php"><i class="fas fa-map"></i> Chuyên ngành </a> </li>
                        </ol>
                    </div>
                    <!-- <h3>  </h3> -->
                    <form action="export_hocphan.php" method="POST" >
                            <input type="hidden" value="<?php echo $id_cn ?>" name="xuat">
                            <button class="export fa fa-download" type="submit" name="Export_hp" id="xuatfile"> Xuất file Excel </button>
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#HocPhanModal" style="margin-left: 20px; margin-top: -5px;">
                                Thêm học phần
                            </button> -->
                    </form>
                        <div id="listSV">
                            <table width = "70%">
                                <tr>
                                    <th> STT </th>
                                    <th style="display: none;"> #ID </th>
                                    <th> Mã học phần </th>
                                    <th> Tên học phần </th>
                                    <th> Số tín chỉ </th>
                                    <th> TCLT </th>
                                    <th> TCTH </th>
                                    <th> Ghi chú </th>
                                    <th> Chỉnh sửa</th>
                                    <th> Xóa </th>
                                </tr>

                                <?php
                                    $dem = 0;
                                    $kq = mysqli_query($link, "SELECT *FROM hocphan WHERE hocphan.id_cn='".$_GET['id']."'");
                                    if(mysqli_num_rows($kq) > 0){
                                        while($row = mysqli_fetch_assoc($kq))
                                        {
                                        $dem += 1;
                                        ?>
                                            <tr>
                                                <td scope="row"><?php echo $dem ?></td>
                                                <td class="mon_id" style="display: none;"><?php echo $row['idmon'] ?></td>
                                                <td><?php echo $row['mahp'] ?></td>
                                                <td><?php echo $row['tenhp'] ?></td>
                                                <td><?php echo $row['sotc'] ?></td>
                                                <td><?php echo $row['tclt'] ?></td>
                                                <td><?php echo $row['tcth'] ?></td>
                                                <td><?php echo $row['ghichu'] ?></td>
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
                                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                    <i style="color: #0066CC; margin-left: 25%;" class="fa fa-trash"></i>
                                                </button> -->
                                            </tr>
                                        <?php
                                        }
                                    }
                                    else{
                                        echo '<tr > <td colspan="12" align = "center"> Không có dữ liệu </td></tr>';
                                    }
                                ?>
                            </table>
                        </div>

                        <form method="POST" enctype="multipart/form-data" id="formChucnang">
                            <input type="file" name="file" id="btnThemSV" value="THEM HOC PHAN" required> <br>
                            <button type="submit" name="btnGui" style="padding: 8px; font-size: 14px;">THÊM HỌC PHẦN</button>
                        </form>

                        <!-- <form method="POST" enctype="multipart/form-data">
                            <input type="file" name="file" id="btnThemSV" value="THÊM LỚP">
                            <button type="submit" name="btnGui">Import</button>
                        </form> -->
				<!-- </div> -->
            </div>
            <!--main container end-->
        </div>
        <!--wrapper end-->  

        

        <!-- Modal Delete-->
        <div class="modal fade" id="deleteHPModal" tabindex="-1" role="dialog" aria-labelledby="deleteHPModalLabel" aria-hidden="true" style="margin-top: 140px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteHPModalLabel">Xóa học phần</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="xoahp.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" value="<?php echo $id_cn ?>" name="back1">
                            <input type="hidden" name="hocphan_id" id="delete_id">
                            <h5>Bạn có muốn xóa học phần này không?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Hủy </button>
                            <button type="submit" name="delete_hp" class="btn btn-primary">Đồng ý</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Update-->
        <div class="modal fade" id="editHPModal" tabindex="-1" role="dialog" aria-labelledby="editHPModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editHPModalLabel">Chỉnh sửa học phần</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="suahp.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" value="<?php echo $id_cn ?>" name="back">
                            <input type="hidden" name="edit_id" id="edit_id">
                            <div class="form-group">
                                <label for="">Tên học phần</label>
                                <input type="text" name="tenhp" id="edit_tenhp" class="form-control" minlength="6" maxlength="40" required
                                    onkeypress="if (!window.__cfRLUnblockHandlers) return false; return restrictCharacters(this, event, alphaOnly);" data-cf-modified-3a7a5c16bb3520291edcacfb-="" />
                            </div>
                            <div class="form-group">
                                <label for="">Số tín chỉ</label>
                                <!-- <input type="text" name="sotc" id="edit_sotc" class="form-control">  -->
                                <select name="sotc" id="edit_sotc" class="form-control">
                                    <?php
                                        for($i=1; $i<=10; $i++){
                                            ?>
                                                <option><?php echo $i ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tín chỉ lý thuyết</label>
                                <!-- <input type="text" name="tclt" id="edit_tclt" class="form-control"> -->
                                <select name="tclt" id="edit_tclt" class="form-control">
                                    <?php
                                        for($i=0; $i<=5; $i++){
                                            ?>
                                                <option><?php echo $i ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tín chỉ thực hành</label>
                                <!-- <input type="text" name="tcth" id="edit_tcth" class="form-control"> -->
                                <select name="tcth" id="edit_tcth" class="form-control">
                                    <?php
                                        for($i=0; $i<=5; $i++){
                                            ?>
                                                <option><?php echo $i ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Ghi chú</label>
                                <select name="gc" id="edit_ghichu" class="form-control">
                                    <?php
                                        for($i=1; $i<=4; $i++){
                                            ?>
                                                <option><?php echo "Năm " .$i ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Đóng </button>
                            <button type="submit" name="update_hp" class="btn btn-primary"> Cập nhật </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $(".sidebar-btn").click(function(){
                    $(".wrapper").toggleClass("collapse");
                });
            });
        </script>

<?php
	}
	else {
		header('location:login.php');
	}
?>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="3a7a5c16bb3520291edcacfb-|49" defer=""></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="vendors/js/sweetalert.min.js"></script>
    <!-- <script src="http://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>    -->
        <script>
                $(document).ready(function () {
                    $('.delete_btn').click(function (e) {
                        e.preventDefault();

                        var mon_id = $(this).closest('tr').find('.mon_id').text();
                        console.log(mon_id);
                        $('#delete_id').val(mon_id);
                        $('#deleteHPModal').modal('show');
                    });

                    $('.edit_btn').click(function (e) {
                        e.preventDefault();

                        var mon_id = $(this).closest('tr').find('.mon_id').text();
                        // console.log(mon_id);

                        $.ajax({
                            type: "POST",
                            url: "suahp.php",
                            data: {
                                'checking_edit_btn': true,
                                'mon_id': mon_id,
                            },
                            success: function (response){
                                // console.log(response);
                                $.each(response, function (key, value) { 
                                    //  console.log(value['fname']);
                                    $('#edit_id').val(value['idmon']);
                                    $('#edit_tenhp').val(value['tenhp']);
                                    $('#edit_sotc').val(value['sotc']);
                                    $('#edit_tclt').val(value['tclt']);
                                    $('#edit_tcth').val(value['tcth']);
                                    $('#edit_ghichu').val(value['ghichu']);
                                });
                                $('#editHPModal').modal('show');
                            }
                        });
                    });
                });
        </script>

        
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

    <script type="3a7a5c16bb3520291edcacfb-text/javascript">
            /* code from qodo.co.uk */
            // create as many regular expressions here as you need:
            var digitsOnly = /[1234567890]/g;
            var integerOnly = /[0-9\.]/g; 
            var alphaOnly = /[A-Z Đ á à ả ã ạ ă ặ ắ ằ â ậ ấ ầ ẩ ẫ đ ẻ ẽ é è ẹ ê ệ ế ề ể ễ ọ ỏ õ ó ò ộ ô ố ồ ổ ỗ ơ ớ ờ ở ỡ ị í ì ỉ ĩ ụ ủ ũ ú ù ự ứ ừ ử ữ ỵ ỷ ỹ ý ỳ ướ a-z 1 2 3]/g;

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
