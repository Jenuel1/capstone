<?php
include "main.php";

?>

<main id="main" class="main">

    <div class="pagetitle">

        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="index.php">Home</a></li>
            </ol>
        </nav>



    </div><!-- End Page Title -->

    <div class="container-fluid" id="teacher-dashboard-index">

        <!-- ALERT -->
        <?php
        if (isset ($_SESSION['LoginMsg'])) {
            ?>
            <div class="container-fluid" id="alert-container">
                <div class="docupro">
                    <div class="title">
                        <h1> DocuPro </h1>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100">
                    </div>
                </div>
            </div>

            <div class="alert NewMsgSuccess" role="alert" style="display: none;">
                <span>
                    <i class="bi bi-check-circle"></i>
                    <h6>
                        <?php
                        echo $_SESSION['LoginMsg'];
                        ?>
                    </h6>
                    <button class="btn-close-alert" data-bs-dismiss="alert"><i class="bi bi-x-lg"></i></button>
                </span>
            </div>

            <script>
                var $progress = $('#alert-container');
                var $progressBar = $('.progress-bar');
                var $alert = $('.NewMsgSuccess');

                $progressBar.css('width', '10%');
                setTimeout(function () {
                    $progressBar.css('width', '100%');
                    setTimeout(function () {
                        $progress.css('display', 'none');
                        $alert.css('display', 'block');
                        setTimeout(function () {
                            $progress.css('display', 'none');
                            $alert.css('display', 'none');
                        }, 2000);
                    }, 500);
                }, 1500);

            </script>

            <?php
            unset($_SESSION['LoginMsg']);
        }
        ?>
        <!-- ALERT END -->

        <div class="row">


            <div class="col-xxl-4 col-md-6">
                <div class="card">
                    <a href="studentlist.php">
                        <div class="card-body" id="students-count">
                            <h5 class="card-title">Students</h5>
                            <div class="">
                                <?php
                                $selectstudentsquery = mysqli_query($conn, "SELECT * FROM registrationdata");
                                $checkstudentnum = mysqli_num_rows($selectstudentsquery);
                                ?>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?php echo $checkstudentnum; ?>
                                        </h6>
                                        <span class="text-primary small pt-1 fw-bold">
                                            <?php echo "<p>Total of Students</p>"; ?>
                                        </span>
                                    </div>
                                </div>

                                <?php

                                ?>
                            </div>

                        </div>
                    </a>
                </div>
            </div>


            <div class="col-xxl-4 col-md-6">
                <div class="card">
                    <a href="documents.php">
                        <div class="card-body" id="documents-count">
                            <h5 class="card-title">Documents</h5>
                            <?php
                            $selectdocsquery = mysqli_query($conn, "SELECT * FROM docusubmission WHERE archive = FALSE");
                            $checkdocsnum = mysqli_num_rows($selectdocsquery);
                            ?>
                            <div class="d-flex align-items-center">

                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-file-text"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>
                                        <?php echo $checkdocsnum; ?>
                                    </h6>
                                    <span class="text-danger small pt-1 fw-bold">
                                        <?php echo "<p>Total of Documents</p>"; ?>
                                    </span>
                                </div>
                            </div>
                            <?php

                            ?>
                        </div>
                    </a>
                </div>
            </div>

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
<script src="script.js"></script>


<!-- Template Dashboard JS File -->
<script src="../assets/js/dashboard.js"></script>

</body>

</html>