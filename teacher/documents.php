<?php
include 'main.php';

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="container-fluid" id="teacher-dashboard-documents">
        <div class="row">

            <div class="col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-body">

                        <div class="card-header d-flex justify-content-end">
                            <div class="filter">
                                <div id="reportrange">
                                    <i class="bi bi-calendar3"></i>
                                </div>
                            </div>
                        </div>

                        <div id="filtered-result">
                            <table id="docx-table" class="table table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>File</th>
                                        <th>Category</th>
                                        <th>Chapter</th>
                                        <th>Date Submitted</th>
                                        <th>Uploader</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM docusubmission WHERE archive = FALSE");
                                    while ($row = mysqli_fetch_array($query)) {
                                        $id = $row['student_id'];
                                        $category = $row['category'];
                                        $subfolder = $row['subfolder'];
                                        $select = mysqli_query($conn,"SELECT * FROM registrationdata WHERE student_id = '$id' ");
                                        $fetch_stud = mysqli_fetch_array($select);
                                        $uploader = $fetch_stud['name'] . " " . $fetch_stud['lastname'];


                                        $filePath = "../assets/uploads/$category/$subfolder/". $row['file'];
                                        $FileExt = explode('.', $row['file']);
                                        $fileExtension = strtolower(end($FileExt));


                                        if ($fileExtension == 'pdf') {
                                            $iconImage = 'pdf.png';
                                        } elseif ($fileExtension == 'docx') {
                                            $iconImage = 'doc.png';
                                        } elseif ($fileExtension == 'php') {
                                            $iconImage = 'php.png';
                                        } elseif ($fileExtension == 'js') {
                                            $iconImage = 'js.png';
                                        } elseif ($fileExtension == 'sql') {
                                            $iconImage = 'sql.png';
                                        } else {

                                            $iconImage = '';
                                        }

                                        ?>
                                        <tr>
                                            <td>
                                                <img src="../assets/img/icons/<?php echo $iconImage; ?>"
                                                    style="width:30px; height:30px;" alt="">
                                                <a href="<?php echo $filePath; ?>" target="_blank"><?php echo $row['file']; ?></a>
                                            </td>
                                            <td>
                                                <?php echo $row['category']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['chp']; ?>
                                            </td>
                                            <td>
                                                <?php echo date('Y-d-M', strtotime($row['date_submitted'])); ?>
                                            </td>
                                            <td class="text-capitalize">
                                                <?php echo $uploader; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div><!-- End Recent Activity -->


        </div>
    </div>


</main>
<!-- End #main -->
<!-- FOOTER -->
<?php include "footer.php"; ?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>

<!-- DataTable JS -->
<script src="../assets/datatables/js/jquery-3.7.1.js"></script>
<script src="../assets/datatables/js/dataTables.js"></script>
<script src="../assets/datatables/js/dataTables.bootstrap5.js"></script>
<script src="../assets/datatables/js/dataTables.responsive.js"></script>
<script src="../assets/datatables/js/responsive.bootstrap5.js"></script>

<!-- Custom JS -->
<script src="../assets/js/docxtable.js"></script>
<!-- Template Dashboard JS File -->
<script src="../assets/js/dashboard.js"></script>

<!--DATE RANGE JS -->
<script src="../assets/daterangepicker/moment.min.js"></script>
<script src="../assets/daterangepicker/daterangepicker.min.js"></script>

<script src="../assets/js/teacher/filterdocumentsdate.js"></script>
</body>
</html>