<?php
require 'config/connect.php';
$msg = "";
if (@$_POST['submit']) {

    $data_user = array(
        ':user_id' => @$_GET['id']
    );

    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $result = $connect->prepare("UPDATE users SET user_password='$new_password'
                                                      WHERE  user_id=:user_id");
    if ($result->execute($data_user)) {
        $msg = "<div class='alert alert-success'>Reset รหัสผ่านใหม่แล้ว กรุณาเข้าระบบด้วยรหัสผ่านใหม่นี้</div>";
    } else {
        $msg = "<div class='alert alert-danger'>มีข้อผิดพลาดไม่สามารถ reset password ได้</div>";
    }
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset new password</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body>
    <div class="jumbotron">
        <h1 class="display-3">Reset password</h1>
    </div>

    <div class="container">
        <form action="reset_password.php?id=<?php echo $_GET['id']; ?>" method="post">
            <?php echo  $msg; ?>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">New password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <input type="submit" name="submit" class="btn btn-primary" value="Reset">
                </div>
            </div>
        </form>
    </div>

</body>

</html>