<?php
session_start();
require "../config/config.php";
if (empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])){
    header("location:login.php");
}

if ($_POST){
    if (empty($_POST['title']) || empty($_POST['description']) || empty($_FILES['image']) || empty($_POST['category'])){
        if (empty($_POST['title'])){
            $tErr = "Title is required";
        }
        if (empty($_POST['description'])){
            $dErr = "Description is required";
        }
        if (empty($_FILES['image'])){
            $imgErr = "Image is required";
        }
        if (empty($_POST['category'])){
            $catErr = "Category is required";
        }
    }else{
        $file = 'assets/images/'.($_FILES['image']['name']);
        $imgType = pathinfo($file,PATHINFO_EXTENSION);
        echo $imgType;
        if ($imgType != 'jpg' && $imgType != 'jpeg' && $imgType != 'png'){
//            echo "<script>alert('image must be png,jpg,jpeg');</script>";
            $imgErr = "Image must be JPG or JPEG or PNG";
        }elseif(!is_numeric($_POST['category'])){
            $catErr = "Category must be chosen";
        }else{
            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = $_FILES['image']['name'];
            $category_id = $_POST['category'];
            $user_id = $_SESSION['user_id'];

            move_uploaded_file($_FILES['image']['tmp_name'],$file);

            $stmt = $pdo->prepare("INSERT INTO posts(title,description,image,category_id,user_id) VALUES (:title,:description,:image,:category_id,:user_id)");
            $result = $stmt->execute(
                    array(':title'=>$title,':description'=>$description,':image'=>$image,':category_id'=>$category_id,':user_id'=>$user_id)
            );
            if ($result){
                $_SESSION['status'] = "New Post is added";
            }
        }
    }
}

$stmt = $pdo->prepare("SELECT * FROM categories");
$stmt->execute();
$catResult = $stmt->fetchAll();
?>
<?php include "header.php" ?>
<?php include "sidebar.php" ?>
<?php include "navbar.php" ?>

<?php
if (!empty($_SESSION['status'])){
    ?>
    <div aria-live="polite" aria-atomic="true" style="position: fixed;z-index: 2010;right: 10px;top: 20px;" >
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
            <h3>Create New Post</h3>
        </div>
        <div class="mb-2">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active" aria-current="page">Add Post</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="post_list.php" class="text-white text-decoration-none">Posts List</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card border-0 mb-4">
            <div class="card-body bg-blue">
                <form action="add_post.php" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="title" class="mb-2">Post Title</label>
                        <input type="text" id="title" name="title" class="form-control">
                        <small class="fw-bold text-danger"><?php echo (!empty($tErr))?"*$tErr":""; ?></small>
                    </div>
                    <div class="mb-4">
                        <label for="desc" class="mb-2">Description</label>
                        <textarea id="description" class="textarea w-100 p-2" name="description" rows="20" placeholder="Something else here"></textarea>
                        <small class="fw-bold text-danger"><?php echo (!empty($dErr))?"*$dErr":""; ?></small>
                    </div>
                    <div class="mb-4">
                        <label for="category" class="mb-2">Choose Category</label>
                        <select name="category" id="category" class="form-select">
                            <option value="" selected disabled>Select Categories</option>
                            <?php
                                foreach ($catResult as $cat){
                            ?>
                            <option value="<?php echo $cat['id']; ?>"><?php echo $cat['category_name']; ?></option>
                            <?php } ?>
                        </select>
                        <small class="fw-bold text-danger"><?php echo (!empty($catErr))?"*$catErr":""; ?></small>
                    </div>
                    <div class="mb-4">
                        <label for="img" class="mb-2">Choose Image</label>
                        <input type="file" id="img" name="image" class="form-control">
                        <small class="fw-bold text-danger"><?php echo (!empty($imgErr))?"*$imgErr":""; ?></small>
                    </div>
                    <button class="btn bg-button float-end">Create Now</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>