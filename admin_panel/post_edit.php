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
        print_r($_POST);
        die();
    }else{
        if($_FILES['image']['name'] != null){
            $file = 'assets/images/'.($_FILES['image']['name']);
            $imgType = pathinfo($file,PATHINFO_EXTENSION);
            if ($imgType != 'jpg' && $imgType != 'jpeg' && $imgType != 'png'){
//            echo "<script>alert('image must be png,jpg,jpeg');</script>";
                $imgErr = "Image must be JPG or JPEG or PNG";
            }elseif(!is_numeric($_POST['category'])){
                $catErr = "Category must be chosen";
            }else{
                $title = $_POST['title'];
                $description = $_POST['description'];
                $category_id = $_POST['category'];
                $id = $_POST['id'];
                $image = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],$file);

                $stmt = $pdo->prepare("UPDATE posts SET title='$title',description='$description',image='$image',category_id='$category_id' WHERE id='$id'");
                $result = $stmt->execute();

                if ($result){
                    $_SESSION['status'] = "Post is updated";
                    header("location:post_list.php");
                }
            }
        }else{
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category_id = $_POST['category'];
            $id = $_POST['id'];
            $stmt = $pdo->prepare("UPDATE posts SET title=:title,description=:description,category_id=:category_id WHERE id=:id");
            $result = $stmt->execute(
                    array(':title'=>$title,':description'=>$description,':category_id'=>$category_id,':id'=>$id)
            );

            if ($result){
                $_SESSION['status'] = "Post is updated without photo";
                header("location:post_list.php");
            }
        }
    }
}
$id = isset($_GET['id']) ? $_GET['id'] : '';
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id=:id");
$stmt->execute(
    [':id'=>$id]
);
$postResult = $stmt->fetchAll();
?>
<?php include "header.php" ?>
<?php include "sidebar.php" ?>
<?php include "navbar.php" ?>

    <div class="vh-100 bg-background p-3">
    <div class="title d-flex justify-content-between align-items-center">
        <div class="">
            <h3>Edit Post</h3>
        </div>
        <div class="mb-2">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="add_post.php" class="text-white text-decoration-none">Add Post</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="post_list.php" class="text-white text-decoration-none">Post List</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card border-0 mb-4">
                <div class="card-body bg-blue">
                    <form action="post_edit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $postResult[0]['id']; ?>">
                        <div class="mb-4">
                            <label for="title" class="mb-2">Post Title</label>
                            <input type="text" id="title" name="title" class="form-control" value="<?php echo $postResult[0]['title']; ?>" >
                            <small class="fw-bold text-danger"><?php echo (!empty($tErr))?"*$tErr":""; ?></small>
                        </div>
                        <div class="mb-4">
                            <label for="desc" class="mb-2">Description</label>
                            <textarea id="description" class="textarea w-100 p-2" name="description" rows="20" placeholder="Something else here"><?php echo $postResult[0]['description']; ?></textarea>
                            <small class="fw-bold text-danger"><?php echo (!empty($dErr))?"*$dErr":""; ?></small>
                        </div>
                        <div class="mb-4">
                            <label for="category" class="mb-2">Choose Category</label>
                            <select name="category" id="category" class="form-select">
                                <?php
                                $stmt = $pdo->prepare("SELECT * FROM categories WHERE id=:id");
                                $stmt->execute([':id'=>$postResult[0]['category_id']]);
                                $catDetailResult = $stmt->fetchAll();
                                ?>
                                <?php
                                $stmt = $pdo->prepare("SELECT * FROM categories");
                                $stmt->execute();
                                $catResult = $stmt->fetchAll();
                                foreach ($catResult as $cat){
                                    ?>
                                    <option value="<?php echo $cat['id']; ?>" <?php echo $cat['id']==$postResult[0]['category_id'] ? 'selected' : '';?> ><?php echo $cat['category_name']; ?></option>
                                <?php } ?>
                            </select>
                            <small class="fw-bold text-danger"><?php echo (!empty($catErr))?"*$catErr":""; ?></small>
                        </div>
                        <div class="mb-4">
                            <img src="assets/images/<?php echo $postResult[0]['image']; ?>" style="width: 100px; height: 150px;display: block" alt="">
                            <label for="img" class="mb-2">Choose New Image</label>
                            <input type="file" id="img" name="image" class="form-control">
                            <small class="fw-bold text-danger"><?php echo (!empty($imgErr))?"*$imgErr":""; ?></small>
                        </div>
                        <button class="btn bg-button float-end">Update Now</button>
                        <a href="post_list.php" class="btn bg-warning float-end me-4">Go Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include "footer.php"; ?>