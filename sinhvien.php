<?php
   include 'connect/connect.php';
   session_start();
   if(isset($_SESSION['username'])){
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
        for($row = 3; $row <= $highestRow; $row++){
            $masv = $sheetData[$row]['A'];
            $id_lop = $sheetData[$row]['B'];
            $idcn = $sheetData[$row]['C'];
            $hoten = $sheetData[$row]['D'];
            $ngaysinh = $sheetData[$row]['E'];
            $gt = $sheetData[$row]['F'];
            $sdt = $sheetData[$row]['G'];
            $dc = $sheetData[$row]['H'];
            // $cn = $sheetData[$row]['I'];
            $email = $sheetData[$row]['I'];
            $pass = $sheetData[$row]['J'];
            $md5 = md5($pass);

            $excellop = mysqli_query($link, "SELECT *FROM lophoc");
            while($chay = mysqli_fetch_array($excellop))
            {
                if($id_lop == $chay['malop']){
                    $id_lop = $chay['lopID'];
                }
            }  
            if($idcn == "CNPM"){
                $idcn = 2;
            }
            else if($idcn == "MMT"){
                $idcn = 3;
            }
            else if($idcn == "HTTT"){
                $idcn = 4;
            }
            else{
                $idcn = 5;
            } 

            $count = 0;
            $excel_sv = mysqli_query($link, "SELECT *FROM sinhvien");
            while($a = mysqli_fetch_array($excel_sv)){
                if($a['sodt'] == $sdt || $a['MaSV'] == $masv || $a['email'] == $email){
                    $count++;
                }
            }

            if($count == 0){
                $sql = "INSERT INTO sinhvien(MaSV,lopID,id_cn,hoten,ngaysinh,gioitinh,sodt,diachi,email,password) VALUES ($masv,$id_lop,$idcn,'$hoten','$ngaysinh','$gt','$sdt','$dc','$email','$md5')";
                $link->query($sql);
            }
            else{
                ?>
                    <script>
                        swal({
                        title: "Import kh??ng th??nh c??ng",
                        text: "Vui l??ng th??? l???i",
                        icon: "error",
                        button: "X??c nh???n",
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

            <?php
                if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
                    ?>
                    <script>
                        swal({
                        title: "<?php echo $_SESSION['status']; ?>",
                        // text: "You clicked the button!",
                        icon: "<?php echo $_SESSION['status_code']; ?>",
                        button: "X??c nh???n",
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
                        <ol style="font-size: 20px; margin-left: -2px;" class="breadcrumb"> DANH S??CH SINH VI??N L???P <?php echo $malop ?>
                            <li style="margin-top: -3px;"> <a href="index.php" ><i class="fa fa-home"></i> Trang ch??nh </a> </li> 
                            <span style="font-size: 11px; margin-top: 8px;"> > </span> &nbsp;  &nbsp; &nbsp; 
                            <li style="margin-top: -3px;"> <a href="dssv.php"><i class="fa fa-users"></i> Danh s??ch sinh vi??n</a> </li>
                            &nbsp; &nbsp; <span style="font-size: 11px; margin-top: 8px;"> > </span> &nbsp;  &nbsp; &nbsp;
                            <li style="margin-top: -3px;"> <a href="sinhvien.php?id=<?php echo $idlop?>"><i class="fa fa-user"></i> Sinh vi??n <?php echo $malop ?></a> </li>
                        </ol>
                    </div>
                         
					<!-- <h2 style="text-align: center;">  </h2> -->
                        <form action="export.php" method="POST" >
                            <input type="hidden" value="<?php echo $idlop ?>" name="xuat">
                            <button class="export fa fa-download" type="submit" name="btnExport" id="xuatfile"> Xu???t file Excel </button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#StudentModal" style="margin-left: 20px; margin-top: -5px;">
                                Th??m sinh vi??n
                            </button>
                        </form>
                        <form method="post" id="f_search"> <input type="txtSearch" type="search" name="search" style="padding: 5px; width: 300px;" placeholder = "Nh???p t??n ho???c MSSV">
                                <input id="btnSearch" type="submit" name="timkiem" value="" require>
                        </form>
                        <div id="listSV">
							<!-- <form method="post" id="f_search"> <input type="txtSearch" type="search" name="search" required style="padding: 5px; width: 300px;" placeholder = "Nh???p t??n ho???c MSSV">
                                <input id="btnSearch" type="submit" name="timkiem" value="" require>
                            </form> -->
							<table width = "70%">
								<tr>
                                    <th> STT </th>
                                    <th style="display: none;"> #ID </th>
                                    <th> H??? t??n </th>
                                    <th> M?? sinh vi??n </th>
                                    <th style="display: none;"> Ng??y sinh </th>
                                    <th style="display: none;"> Gi???i t??nh </th>
                                    <th style="display: none;"> S??? ??i???n tho???i </th>
                                    <th style="display: none;"> ?????a ch??? </th>
                                    <th > Chuy??n ng??nh </th>
                                    <!-- <th> Email </th> -->
                                    <th> Th??ng tin </th>
                                    <th> Ch???nh s???a </th>
                                    <th> X??a </th>
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
                                                    title: "Kh??ng t??m th???y k???t qu???",
                                                    text: "Vui l??ng th??? l???i",
                                                    icon: "info",
                                                    button: "OK",
                                                    });
                                                </script>
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
                                                    <td>
                                                        <a href="" class="edit_btn">
                                                            <i style="color: #0066CC; margin-left: 0%;" class="fa fa-edit"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="" class="delete_btn">
                                                            <i style="color: #0066CC; margin-top: 0%;" class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            
                                        }
                                    }
                                    else{
                                        echo '<tr > <td colspan="12" align = "center"> Kh??ng c?? d??? li???u </td></tr>';
                                        // echo '<script> alert("Ko") </script>';
                                    }
                                ?>

							</table>
                            <br>
							    <p style="color: black; text-align:center;"><b> S??? S???: <?php echo $dem;?> </b></p>
						</div>
                        <form method="POST" enctype="multipart/form-data" id="formChucnang">
                            <input type="file" name="file" id="btnThemSV" value="THEM HOC PHAN" required> <br>
                            <button type="submit" name="btnGui" style="padding: 8px; font-size: 14px;">TH??M SINH VI??N</button>
                        </form>
					<!-- <form id="formChucnang">
						<a href="chucnang/themlop.php" ><input  id="btnThemSV" type="button" value="TH??M L???P"> </a>
					</form> -->
		      <!-- </div> -->
            </div>
            <!--main container end-->
        </div>
        <!--wrapper end-->

        <!-- Modal Add Students -->
        <div class="modal fade" id="StudentModal" tabindex="-1" aria-labelledby="StudentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="StudentModalLabel">Th??m sinh vi??n m???i</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="themsv.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" value="<?php echo $idlop ?>" name="them_sv">
                            <div class="form-group">
                                <label for="">M?? l???p</label>
                                <select name="them_ml" class="form-control">
                                    <option style="text-align: center;">
                                        <?php echo $idlop ?> <?php echo $malop ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">M?? chuy??n ng??nh</label>
                                <select name="them_macn" class="form-control" required>
                                    <option style="text-align: center;">
                                        <?php
                                            $r = mysqli_query($link,"SELECT *FROM chuyennganh");
                                            while($row = mysqli_fetch_array($r)){ ?> 
                                                <option> <?php echo $row['id_cn']; ?> <?php echo $row['tencn'] ?> </option>  
                                                <?php  
                                            }
                                        ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">M?? s??? sinh vi??n</label>
                                <!-- <input type="text" name="them_mssv" class="form-control"> -->
                                <select name="them_mssv" class="form-control" required>
                                    <option value="">
                                        <?php
                                            $ma_sv = mysqli_query($link, "SELECT MaSV FROM sinhvien WHERE lopID='$idlop' ORDER BY MaSV DESC limit 1 ");
                                            while($run = mysqli_fetch_assoc($ma_sv)){?>
                                                <option><?php echo $run['MaSV']+1 ?></option>
                                                <?php
                                            }
                                        ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">H??? t??n sinh vi??n</label>
                                <input type="text" name="them_ht" id="input3" class="form-control" placeholder="Nh???p h??? t??n" minlength="6" maxlength="35" required 
                                        onkeypress="if (!window.__cfRLUnblockHandlers) return false; return restrictCharacters(this, event, alphaOnly);" data-cf-modified-3a7a5c16bb3520291edcacfb-="" />
                            </div>
                            <div class="form-group">
                                <label for="">Ng??y sinh</label>
                                <input type="date" name="them_ns" class="form-control" min="1995-01-01" max="2003-01-01" required>
                            </div>
                            <div class="form-group">
                                <label for="">Gi???i t??nh</label>
                                <!-- <input type="text" name="them_gt" class="form-control"> -->
                                <select name="them_gt" class="form-control">
                                    <option>Nam</option>
                                    <option>N???</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">S??? ??i???n tho???i</label>
                                <input type="text" id="phone" name="them_sdt" class="form-control" minlength="10" maxlength="10" required placeholder="Nh???p s??? ??i???n tho???i" oninput="this.value=this.value.replace(/[^0-9]/g,'');" id="myId"/>
                            </div>
                            <div class="form-group">
                                <label for="">?????a ch???</label>
                                <input type="text" name="them_dc" class="form-control" minlength="4" maxlength="20" placeholder="Nh???p ?????a ch???" required>
                            </div>
                            <!-- <div class="form-group">
                                <label for="">Chuy??n ng??nh</label>
                                <input type="text" name="them_cn" class="form-control">
                            </div> -->
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="them_email" class="form-control" placeholder="mssv@student.vlute.edu.vn">
                            </div>
                            <div class="form-group">
                                <label for=""></label>
                                <input type="hidden" name="them_pass" value="1" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">????ng</button>
                            <button type="submit" name="add_sinhvien" class="btn btn-primary" style="width: 70px;">L??u</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Delete Students -->
        <div class="modal fade" id="deleteStudentModal" tabindex="-1" role="dialog" aria-labelledby="deleteStudentLabel" aria-hidden="true" style="margin-top: 140px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteStudentLabel">X??a sinh vi??n</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="xoasv.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" value="<?php echo $idlop ?>" name="xoa_sv">
                            <input type="hidden" name="sinhvien_id" id="delete_id">
                            <h5>B???n c?? mu???n x??a sinh vi??n n??y kh??ng?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> H???y </button>
                            <button type="submit" name="delete_sinhvien" class="btn btn-primary"> ?????ng ?? </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Update Students -->
        <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStudentModalLabel">Ch???nh s???a th??ng tin sinh vi??n</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="suasv.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" value="<?php echo $idlop ?>" name="sua_sv">
                            <input type="hidden" name="edit_id" id="edit_id">
                            <div class="form-group">
                                <label for="">M?? s??? sinh vi??n</label>
                                <input type="text" name="sv" id="edit_mssv" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">H??? t??n sinh vi??n</label>
                                <input type="text" name="hoten" id="edit_hoten" class="form-control" minlength="6" maxlength="35" required
                                        onkeypress="if (!window.__cfRLUnblockHandlers) return false; return restrictCharacters(this, event, alphaOnly);" data-cf-modified-3a7a5c16bb3520291edcacfb-="" /> 
                                <!-- pattern="[A-Za-z0-9]+" -->
                            </div>
                            <div class="form-group">
                                <label for="">Ng??y sinh</label>
                                <input type="date" name="ngaysinh" id="edit_ns" class="form-control" min="1995-01-01" max="2003-01-01" required> 
                            </div>
                            <div class="form-group">
                                <label for="">S??? ??i???n tho???i</label>
                                <input type="text" name="sdt" id="edit_sdt" class="form-control" minlength="10" maxlength="10" required oninput="this.value=this.value.replace(/[^0-9]/g,'');" id="myId"/>
                            </div>
                            <div class="form-group">
                                <label for="">?????a ch???</label>
                                <input type="text" name="diachi" id="edit_dc" class="form-control" minlength="4" maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <label for="">Chuy??n ng??nh</label>
                                <!-- <input type="text" name="chuyennganh" id="edit_cn" class="form-control"> -->
                                <select name="sua_chuyennganh" id="edit_cn" class="form-control" required> 
                                    <option style="text-align: center;"> <?php  ?>
                                            <?php
                                                $r = mysqli_query($link,"SELECT *FROM chuyennganh");
                                                while($row = mysqli_fetch_array($r)){ ?> 
                                                    <option> <?php echo $row['id_cn']; ?> <?php echo $row['tencn']; ?> </option>  
                                                    <?php  
                                                }
                                            ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> ????ng </button>
                            <button type="submit" name="update_sv" class="btn btn-primary"> C???p nh???t </button>
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
            var alphaOnly = /[A-Z ?? ?? ??? ?? ??? ?? ??? ??? ??? ??? ??? ?? ??? ??? ??? ??? ??? ?? ?? ??? ??? ??? ?? ??? ??? ??? ??? ??? ?? ??? ??? ??? ??? ?? ?? ??? ?? ??? ?? ?? ??? ?? ??? ?? ?? ??? ??? ??? ??? ??? ??? ??? ??? ??? ??? ?? ?? ?? ??? ?? ??? ??? ??? ??? ??? ??? ?? ?? ?? ??? ?? ??? ?? ??? ??? ??? ?? ??? ??? ??? ??? ??? ?? ??? ??? ?? ?? ??? ?? ??? ??? ??? ??? ??? ??? ??? ?? ?? ?? ??? ?? ??? ??? ??? ??? ?? ??? ??? ??? ??? ??? ?? ?? ??? ?? ??? ??? ?? ?? ?? ??? ??? ??? ??? ??? ??? ??? ??? ?? ??? ????? a-z]/g;

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