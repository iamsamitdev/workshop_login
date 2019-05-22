<?php
require 'config/connect.php';
if (empty($_SESSION['session_login'])) {
    // ส่งกลับไปหน้า login
    header('location:login.php');
}

// อัพเดท profile
$msg = "";
if (@$_POST['submit']) {

    $user_fullname      = $_POST['user_fullname'];
    $user_email           = $_POST['user_email'];
    $user_imgprofile    = $_FILES['user_imgprofile']['name'];

    // อัพโหลดไฟล์ด้วย php
    if (!empty($user_imgprofile)) {

        $inputname = "user_imgprofile";
        $filename = $_FILES['user_imgprofile']['name'];
        $filesize = $_FILES['user_imgprofile']['size'];
        $filetmp = $_FILES['user_imgprofile']['tmp_name'];
        $filetype = $_FILES['user_imgprofile']['type'];
        $maxfilesize = "6000000";
        $orgdirectory = "img/master"; // ภาพต้นฉบับ
        $thumbdirectory = "img/thumbnail"; // ภาพย่อ
        $thumbwidth = "300";
        $thumbheight = "300";
        genius_uploadimg(
            $inputname,
            $filename,
            $filesize,
            $filetmp,
            $filetype,
            $maxfilesize,
            $orgdirectory,
            $thumbdirectory,
            $thumbwidth,
            $thumbheight
        );

        //$upload_path = "img/";
        //copy($_FILES['user_imgprofile']['tmp_name'], $upload_path . $_FILES['user_imgprofile']['name']);
    }
}

$sql_profile = "SELECT * FROM users WHERE user_email='$_SESSION[session_login]'";
$result_profile = $connect->query($sql_profile);
$result_profile->execute();
$users_profile = $result_profile->fetch();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $users_profile['user_fullname']; ?> | Stock System</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include 'sidemenu.php'; ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php include 'topmenu.php'; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h3 class="mb-5">Edit Profile</h3>
                    <form method="post" action="profile.php" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="user_fullname" class="col-sm-2 col-form-label">Fullname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="user_fullname" id="user_fullname" value="<?php echo $users_profile['user_fullname']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="user_email" id="user_email" value="<?php echo $users_profile['user_email']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_imgprofile" class="col-sm-2 col-form-label">Pic Profile</label>
                            <div class="col-sm-10">
                                <input type="file" name="user_imgprofile" id="user_imgprofile">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php include 'footer.php'; ?>

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