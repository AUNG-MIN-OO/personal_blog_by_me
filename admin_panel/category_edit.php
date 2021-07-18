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
        $id = $_POST['id'];
        $category = $_POST['category'];


        $stmt = $pdo->prepare("UPDATE categories SET category_name=:category WHERE id=:id");
        $result = $stmt->execute(
            array(':category'=>$category,':id'=>$id)
        );
        if ($result){
            $_SESSION['status'] = "Category is Updated";
            header("location:category_list.php");
        }
    }
}
$id = isset($_GET['id']) ? $_GET['id'] : '';
$stmt = $pdo->prepare("SELECT * FROM categories WHERE id=:id");
$stmt->execute(
        [':id'=>$id]
);
$catResult = $stmt->fetchAll();
?>
<?php include "header.php" ?>
<?php include "sidebar.php" ?>
<?php include "navbar.php" ?>

    <div class="vh-100 bg-background p-3">
    <div class="title d-flex justify-content-between align-items-center">
        <div class="">
            <h3>Edit Category</h3>
        </div>
        <div class="mb-2">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="add_category.php" class="text-white text-decoration-none">Add Category</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="category_list.php" class="text-white text-decoration-none">Category List</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card border-0 mb-4">
                <div class="card-body bg-blue">
                    <?php

                    ?>
                    <form action="category_edit.php" method="post">
                        <div class="mb-4">
                            <input type="hidden" name="id" value="<?php echo $catResult[0]['id']; ?>">
                            <label for="category" class="mb-2">Category Name</label>
                            <input type="text" id="category" name="category" class="form-control" value="<?php echo $catResult[0]['category_name']; ?>">
                            <small class="fw-bold text-danger"><?php echo (!empty($catErr))?"*$catErr":""; ?></small>
                        </div>
                        <button class="btn bg-button float-end">Update Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include "footer.php"; ?>