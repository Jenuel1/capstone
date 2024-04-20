<?php
include "main.php";
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">
                Archived
            </li>
        </ol>
    </nav>

    <div class="container-fluid">
        <?php
        #DELETE SCUCESS
        if (isset ($_SESSION['archive_delete'])) {
            ?>
            <div class="alert picAlert" role="alert">
                <span>
                    <i class="bi bi-check-circle"></i>
                    <h6>
                        <?php
                        echo $_SESSION['archive_delete'];
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
            unset($_SESSION['archive_delete']);
        }

        #FAILED TO CHANGE
        if (isset ($_SESSION['archive_error'])) {
            ?>
            <div class="alert picAlert" role="alert">
                <span>
                    <i class="bi bi-x-circle"></i>
                    <h6>
                        <?php
                        echo $_SESSION['archive_error'];
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
            unset($_SESSION['archive_error']);
        }
        ?>


        <!--ARCHIVE TABLE-->
        <div class="card" id="FoldersList">
            <div class="card-body">

                <div class="d-flex justify-content-end align-items-center px-2 mb-2 mt-2">
                    <div class="filter m-0 p-0">
                        <div id="subfolderdate">
                            <i class="bi bi-calendar3"></i>
                        </div>
                    </div>
                </div>

                <div class="selected-action d-flex align-items-center justify-content-between d-none">
                        <span id="count-checkbox-checked"></span>
                        <div class="d-flex flex-row gap-4">
                            <button type="button" class="text-primary" data-bs-toggle="modal"
                                data-bs-target="#restore_folders">Restore</button>
                            <button type="button" data-bs-toggle="modal"
                                data-bs-target="#delete_folders">Delete</button>
                        </div>
                    </div>

                <form action="../assets/controller/process.php" method="POST">
                    <div id="result">
                        <div class="table-responsive">
                            <table id="docx-table" class="table teacher_table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th id="first_col"><input type="checkbox" name="checkbox"
                                                class="form-check-input" id="select-all" /></th>
                                        <th>Foldername</th>
                                        <th>Team</th>
                                        <th>Date Created</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SelectSubFolderQuery = mysqli_query($conn, "SELECT * FROM subfolders WHERE archive = TRUE ");
                                    while ($FolderRow = mysqli_fetch_array($SelectSubFolderQuery)) {
                                        $FolderName = $FolderRow['subfoldersname'];
                                        $FolderCategory = $FolderRow['category'];
                                        $Team = $FolderRow['team'];
                                     
                                        ?>
                                        
                                        <tr>
                                            <td class="d-flex"><input type="checkbox" name="checkbox[]"
                                                    value="<?php echo $FolderRow['id']; ?>" class="form-check-input">
                                            </td>
                                            <td>
                                                <div class="folderIcon">
                                                    <a
                                                        href="subfolderfiles.php?foldername=<?php echo $FolderCategory; ?>&subfolder=<?php echo $FolderName; ?>">
                                                        <i class="fs-5 bi bi-folder-fill"></i>
                                                        <span>
                                                            <?php echo $FolderName; ?>
                                                        </span>
                                                    </a>
                                                </div>
                                            </td>
                                            <td><?php echo $Team; ?></td>

                                            <td>
                                                <?php echo date('d M, Y', strtotime($FolderRow['date_created'])); ?>
                                            </td>
                                            <td>
                                                <?php echo $FolderCategory; ?>
                                            </td>
                                        </tr>
                                        <?php
                                        
                                        ?>
                                        <!-- Modal DELETE -->
                                        <div class="modal" id="delete_folders" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Deleting Files</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="archive_delete"
                                                            class="btn btn-primary">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                         <!-- Modal RESTORE-->
                                         <div class="modal" id="restore_folders" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Unarchived</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div> 
                                                    <div class="modal-body">
                                                        You want to restore this files?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="archive_restore"
                                                            class="btn btn-primary">Yes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <?php

                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--end-->

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

<!-- CHECKBOX -->
<script src="../assets/js/teacher/subfolderscheckbox.js"></script>

<!-- DataTable JS -->
<script src="../assets/datatables/js/dataTables.js"></script>
<script src="../assets/datatables/js/dataTables.bootstrap5.js"></script>
<script src="../assets/datatables/js/dataTables.responsive.js"></script>
<script src="../assets/datatables/js/responsive.bootstrap5.js"></script>
<script src="../assets/datatables/js/dataTables.dateTime.min.js"></script>
<!-- Custom JS -->
<script src="../assets/js/teacher/archivedatatable.js"></script>

<!--DATE RANGE JS -->
<script src="../assets/daterangepicker/moment.min.js"></script>
<script src="../assets/daterangepicker/daterangepicker.min.js"></script>
<script src="../assets/js/teacher/archivedate.js"></script>

</body>
</html>