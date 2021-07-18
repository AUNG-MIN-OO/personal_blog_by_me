<?php
    session_start();
    require "../config/config.php";

    if ($_POST){
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || strlen($_POST['password']) < 8){
            if (empty($_POST['name'])){
                $nameErr = "Name is required";
            }
            if (empty($_POST['email'])){
                $emailErr = "Email is required";
            }
            if (empty($_POST['password'])){
                $pswErr = "Password is required";
            }elseif (strlen($_POST['password']) < 8){
                $pswErr = "Password must be at least 8 characters";
            }
        }else{
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            $role = 1;
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
            $stmt->execute(
                    [':email'=>$email]
            );
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!empty($user)){
                $emailErr = "Email is already used";
            }else{
                $stmt = $pdo->prepare("INSERT INTO users(name,email,password,role) VALUES (:name,:email,:password,:role)");
                $result= $stmt->execute(
                        array(':name'=>$name,':email'=>$email,':password'=>$password,':role'=>$role)
                );
                if ($result){
                    $toast = "start";
                }
            }
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/animate_it/animate.css">
    <link rel="stylesheet" href="../vendor/summer_note/summernote.min.css">
    <link rel="stylesheet" href="../vendor/feather-icons-web/feather.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <?php
        if (!empty($toast)){
            ?>
            <div aria-live="polite" aria-atomic="true" style="position: fixed;z-index: 100;right: 10px;top: 0;" >
                <div class="toast animate__animated  animate__bounceInDown bg-button" role="alert" aria-atomic="true">
                    <div class="toast-header bg-blue text-white">
                        <strong class="me-auto">Registered successfully</strong>
                        <small>Just now!</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body text-white">
                        You can log in now.
                        Click <a href="login.php" class="text-white fw-bolder">Here</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <div class="row justify-content-center">
            <div class="col-12 col-xl-5 p-0 p-md-5">
                <div class="card bg-blue p-4">
                    <div class="text-center">
                        <h4 class="text-uppercase">Learn With Me</h4>
                        <br>
                        <h4>Register</h4>
                        <hr>
                    </div>
                    <div class="card-body">
                        <form action="register.php" method="post">
                            <div class="mb-4">
                                <label for="name" class="mb-2">User Name</label>
                                <input type="name" id="name" name="name" class="form-control">
                                <small class="fw-bold text-danger"><?php echo !empty($nameErr)?"$nameErr":""; ?></small>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="mb-2">Email</label>
                                <input type="email" id="email" name="email" class="form-control">
                                <small class="fw-bold text-danger"><?php echo !empty($emailErr)?"$emailErr":""; ?></small>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="mb-2">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                                <small class="fw-bold text-danger"><?php echo !empty($pswErr)?"$pswErr":""; ?></small>
                            </div>
                            <button class="btn bg-button w-100 mb-4">Register</button>
                            <div class="text-center">
                                <h5>Sign up with</h5>
                                <div class="d-flex justify-content-center mb-4">
                                    <i class="feather-facebook signup-icon"></i>
                                    <i class="feather-instagram signup-icon"></i>
                                    <i class="feather-twitter signup-icon"></i>
                                </div>
                                <p>
                                    Alerady Registered? Log in
                                    <a href="login.php">here</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="../vendor/jquery.min.js"></script>
<script src="../vendor/way_point/jquery.waypoints.min.js"></script>
<script src="../vendor/counter_up/counter_up.js"></script>
<script src="../vendor/chart_js/chart.min.js"></script>
<script src="../vendor/"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/summer_note/summernote.min.js"></script>
<script src="assets/js/main.js"></script>
<script>
    let option = {
        animation:true,
        delay:10000
    }
    let toastElList = [].slice.call(document.querySelectorAll('.toast'))
    let toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl, option).show();
    })
</script>
</body>
</html>