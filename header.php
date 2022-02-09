

<!--header menu start-->
<div class="header">
                <div class="header-menu">
                    <a href="index.php">
                        <div class="title">Admin <span>Quản trị</span></div> 
                    </a>
                    <!-- <div class="sidebar-btn">
                        <i class="fas fa-bars"></i>
                    </div> -->
                    <!-- <div class="header__toggle">
                        <i class='bx bx-menu' id="header-toggle"></i>
                    </div> -->
                    <!-- https://blog.teamtreehouse.com/create-simple-css-dropdown-menu --> 
                    <ul>
                        <span style="color: white; margin-top: 4%;" >Xin chào Admin </span> &nbsp; &nbsp;
                        <!-- <li><a href="dangxuat.php"><i class="fas fa-sign-out-alt"></i></a> -->
                        
                        
                        <div class="user-area dropdown float-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="user-avatar rounded-circle" src="image/a.jpg" alt="User Avatar">
                            </a>

                            <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="admin.php"><i class="fa fa-user"></i> Hồ sơ cá nhân </a>

                                <a class="nav-link" href="doi_pwd.php"><i class="fa fa-key"></i> Đổi mật khẩu </a>

                                <a class="nav-link" href="dangxuat.php"><i class="fa fa-sign-out"></i> Đăng xuất </a>
                            </div>
                        </div>

                    </ul>
                </div>
            </div>
            <!--header menu end-->
            <!--sidebar start-->
            <div class="sidebar">
                <div class="sidebar-menu">
                    <!-- <center class="profile">
                        <img src="1.jpg" alt="">
                        <p>Jessica</p>
                    </center> -->
                    <li class="item">
                        <a href="index.php" class="menu-btn">
                            <i class="fas fa-home"></i><span>Trang chính</span>
                        </a>
                    </li>
                    <li class="item" id="profile">
                        <a href="lop.php" class="menu-btn">
                            <i class="fas fa-users"></i><span>Lớp</span>
                        </a>
                    </li>
                    <!-- <li class="item">
                        <a href="dssv.php" class="menu-btn">
                            <i class="fas fa-user-graduate"></i><span>Sinh viên<i class="fas fa-chevron-down drop-down"></i></span>
                        </a>
                    </li> -->
                    <li class="item">
                        <a href="dssv.php" class="menu-btn">
                            <i class="fas fa-user-graduate"></i><span>Sinh viên</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="dsdiem.php" class="menu-btn">
                            <i class="fas fa-book-open"></i><span>Bảng điểm</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="daotao.php" class="menu-btn">
                            <i class="fas fa-map"></i><span>Chương trình đào tạo</span> 
                        </a>
                    </li>
                    <li class="item">
                        <a href="giangvien.php" class="menu-btn">
                            <i class="fas fa-chalkboard-teacher"></i><span>Giảng viên</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="danhsach_user.php" class="menu-btn">
                            <i class="fas fa-user"></i><span>Danh sách user</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="admin.php" class="menu-btn">
                            <i class="fas fa-laptop-code"></i><span>Tài khoản</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="" class="menu-btn" data-toggle="modal" data-target="#AboutModal">
                            <i class="fas fa-address-book"></i><span>About</span>
                        </a>
                    </li>
                    
                </div>
            </div>
            <!--sidebar end-->
            <!--main container start-->

        <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
        
        
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>

        
            <!-- Modal About -->
        <div style="margin-top: 65px;" class="modal fade" id="AboutModal" tabindex="-1" aria-labelledby="AboutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AboutModalLabel">About</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> <center><h5>Hệ thống quản lý thông tin sinh viên Khoa Công nghệ thông tin - VLUTE</h5></center> <br>
                        <img src="image/vlute.ico" alt=""/ width="80px" height="80px"> 
                        <!-- &nbsp; &nbsp; &nbsp;  -->
                        <div style="float: right;">
                            <div style="margin-right: 230px;">
                            <span style="margin-left: -250px;">Trường Đại học Sư phạm Kỹ thuật Vĩnh Long</span>  <br>
                            <!-- &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  -->
                            <span style="margin-left: -250px;">73 Nguyễn Huệ, Phường 2, TP. Vĩnh Long, tỉnh Vĩnh Long</span> <br>
                            <span style="margin-left: -250px;">Phone : (+84) 02703822141</span> <br>
                            <span style="margin-left: -250px;">E-mail : admin@ctt.vlute.edu.vn</span>
                            </div>
                        </div>
                        <br><br><br> <center>Copyright @ 2020 - Designed and developed by Hồng Khắc Huy & Nguyễn Trung Khánh</center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Đóng </button>
                        <!-- <button type="submit" name="add_lop" class="btn btn-primary"> Lưu </button> -->
                    </div>
                </div>
            </div>
        </div>






    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>




          
            

            