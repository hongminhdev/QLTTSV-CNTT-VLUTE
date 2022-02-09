<?php
    include '../connect/connect.php';
    session_start();
    if(isset($_SESSION['email'])){
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <script src="../vendors/js/sweetalert.min.js"></script>

        <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
        <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
        
        
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="../vendors/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        
    </head>
    <body>

        <?php
            $s = $_SESSION['email'];
            $email = '';
            $res = mysqli_query($link, "SELECT *FROM sinhvien WHERE email='$s'");
            while($row = mysqli_fetch_assoc($res)){
                $email = $row['email'];
            }
        ?>
        
        <?php  
            if(isset($_POST['sub'])){
                $e= $email;
                $opwd = md5($_POST['opwd']);
                $npwd = $_POST['npwd'];
                $cpwd = $_POST['cpwd'];
                $md5 = md5($npwd);
                if(count($_POST) > 0 ){
                    $result = mysqli_query($link, "SELECT *FROM sinhvien WHERE email='$e'");
                    $r = mysqli_fetch_array($result);
                    if($opwd == $r['password']){
                        if(md5($npwd) != md5($cpwd)){
                            ?>
                                <script>
                                    swal({
                                    title: "Xác nhận mật khẩu không thành công",
                                    text: "Vui lòng thử lại",
                                    icon: "error",
                                    button: "OK",
                                    });
                                </script>
                            <?php
                        }
                        else{
                            mysqli_query($link, "UPDATE sinhvien SET password='$md5' WHERE email='$e'");
                            ?>
                                <script>
                                    swal({
                                    title: "Đổi mật khẩu thành công",
                                    text: "Successfully",
                                    icon: "success",
                                    button: "OK",
                                    });
                                </script>
                            <?php
                        }
                    }else{
                        ?>
                            <script>
                                    swal({
                                    title: "Mật khẩu hiện tại không chính xác",
                                    text: "Vui lòng nhập đúng mật khẩu",
                                    icon: "error",
                                    button: "OK",
                                    });
                            </script>
                        <?php
                    }
                }
            }
        ?>
        <div class="wrapper">
            <?php include 'header.php' ?>
            
            <div class="main-container" style="background-color: white;">
            <h3 style="margin-top: -35px;">Thông tin tài khoản</h3>  
            <center>    
                <div class="card" style="width: 670px;">
                    <!-- <div class="card-image">
                        <img src="../image/vlut.jpg" alt="">
                    </div>
                    <div class="profile-image">
                        <img src="../image/a.jpg" alt="">
                    </div> -->
                      
                    <div class="card-content">
                        
                    <i class="fa fa-key" style="font-size:24px"> &nbsp; <span style="font-size: 26px; font-family: none;">Đổi mật khẩu</span> </i>
                        
                        <form name="change" action="" method="POST" onSubmit="return validatePass()">
                        <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                            <table>
                                <tr height="50px">
                                    <input type="hidden" name="<?php echo $email ?>" value="<?php echo $email ?>" id="email">
									<td style="color: white; font-size: 20px;">
										<span style="color: black" id="sessionNum_counter">Mật khẩu hiện tại</span>
									</td>
									<td>
										<input type="password" name="opwd" id="opwd" minlength="1" maxlength="25" style="padding: 20px" required>
									</td> 
								</tr>
								<tr height="50px">
									<td style="color: white; font-size: 20px;">
										<span style="color: black">Mật khẩu mới</span>
									</td>
									<td>
										<input type="password" name="npwd" id="npwd" minlength="8" maxlength="25" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="Vui lòng bao gồm ít nhất 1 ký tự viết hoa, 1 ký tự viết thường và 1 số" style="padding: 20px" required>
									</td> 
								</tr>
								<tr>
									<td style="color: white; font-size: 20px;">
										<span style="color: black">Xác nhận mật khẩu mới</span>
									</td>
									<td>
										<input type="password" name="cpwd" id="cpwd" minlength="8" maxlength="25" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="Vui lòng bao gồm ít nhất 1 ký tự viết hoa, 1 ký tự viết thường và 1 số" style="padding: 20px" required>
									</td> 
                                </tr>
                                
                            </table>
                            <tr>
                                <input id="btnCpwd" type="submit" name="sub" value="CẬP NHẬT">
                                </tr>   
                        </form>
                        
                    </div>
                </div> 
            </center>   
            </div>
            <!--main container end-->
        </div>
        <!--wrapper end-->
        
        <script type="text/javascript">
            $(document).ready(function(){
                $(".sidebar-btn").click(function(){
                    $(".wrapper").toggleClass("collapse");
                });

                $(document).ready(function(){ 
                    var maxChars = $("#sessionNum"); 
                    var max_length = maxChars.attr('maxlength'); 
                    if (max_length > 0) { 
                        maxChars.bind('keyup', function(e){ 
                            length = new Number(maxChars.val().length); 
                            counter = max_length-length; 
                            $("#sessionNum_counter").text(counter); 
                        }); 
                    } 
                }); 
            });
        </script>

        <script>
            function validatePass() {
                var opwd,npwd,cpwd,output = true;
                opwd = document.change.opwd;
                npwd = document.change.npwd;
                cpwd = document.change.cpwd;

                if(!opwd.value){
                    opwd.focus();
                    document.getElementById("opwd").innerHTML = "required";
                    output = false;
                }
                else if(!npwd.value){
                    npwd.focus();
                    document.getElementById("npwd").innerHTML = "required";
                    output = false;
                }
                else if(!cpwd.value){
                    cpwd.focus();
                    document.getElementById("cpwd").innerHTML = "required";
                    output = false;
                }
                
                return output;
            }
        </script>

<?php
    }
    else {
        header('location: user_login.php');
    }
?>
</body>
</html>
                           