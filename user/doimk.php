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
                                    title: "X??c nh???n m???t kh???u kh??ng th??nh c??ng",
                                    text: "Vui l??ng th??? l???i",
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
                                    title: "?????i m???t kh???u th??nh c??ng",
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
                                    title: "M???t kh???u hi???n t???i kh??ng ch??nh x??c",
                                    text: "Vui l??ng nh???p ????ng m???t kh???u",
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
            <h3 style="margin-top: -35px;">Th??ng tin t??i kho???n</h3>  
            <center>    
                <div class="card" style="width: 670px;">
                    <!-- <div class="card-image">
                        <img src="../image/vlut.jpg" alt="">
                    </div>
                    <div class="profile-image">
                        <img src="../image/a.jpg" alt="">
                    </div> -->
                      
                    <div class="card-content">
                        
                    <i class="fa fa-key" style="font-size:24px"> &nbsp; <span style="font-size: 26px; font-family: none;">?????i m???t kh???u</span> </i>
                        
                        <form name="change" action="" method="POST" onSubmit="return validatePass()">
                        <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                            <table>
                                <tr height="50px">
                                    <input type="hidden" name="<?php echo $email ?>" value="<?php echo $email ?>" id="email">
									<td style="color: white; font-size: 20px;">
										<span style="color: black" id="sessionNum_counter">M???t kh???u hi???n t???i</span>
									</td>
									<td>
										<input type="password" name="opwd" id="opwd" minlength="1" maxlength="25" style="padding: 20px" required>
									</td> 
								</tr>
								<tr height="50px">
									<td style="color: white; font-size: 20px;">
										<span style="color: black">M???t kh???u m???i</span>
									</td>
									<td>
										<input type="password" name="npwd" id="npwd" minlength="8" maxlength="25" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="Vui l??ng bao g???m ??t nh???t 1 k?? t??? vi???t hoa, 1 k?? t??? vi???t th?????ng v?? 1 s???" style="padding: 20px" required>
									</td> 
								</tr>
								<tr>
									<td style="color: white; font-size: 20px;">
										<span style="color: black">X??c nh???n m???t kh???u m???i</span>
									</td>
									<td>
										<input type="password" name="cpwd" id="cpwd" minlength="8" maxlength="25" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="Vui l??ng bao g???m ??t nh???t 1 k?? t??? vi???t hoa, 1 k?? t??? vi???t th?????ng v?? 1 s???" style="padding: 20px" required>
									</td> 
                                </tr>
                                
                            </table>
                            <tr>
                                <input id="btnCpwd" type="submit" name="sub" value="C???P NH???T">
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
                           