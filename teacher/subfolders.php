<?php
include "main.php";
$category = $_GET['foldername'];

$select_sem = mysqli_query($conn, "SELECT * FROM rootfolder WHERE folder = '$category'");
$selecm_sem_row = mysqli_fetch_array($select_sem);
$SY = $selecm_sem_row['schoolyear'];
$sem = $selecm_sem_row['semester'];
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="folders.php">Main Folder</a></li>
            <li class="breadcrumb-item active">
                <?php echo $category; ?>
            </li>
            <h6 style="margin-left:15px;font-size:14px">
                <?php echo $SY . " " . $sem; ?>
            </h6>
        </ol>
    </nav>

    <div class="container-fluid">
        <?php
        #DELETE SCUCESS
        if (isset ($_SESSION['del_folder_success'])) {
            ?>
            <div class="alert picAlert" role="alert">
                <span>
                    <i class="bi bi-check-circle"></i>
                    <h6>
                        <?php
                        echo $_SESSION['del_folder_success'];
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
            unset($_SESSION['del_folder_success']);
        }
        ?>
        <!--SUBFOLDERS TABLE-->
        <div class="card" id="FoldersList">
            <div class="card-body">
                
                <div class="d-flex justify-content-end align-items-center px-2 mb-2 mt-2">
                    <div class="filter m-0 p-0">
                        <div id="subfolderdate">
                            <i class="bi bi-calendar3"></i>
                        </div>
                    </div>
                </div>

                <div class="selected-action d-flex justify-content-between align-items-center d-none">
                    <span id="count-checkbox-checked"></span>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#delete_folders">Delete</button>
                </div>
                <form action="../assets/controller/process.php" method="POST">



                    <div id="result">
                        <div class="table-responsive">
                            <table id="docx-table" class="table teacher_table" style="width:100%;">

                                <thead>
                                    <tr>
                                        <th id="first_col"><input type="checkbox" name="checkbox"
                                                class="form-check-input" id="select-all"></th>
                                        <th>Foldername</th>
                                        <th>Team</th>
                                        <th>Members</th>
                                        <th>Category</th>
                                        <th>Date Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $FolderCategory = $_GET['foldername'];
                                    $SelectSubFolderQuery = mysqli_query($conn, "SELECT * FROM subfolders WHERE category= '$FolderCategory' AND archive = FALSE");
                                    while ($FolderRow = mysqli_fetch_array($SelectSubFolderQuery)) {
                                        $FolderName = $FolderRow['subfoldersname'];
                                        $Team = $FolderRow['team'];
                                        $TeamMembers = $FolderRow['members'];
                                        $MembersArray = explode(',', $TeamMembers);
                                        ?>
                                        <tr>
                                            <td class="d-flex"><input type="checkbox" name="checkbox[]"
                                                    value="<?php echo $FolderRow['id']; ?>" class="form-check-input"></td>
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
                                            <td>
                                                <?php echo $Team; ?>
                                            </td>
                                            <td>
                                                <div class="avatar">
                                                    <?php
                                                    $TeamQuery = mysqli_query($conn, "SELECT * FROM registrationdata WHERE  id IN('" . implode("','", $MembersArray) . "')");
                                                    $checknum = mysqli_num_rows($TeamQuery);
                                                    while ($RowTeam = mysqli_fetch_array($TeamQuery)) {
                                                        $TeamsPic = $RowTeam['pic'];

                                                        ?>

                                                        <div class="avatar-sm">
                                                            <a href="studentprofile.php?id=<?php echo $RowTeam['id']; ?>">
                                                                <?php
                                                                if (!empty ($TeamsPic)) {
                                                                    ?>
                                                                    <img src="../assets/profileimg/<?php echo $TeamsPic; ?>" alt="">
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <img src="../assets/profileimg/default.jpg" alt="">
                                                                    <?php
                                                                }
                                                                ?>
                                                            </a>
                                                        </div>

                                                        <?php

                                                    }
                                                    ?>
                                                </div>

                                            </td>
                                            <td>
                                                <?php echo $FolderRow['category']; ?>
                                            </td>
                                            <td>
                                                <?php echo date('d M, Y', strtotime($FolderRow['date_created'])); ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>


                    <!-- Modal DELETE FOLDER -->
                    <div class="modal" id="delete_folders" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Deleting Files</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete?
                                    <input type="hidden" name="category" value="<?php echo $category; ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="delete_folders" class="btn btn-primary">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>


            </div>
        </div>
        <!--end-->

    </div>

<div id="category" data-category="<?php echo $category; ?>"></div>
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
<script src="../assets/datatables/js/jquery-3.7.1.js"></script>
<script src="../assets/datatables/js/dataTables.js"></script>
<script src="../assets/datatables/js/dataTables.bootstrap5.js"></script>
<script src="../assets/datatables/js/dataTables.responsive.js"></script>
<script src="../assets/datatables/js/responsive.bootstrap5.js"></script>
<script src="../assets/datatables/js/dataTables.dateTime.min.js"></script>
<!-- Custom JS -->
<script src="../assets/js/teacher/subfoldersdatatable.js"></script>

<!--DATE RANGE JS -->
<script src="../assets/daterangepicker/moment.min.js"></script>
<script src="../assets/daterangepicker/daterangepicker.min.js"></script>
<script src="../assets/js/teacher/subfoldersdate.js"></script>

</body>

</html>