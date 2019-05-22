<?php
require 'config/connect.php';
$msg = "";
// Check Submit form
if (@$_POST['submit']) {

    $data_user = array(
        ':user_fullname'   => $_POST['user_fullname'],
        ':user_email'        => $_POST['user_email'],
        ':user_password' => password_hash($_POST['user_password'], PASSWORD_DEFAULT),
        ':user_imgprofile' => 'nopic.png',
        ':user_role'          => 'user',
        ':user_created_at' => date('Y-m-d H:i:s'),
        ':user_status'      => '1'
    );

    $result = $connect->prepare("INSERT INTO 
                                                users(
                                                    user_fullname,
                                                    user_email,
                                                    user_password,
                                                    user_imgprofile,
                                                    user_role,
                                                    user_created_at,
                                                    user_status) 
                                                VALUES (
                                                    :user_fullname,
                                                    :user_email,
                                                    :user_password,
                                                    :user_imgprofile,
                                                    :user_role,
                                                    :user_created_at,
                                                    :user_status)");

    if ($result->execute($data_user)) {
        $msg = "<div class='alert alert-success'>Add new users success</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Add data fail!!!</div>";
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

    <title>Register - Stock System</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                <?php echo $msg; ?>
                            </div>
                            <form class="user" method="post" action="register.php">
                                <div class="form-group row">
                                    <input type="text" class="form-control form-control-user" name="user_fullname" placeholder="Fullname" required>
                                </div>
                                <div class="form-group row">
                                    <input type="email" class="form-control form-control-user" name="user_email" placeholder="Email Address" required>
                                </div>
                                <div class="form-group row">
                                    <input type="password" class="form-control form-control-user" name="user_password" placeholder="Password" required>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Register Account">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
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