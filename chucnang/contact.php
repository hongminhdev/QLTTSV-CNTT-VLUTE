<?php
    session_start();
    if(isset($_SESSION['username']))
    {
    $link = new mysqli('localhost','root','','sinhvien') or die('failed');
    mysqli_query($link, 'SET NAMES UTF8');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Student Information Manager</title>
        <link rel="stylesheet" href="style/style1.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    </head>
    <body>

        <!--wrapper start-->
        <div class="wrapper">
            <?php include 'header.php' ?>

            <div class="main-container">
				<div id="main-contain"> 
				  <h2>CONTACT US</h2></br>
				  <div id="contact-contain">
					<img src="image/lgvlute.png" alt=""/ width="100px" height="100px"> 
					<big>
					<span style="color:white">Website quản lý thông tin sinh viên </span></big><br>
					Development by IT students <br> 
					
					
					<b> Contact me: </b>
					<br> <u> Phonenumber </u>: (+84) 0765992389
					<br> <u> Email </u>: itgroup@gmail.com
					
					<br>
					Excersise : Application Programming
					
					<br>
					&copy; Copyright 
			      </div>
		      </div>
            </div>
            <!--main container end-->
        </div>
        <!--wrapper end-->

        <script type="text/javascript">
        $(document).ready(function(){
            $(".sidebar-btn").click(function(){
                $(".wrapper").toggleClass("collapse");
            });
        });
        </script>

<?php
    }
    else{
        header('location:login.php');
    }
?>
</body>
</html>
                           