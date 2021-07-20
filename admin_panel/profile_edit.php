<?php
session_start();
require "../config/config.php";
if (empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])){
    header("location:login.php");
}

if ($_POST){
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_FILES['image'])){
        if (empty($_POST['name'])){
            $nameErr = "Name is required";
        }
        if (empty($_POST['email'])){
            $emailErr = "Email is required";
        }
        if(!empty($_POST['newPassword'])){
            if (strlen($_POST['newPassword'])<8){
                $pswErr = "Password must be at least 8 characters";
            }
        }
        if (empty($_FILES['image'])){
            $imgErr = "Image is required";
        }

    }else{
//        print "<pre>";
//        print_r($_POST);
//        die();
        if($_FILES['image']['name'] != null){
            $file = 'assets/images/user/'.($_FILES['image']['name']);
            $imgType = pathinfo($file,PATHINFO_EXTENSION);
            if ($imgType != 'jpg' && $imgType != 'jpeg' && $imgType != 'png'){
//            echo "<script>alert('image must be png,jpg,jpeg');</script>";
                $imgErr = "Image must be JPG or JPEG or PNG";
            }else{
                $name = $_POST['name'];
                $email = $_POST['email'];
                $newPassword = $_POST['newPassword'];
                $usePassword = "";
                if (!empty($newPassword)){
                    $usePassword = $_POST['oldPassword'];
                }else{
                    $usePassword = $_POST['newPassword'];
                }
                $id = $_POST['id'];
                $image = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],$file);

                $stmt = $pdo->prepare("UPDATE users SET name ='$name',email='$email',image='$image',password='$usePassword' WHERE id='$id'");
                $result = $stmt->execute();

                if ($result){
                    $_SESSION['status'] = "Profile information is　updated";
                    header("location:my_profile.php");
                }
            }
        }else{
            $name = $_POST['name'];
            $email = $_POST['email'];
            $newPassword = $_POST['newPassword'];
            $usePassword = "";
            if (!empty($newPassword)){
                $usePassword = $_POST['oldPassword'];
            }else{
                $usePassword = $_POST['newPassword'];
            }
            $id = $_POST['id'];
            $stmt = $pdo->prepare("UPDATE users SET name=:name,email=:email,password=:password WHERE id=:id");
            $result = $stmt->execute(
                array(':name'=>$name,':email'=>$email,':password'=>$usePassword,':id'=>$id)
            );

            if ($result){
                $_SESSION['status'] = "Profile information is updated";
                header("location:my_profile.php");
            }
        }
    }
}
$id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id=:id");
$stmt->execute(
    [':id'=>$id]
);
$userResult = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php include "header.php" ?>
<?php include "sidebar.php" ?>
<?php include "navbar.php" ?>

    <div class="vh-100 bg-background p-3">
    <div class="title d-flex justify-content-between align-items-center">
        <div class="">
            <h3>Edit Profile</h3>
        </div>
        <div class="mb-2">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="index.php" class="text-white text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="my_profile.php" class="text-white text-decoration-none">Profile</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Profile Edit</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card border-0 mb-4">
                <div class="card-body bg-blue">
                    <form action="profile_edit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $userResult['id']; ?>">
                        <div class="mb-4">
                            <label for="name" class="mb-2">User Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo $userResult['name']; ?>" >
                            <small class="fw-bold text-danger"><?php echo (!empty($nameErr))?"*$nameErr":""; ?></small>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="mb-2">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $userResult['email']; ?>" >
                            <small class="fw-bold text-danger"><?php echo (!empty($emailErr))?"*$emailErr":""; ?></small>
                        </div>
                        <div class="mb-4">
                            <label for="desc" class="mb-2">Password</label>
                            <input type="hidden" name="oldPassword" value="<?php echo $userResult['password'] ?>">
                            <input type="text" name="newPassword" placeholder="type new password" class="form-control">
                            <small class="fw-bold text-danger"><?php echo (!empty($pswErr))?"*$pswErr":""; ?></small>
                        </div>
                        <div class="mb-4">
                            <img src="assets/images/<?php echo $userResult['image']; ?>" style="width: 100px; height: 150px;display: block" alt="">
                            <label for="img" class="mb-2">Choose New Image</label>
                            <input type="file" id="img" name="image" class="form-control">
                            <small class="fw-bold text-danger"><?php echo (!empty($imgErr))?"*$imgErr":""; ?></small>
                        </div>
                        <button class="btn bg-button float-end">Update Now</button>
                        <a href="my_profile.php" class="btn bg-warning float-end me-4">Go Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include "footer.php"; ?>