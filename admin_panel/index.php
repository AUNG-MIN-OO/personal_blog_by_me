<?php
session_start();
if (empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])){
    header("location:login.php");
}
?>
<?php include "header.php" ?>
<?php include "sidebar.php" ?>
<?php include "navbar.php" ?>

<div class="vh-100 bg-background p-3">
    <div class="title d-flex justify-content-between align-items-center">
        <div class="">
            <h3>Admin Dashboard</h3>
        </div>
        <div class="mb-2">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-4">
            <div class="card bg-blue mb-2">
                <div class="card-body">
                    <div class="text-center">
                        <img src="assets/images/<?php echo $_SESSION['user_image']; ?>" class="card-image" alt="">
                    </div>
                    <h3 class="text-center">Welcome Admin</h3>
                    <a href="my_profile.php" class="text-decoration-none text-white btn btn-sm bg-button w-100">Go to Profile <i class="feather-arrow-right mb-0"></i></a>
                </div>
            </div>
            <div class="card bg-blue mb-2">
                <div class="card-body">
                    <h3>Category List <i class="feather-layers"></i></h3>
                    <hr>
                    <h3 class="text-center">
                        <span class="counter">5</span>
                        <span>Categories</span>
                    </h3>
                    <a href="category_list.php" class="text-decoration-none text-white btn btn-sm bg-button w-100">Go to check <i class="feather-arrow-right mb-0"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card bg-blue mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <h5 class="text-white-50">Orders</h5>
                                    <span class="counter h4">1,234,567.00</span>
                                </div>
                                <div class="">
                                    <span class="cUp-icon">
                                        <i class="feather-package"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card bg-blue">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <h5 class="text-white-50">Orders</h5>
                                    <span class="counter h4">1,234,567.00</span>
                                </div>
                                <div class="">
                                    <span class="cUp-icon">
                                        <i class="feather-package"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 mb-4">
                    <div class="card bg-blue">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <h5 class="text-white-50">Orders</h5>
                                    <span class="counter h4">1,234,567.00</span>
                                </div>
                                <div class="">
                                    <span class="cUp-icon">
                                        <i class="feather-package"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card bg-blue">
                        <div class="card-body">
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include "footer.php"; ?>