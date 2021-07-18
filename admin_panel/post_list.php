<?php
session_start();
require "../config/config.php";
if (empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])){
    header("location:login.php");
}

$stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC ");
$stmt->execute();
$result = $stmt->fetchAll();
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
            <h3>Post Lists</h3>
        </div>
        <div class="mb-2">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="add_post.php" class="text-white text-decoration-none">Add Post</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Post List</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 mb-4">
                <div class="card-body bg-blue">
                    <table class="table table-hover text-white">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Creator</th>
                            <th>Actions</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        foreach($result as $post){
                            $desc = $post['description'];
                            $subDesc = substr($post['description'],0,100).'...';
                            $title = $post['title'];
                            $subTitle = substr($post['title'],0,20).'...';
                            $stmt = $pdo->prepare("SELECT * FROM users WHERE id=".$post['user_id']);
                            $stmt->execute();
                            $userResult = $stmt->fetch(PDO::FETCH_ASSOC);

                            $stmt = $pdo->prepare("SELECT * FROM categories WHERE id=:id");
                            $stmt->execute(
                                [':id'=>$post['category_id']]
                            );
                            $catResult = $stmt->fetchAll();
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo strlen($post['description'])<20?"$title":"$subTitle"; ?></td>
                                <td><?php echo strlen($post['description'])<100?"$desc":"$subDesc"; ?></td>
                                <td><?php echo $catResult[0]['category_name']; ?></td>
                                <td>
                                    <img src="assets/images/<?php echo $post['image']; ?>" style="width: 50px; height: 50px;background-size: cover" alt="">
                                </td>
                                <td class="text-nowrap"><?php echo $userResult['name']; ?></td>
                                <td class="text-nowrap">
                                    <a href="post_edit.php?id=<?php echo $post['id'];?>" class="btn btn-warning btn-sm"><i class="feather-edit-3"></i></a>
                                    <a href="post_delete.php?id=<?php echo $post['id'];?>" class="btn btn-danger btn-sm"><i class="feather-trash-2"></i></a>
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-button d-block mb-1"><?php echo date("g:i:A",strtotime($post['created_at'])); ?></span>
                                    <span class="badge rounded-pill bg-button d-block"><?php echo date("d-F-Y",strtotime($post['created_at'])); ?></span>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include "footer.php"; ?>