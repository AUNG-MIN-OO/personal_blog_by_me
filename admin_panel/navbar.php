<?php
if (empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])){
    header("location:login.php");
}
?>
<div class="col-12 col-lg-9 col-xl-10 vh-100 content">
    <!--            nav bar start-->
    <nav class="navbar navbar-expand-lg navbar-dark nav-bar bg-blue py-2">
        <div class="container-fluid">
            <div class="d-block d-lg-none">
                <i class="feather-menu show-sidebar" style="font-size: 40px"></i>
            </div>
            <div class="search-form d-none d-lg-block">
                <form class="d-flex">
                    <input class="form-control me-2 rounded-pill" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn search-btn bg-button" type="submit"><i class="feather-search"></i></button>
                </form>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <div class="me-3 d-block d-lg-none search-btn">
                    <i class="feather-search search-icon" style="font-size: 35px;cursor: pointer;"></i>
                </div>
                <div class="dropdown">
                    <button class="btn bg-button dropdown-toggle text-white" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="assets/images/user/avatar1.jpg" alt="">
                        <span>
                            <?php echo $_SESSION['user_name'];?>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>