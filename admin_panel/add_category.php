<?php
session_start();
require "../config/config.php";
if (empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])){
    header("location:login.php");
}

if ($_POST){
    if (empty($_POST['category'])){
        if (empty($_POST['category'])){
            $catErr = "Category is required";
        }
    }else{
        $category = $_POST['category'];
        $user_id = $_SESSION['user_id'];

        $stmt = $pdo->prepare("INSERT INTO categories(category_name,user_id) VALUES (:category,:user_id)");
        $result = $stmt->execute(
            array(':category'=>$category,':user_id'=>$user_id)
        );
        if ($result){
            $_SESSION['status'] = "New Category is added";
        }
    }
}
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
            <h3>Create New Category</h3>
        </div>
        <div class="mb-2">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="category_list.php" class="text-white text-decoration-none">Category List</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card border-0 mb-4">
                <div class="card-body bg-blue">
                    <form action="add_category.php" method="post">
                        <div class="mb-4">
                            <label for="category" class="mb-2">Category Name</label>
                            <input type="text" id="category" name="category" class="form-control">
                            <small class="fw-bold text-danger"><?php echo (!empty($catErr))?"*$catErr":""; ?></small>
                        </div>
                        <button class="btn bg-button float-end">Create Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include "footer.php"; ?>