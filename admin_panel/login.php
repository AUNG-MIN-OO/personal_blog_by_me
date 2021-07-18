<?php
    session_start();
    require "../config/config.php";

    if ($_POST){
        if (empty($_POST['email']) || empty($_POST['password'])){
            if (empty($_POST['email'])){
                $emailError = "Email is required";
            }
            if (empty($_POST['password'])){
                $pswError = "Password is required";
            }
        }else{
            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
            $stmt->execute(
                [':email'=>$email]
            );
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$user){
                $error = "Email or Password is wrong";
            }else{
                if ($user['email'] == $email && password_verify($password,$user['password'])){
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['logged_in'] = time();
                    header("location:index.php");
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
    <link rel="stylesheet" href="../vendor/summer_note/summernote.min.css">
    <link rel="stylesheet" href="../vendor/feather-icons-web/feather.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-5 p-0 p-md-5">
            <div class="card bg-blue p-4">
                <div class="text-center">
                    <h4 class="text-uppercase">Learn With Me</h4>
                    <br>
                    <h4>Log In</h4>
                    <hr>
                </div>
                <div class="card-body">
                    <form action="login.php" method="post">
                        <?php if (!empty($error)){ ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php } ?>
                        <div class="mb-4">
                            <label for="email" class="mb-2">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                            <small class="fw-bold text-danger"><?php echo (!empty($emailError))?"*$emailError":""; ?></small>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="mb-2">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                            <small class="fw-bold text-danger"><?php echo !empty($pswError)?"*$pswError":""; ?></small>
                        </div>
                        <button class="btn bg-button w-100 mb-4">Login</button>
                        <div class="text-center">
                            <h5>Sign in with</h5>
                            <div class="d-flex justify-content-center mb-4">
                                <i class="feather-facebook signup-icon"></i>
                                <i class="feather-instagram signup-icon"></i>
                                <i class="feather-twitter signup-icon"></i>
                            </div>
                            <p>
                                Not Yet Registered? Create account <a href="register.php">here</a>
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
</body>
</html>