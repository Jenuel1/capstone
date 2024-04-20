<?php
include "main.php";
$subfolder = $_GET['subfolder'];
$category = $_GET['foldername'];


$select_sem = mysqli_query($conn, "SELECT * FROM rootfolder WHERE folder = '$category'");
$selecm_sem_row = mysqli_fetch_array($select_sem);
$SY = $selecm_sem_row['schoolyear'];
$sem = $selecm_sem_row['semester'];
?>

<main id="main" class="main">

    <div class="pagetitle">
        <div class="pagetitle">
            <h1>Dashboard</h1>
        </div>
        <nav>
            <ol class="breadcrumb">

                <?php

                ?>
                <li class="breadcrumb-item"><a href="folders.php">Main Folder</a></li>
                <li class="breadcrumb-item"><a href="subfolders.php?foldername=<?php echo $category; ?>">
                        <?php echo $category; ?>
                    </a></li>
                <li class="breadcrumb-item active">
                    <?php echo $subfolder; ?>
                </li>
                <h6 style="margin-left:15px;font-size:14px">
                    <?php echo $SY . " " . $sem; ?>
                </h6>
                <?php
                ?>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="container-fluid" id="files">
        <?php
        #SUCCES UPDATE
        if (isset($_SESSION['status_updated'])) {
            ?>
            <div class="alert picAlert" role="alert">
                <span>
                    <i class="bi bi-check-circle"></i>
                    <h6>
                        <?php
                        echo $_SESSION['status_updated'];
                        ?>
                    </h6>
                    <button class="btn-close-alert" data-bs-dismiss="alert"><i class="bi bi-x-lg"></i></button>
                </span>
            </div>
            <script>
                var $alert = $('.picAlert');

                setTimeout(function () {
                    $alert.css('display', 'none');
                }, 2500);
            </script>
            <?php
            unset($_SESSION['status_updated']);
        }

        #FAIL UPDATE
        if (isset($_SESSION['failed_update_status'])) {
            ?>
            <div class="alert picAlert" role="alert">
                <span>
                    <i class="bi bi-x-circle"></i>
                    <h6>
                        <?php
                        echo $_SESSION['failed_update_status'];
                        ?>
                    </h6>
                    <button class="btn-close-alert" data-bs-dismiss="alert"><i class="bi bi-x-lg"></i></button>
                </span>
            </div>
            <script>
                var $alert = $('.picAlert');
                $alert.css('background-color', '#d9534f');
                $alert.css('border-color', '#d9534f');
                setTimeout(function () {
                    $alert.css('display', 'none');
                }, 2500);
            </script>
            <?php
            unset($_SESSION['failed_update_status']);
        }

        #IF EMPTY SELECT STATUS
        if (isset($_SESSION['status_fillup'])) {
            $mt = 'mt-0';
            $required = 'required';
            echo '<p class="text-danger">' . $_SESSION['status_fillup'] . '!</P>';
        } else {
            $mt = '';
            $required = '';
        }
        unset($_SESSION['status_fillup']);
        ?>
        <div class="status-container  <?php echo $mt; ?>">
        <div class="status">
            <?php
            $select_status = mysqli_query($conn, "SELECT * FROM subfolders WHERE category = '$category' AND subfoldersname = '$subfolder' ");
            $fetch_status = mysqli_fetch_array($select_status);
            $status = $fetch_status['status'];


            if ($status == 'Completed') {
                echo '
                <h5>Status:</h5>
                <div class="completed">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Completed</span>
                </div>';
            } else {
                echo '
                <h5>Status:</h5>
                <div class="not-completed">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>Not Completed</span>
                </div>';
            }
            ?>
        </div>

            <form action="../assets/controller/process.php" method="POST">
                <div class="status-change">
                    <input type="hidden" name="category" value="<?php echo $category; ?>">
                    <input type="hidden" name="subfolder" value="<?php echo $subfolder; ?>">
                    <select class="form-select " name="files_status">
                        <option value="">Select Status</option>
                        <option value="Not Complete">Not Complete</option>
                        <option value="Completed">Completed</option>
                    </select>
                    <button type="submit" name="status_submit">Ok</button>
                </div>
            </form>
        </div>



        <div class="row">
            <?php
            $query = $conn->prepare("SELECT * FROM docusubmission WHERE subfolder = ?");
            $query->bind_param("s", $subfolder);
            $query->execute();
            $result = $query->get_result();
            while ($row = $result->fetch_assoc()) {
                $filePath = "../assets/uploads/$category/$subfolder/" . $row['file'];
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
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <img src="../assets/img/icons/<?php echo $iconImage; ?>" style="width:60px; height:60px;">
                            <a href="<?php echo $filePath; ?>" target="_blank" data-text="<?php echo $row['filename']; ?>">
                                <?php echo $row['filename']; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>


    </div>


</main>
<!-- End #main -->

<!-- FOOTER -->
<?php include "footer.php"; ?>

<!--Back to top-->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>

<!-- Template Dashboard JS File -->
<script src="../assets/js/dashboard.js"></script>




</body>

</html>