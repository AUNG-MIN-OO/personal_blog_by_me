<?php
session_start();
if (empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])){
    header("location:login.php");
}
include "../config/config.php";

$stmt = $pdo->prepare("SELECT * FROM users WHERE id=".$_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php include "header.php" ?>
<?php include "sidebar.php" ?>
<?php include "navbar.php" ?>


<?php
if (!empty($_SESSION['status'])){
    ?>
    <div aria-live="polite" aria-atomic="true" style="position: fixed;z-index: 2010;right: 10px;top: 7px;" >
        <div class="toast animate__animated  animate__bounceInDown bg-button" role="alert" aria-atomic="true">
            <div class="toast-header bg-button text-white">
                <strong class="me-auto">New notifications!</strong>
                <small>Just now!</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-white">
                <h5><?php echo $_SESSION['status'];unset($_SESSION['status']); ?></h5>
            </div>
        </div>
    </div>
    <?php
}
?>
<div class="vh-100 bg-background p-3">
    <div class="title d-flex justify-content-between align-items-center">
        <div class="">
            <h3>My Profile</h3>
        </div>
        <div class="mb-2">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="index.php" class="text-white text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card bg-blue mb-2">
                <div class="card-body">
                    <div class="text-center">
                        <img src="assets/images/<?php echo $user['image']; ?>" class="card-image" alt="">
                    </div>
                    <h3 class="text-center text-capitalize"><?php echo $user['name'] ?></h3>
                    <h4 class="text-center"><?php echo $user['email'] ?></h4>
                    <a href="profile_edit.php" class="text-decoration-none text-white btn btn bg-button w-100">Go to Edit<i class="feather-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
<?php include "footer.php"; ?>
