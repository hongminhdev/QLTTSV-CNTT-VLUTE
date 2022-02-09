<?php
	session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
		<title> Đăng nhập hệ thống </title>
		<link rel="stylesheet" href="style/style.css">
		<link rel="shortcut icon" href="image/vlute.ico">
    </head>
    <body>
        <!-- <header> 
            <div class="container"> 
                    <h1 align="center"> ADMIN LOGIN </h1>
			</div>
			
		</header> -->
        <!--endheader-->
        <div class="body">
            <div class="container"> 
				<h1 align="center" style="color: white; font-family: Times">ĐĂNG NHẬP HỆ THỐNG DÀNH CHO QUẢN TRỊ VIÊN</h1> <br>
				<h2 align="center"style="color: white; font-family: Times;  font-weight: normal;">Hệ thống quản lý thông tin sinh viên khoa Công nghệ thông tin trường Đại học Sư phạm Kỹ thuật Vĩnh Long</h2>
				<br> <br>
				<div id="formlogin">
                    <form method="post" name="login-form">
						<h1>Đăng nhập hệ thống &emsp; <img src="image/vlute.ico" alt=""></h1>  
						<br>
						<table>
							<tr height="50px">
								<td style="color: white; font-size: 20px;">
									<!-- Account -->
								</td>
								<td>
									<input type="text" name="taikhoan" placeholder="Tên đăng nhập">
								</td> 
							</tr>
							<tr>
								<td style="color: white; font-size: 20px;">
									<!-- Password -->
								</td>
								<td>
									<input id="submit" type="password" name="password" placeholder="Mật khẩu">
								</td> 
							</tr>
						</table>
						<input id="btndangnhap" type="submit" name="login" value="Đăng nhập">
					</form>
					<?php
						$link = new mysqli('localhost','root','','sinhvien') or die('kết nối thất bại '); 
						mysqli_query($link, 'SET NAMES UTF8');
						if(isset($_POST['login'])){
							if ( empty($_POST['taikhoan']) or empty($_POST['password'])) 
							{ 
								echo ' </br> <p style="color:white; font-size:20px;"> Tài khoản hoặc mật khẩu không hợp lệ </p>';
							}
							else
							{
								$username= $_POST['taikhoan'];
								$password= md5($_POST['password']);
								$query="SELECT * FROM admin where account = '$username' and password = '$password'";
								$result = mysqli_query($link, $query);
								$num = mysqli_num_rows($result);
								if($num==0)
									{
										echo'</br> <p style="color: white; font-size: 19px; font-weight: bold;"> Tài khoản hoặc mật khẩu không chính xác ! </p>';
									}
								else {

									$_SESSION['username']= $username;
									header('location:index.php');
									
									}
							}
							
						}

					?>
                </div>
            </div>
        </div>
        <!--endbody-->
        <!-- <footer>
            <div class="container"> 
              <div id="ftcontent"> Copyright @ 2020 - Developed by Group IT 24 </div>
            </div>
        </footer> -->
    </body>
</html>
