<?php
require 'config/connect.php';
if (empty($_SESSION['session_login'])) {
    // ส่งกลับไปหน้า login
    header('location:login.php');
}

$sql = "SELECT * FROM tbl_districts";
$result = $connect->query($sql);
$numrow = $result->rowCount();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>All District | Stock System</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Datatable css-->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">

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
                    <h3 class="mb-4">District (<?php echo $numrow; ?>)</h3>
                    <table class="table table-striped" id="dataTable" width="100%">
                        <thead>
                            <tr class="bg-primary text-light">
                                <th>#</th>
                                <th>Code</th>
                                <th>Name (TH)</th>
                                <th>Name (EN)</th>
                                <th>Aumphur ID</th>
                                <th>Province ID</th>
                                <th>GEO ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($rs = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $rs['district_id'] . "</td>";
                                echo "<td>" . $rs['district_code'] . "</td>";
                                echo "<td>" . $rs['district_name'] . "</td>";
                                echo "<td>" . $rs['district_name_eng'] . "</td>";
                                echo "<td>" . $rs['amphur_id'] . "</td>";
                                echo "<td>" . $rs['province_id'] . "</td>";
                                echo "<td>" . $rs['geo_id'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>

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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Load Datatable to table-->
    <script>
        $(function() {
            $('#dataTable').DataTable();
        });
    </script>

</body>

</html>