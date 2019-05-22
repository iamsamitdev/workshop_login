<?php
require 'config/connect.php';
include 'PHPMailers/PHPMailerAutoload.php';
$msg = "";
if (@$_POST['submit']) {

    $data_user = array(
        ':user_email' => $_POST['user_email']
    );
    $result = $connect->prepare("SELECT user_id,user_email 
                                                      FROM users 
                                                      WHERE  user_email=:user_email 
                                                      LIMIT 1");
    $result->execute($data_user);
    $users = $result->fetch();

    if ($result->rowCount()) {

        // Send Email to this account
        $base_url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"] . '?') . '/';
        $reset_link = "<a href=" . $base_url . "reset_password.php?id=" . $users['user_id'] . ">Click this link to reset password</a>";


        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;  // หากต้องการแสดงผลว่ามี error อะไรให้ใส่ 1 , 2 , 3 ตามต้องการ
        $mail->Debugoutput = 'html';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->CharSet = "UTF-8";
        $mail->Username = "samitkoyom@gmail.com";
        $mail->Password = "xxxx";

        $mail->setFrom('samitkoyom@gmail.com', 'Samit Koyom');
        $mail->addAddress($_POST['user_email'], "");

        $mail->Subject = "=?utf-8?B?" . base64_encode("แจ้งลิงก์เปลี่ยนรหัสผ่านจากระบบ Stock System") . "?=";
        $mail->msgHTML("ท่านสามารถคลิ๊กลิงก์ด้านล่าง เพื่อรีเซ็ตรหัสผ่านใหม่ได้<br>" . $reset_link);

        // Send email
        if ($mail->send()) {
            $msg = "<div class='alert alert-success'>ระบบส่งลิงก์ Reset รหัสผ่านไปให้ที่อีเมล์นี้แล้ว</div>";
        } else {
            $msg = "<div class='alert alert-danger'>มีข้อผิดพลาด ไม่สามารถส่งอีเมล์ได้</div>";
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    } else {
        $msg = "<div class='alert alert-danger'>ไม่พบอีเมล์นี้ในระบบ</div>";
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

    <title>Forgot Password - Stock System</title>

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
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <?php echo $msg; ?>
                                        <h1 class="h4 text-gray-900 mb-2">ลืมรหัสผ่านหรือเปล่า ?</h1>
                                        <p class="mb-4">ป้อนอีเมล์ที่ใช้สมัครสมาชิก แล้วระบบจะส่งลิงก์การ reset รหัสผ่านไปให้</p>
                                    </div>
                                    <form class="user" method="post" action="forgot-password.php">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="user_email" placeholder="Enter Email Address..." required>
                                        </div>
                                        <input type="submit" name="submit" value="Reset Password" class="btn btn-primary btn-user btn-block">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">สมัครสมาชิกใหม่!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">เป็นสมาชิกอยู่แล้ว ? เข้าสู่ระบบ!</a>
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