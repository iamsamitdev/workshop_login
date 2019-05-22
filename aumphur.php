<?php
require 'config/connect.php';
if (empty($_SESSION['session_login'])) {
    // ส่งกลับไปหน้า login
    header('location:login.php');
}

// ส่วนของการแบ่งหน้า page
$pagelen = 10; // จำนวนรายการต่อ 1 หน้า

// ดึงหมายเลขหน้าจาก url
if (empty($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

// นับจำนวนแถวในตาราง
$sql_count = "SELECT amphur_id,province_id FROM tbl_amphures WHERE province_id = '$_GET[pid]'";
$result_count = $connect->query($sql_count);
$numrow = $result_count->rowCount();

// คำนวณหาจำนวนหน้าทั้งหมดที่สามารถแบ่งได้
$totalpage = ceil($numrow / $pagelen);

// คำนวนหารายการถัดไปของแต่ละหน้า
$goto = ($page - 1) * $pagelen;

$sql = "SELECT * FROM tbl_amphures 
            INNER JOIN tbl_provinces
            ON (tbl_amphures.province_id=tbl_provinces.province_id)
            WHERE tbl_amphures.province_id = '$_GET[pid]'
            ORDER BY tbl_amphures.amphur_id ASC
            LIMIT $goto,$pagelen";
$result = $connect->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aumphur | Stock System</title>

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
                    <h3 class="mb-4">Aumphur (<?php echo $numrow; ?>)</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr class="bg-primary text-light">
                                <th>#</th>
                                <th>Code</th>
                                <th>Name (TH)</th>
                                <th>Name (EN)</th>
                                <th>Geo ID</th>
                                <th>Province</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($rs = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $rs['amphur_id'] . "</td>";
                                echo "<td>" . $rs['amphur_code'] . "</td>";
                                echo "<td>" . $rs['amphur_name'] . "</td>";
                                echo "<td>" . $rs['amphur_name_eng'] . "</td>";
                                echo "<td>" . $rs['geo_id'] . "</td>";
                                echo "<td>" . $rs['province_name'] . "</td>";
                                echo "<td><a href='district.php?did=" . $rs['amphur_id'] . "' class='btn btn-warning'>View</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <nav aria-label="...">
                        <ul class="pagination">

                            <?php

                            if ($page > 1) {
                                $back = $page - 1;
                                echo "<li class='page-item'>";
                                echo "<a class='page-link' href='aumphur.php?page=$back&pid=$_GET[pid]' tabindex='-1' aria-disabled='true'>Previous</a>";
                                echo "</li>";
                            } else {
                                echo "<li class='page-item disabled'>";
                                echo "<a class='page-link' href='#' tabindex='-1' aria-disabled='true'>Previous</a>";
                                echo "</li>";
                            }

                            for ($a = 1; $a <= $totalpage; $a++) {
                                if ($page == $a) {
                                    echo "<li class='page-item active'><a class='page-link' href='aumphur.php?page=$a&pid=$_GET[pid]'>" . $a . "</a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='aumphur.php?page=$a&pid=$_GET[pid]'>" . $a . "</a></li>";
                                }
                            }

                            if ($page < $totalpage) {
                                $next = $page + 1;
                                echo "<li class='page-item'>";
                                echo "<a class='page-link' href='aumphur.php?page=$next&pid=$_GET[pid]'>Next</a>";
                                echo "</li>";
                            } else {
                                echo "<li class='page-item disabled'>";
                                echo "<a class='page-link' href='#'>Next</a>";
                                echo "</li>";
                            }
                            ?>

                        </ul>
                    </nav>

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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>