<?php
require 'config/connect.php';
$msg = "";
// Check Submit form
if (@$_POST['submit']) {
    $data_user = array(
        ':user_email' => $_POST['user_email']
    );

    $result = $connect->prepare("SELECT user_email,user_password 
                                                     FROM users 
                                                     WHERE  user_email=:user_email 
                                                     LIMIT 1");
    $result->execute($data_user);
    $users = $result->fetch();
    // Check email
    if ($result->rowCount()) {
        // Check password
        if (password_verify($_POST['user_password'], $users['user_password'])) {
            // เขียนตัวแปรแบบ Session ไว้เช็คข้อมูลหน้า backend
            $_SESSION['session_login'] = $_POST['user_email'];
            $msg = "<div class='alert alert-success'>เข้าระบบสำเร็จ กำลังไปหน้า dashboard</div>";
            echo "<meta http-equiv=\"refresh\" content=\"3;URL='dashboard.php'\">";
        } else {
            $msg = "<div class='alert alert-danger'>ข้อมูลเข้าระบบไม่ถูกต้อง ลองใหม่</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>ข้อมูลเข้าระบบไม่ถูกต้อง ลองใหม่</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - Stock System</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login </h1>
                                        <?php echo $msg; ?>
                                    </div>
                                    <form class="user" method="post" action="login.php">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="user_email" aria-describedby="emailHelp" placeholder="Enter Email Address..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="user_password" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Logint">

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>