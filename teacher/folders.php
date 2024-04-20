<?php include "main.php"; ?>



<main id="main" class="main">

    <div class="container-fluid mb-5 mt-2">
        <div class="pagetitle">
            <h1>Files</h1>
        </div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Main Folder</li>
            </ol>
        </nav>
    </div>
    <!--ALERT MESSAGE-->
    <?php
    # ALERT ERROR
    if (isset ($_SESSION['FoldersAlertExst'])) {
        ?>
        <div class="alert picAlert" role="alert">
            <span>
                <i class="bi bi-x-circle"></i>
                <h6>
                    <?php
                    echo $_SESSION['FoldersAlertExst'];
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
        unset($_SESSION['FoldersAlertExst']);
    }
    # ALERT SUCCES
    if (isset ($_SESSION['FoldersAlertScs'])) {
        ?>
        <div class="alert picAlert" role="alert">
            <span>
                <i class="bi bi-check-circle"></i>
                <h6>
                    <?php
                    echo $_SESSION['FoldersAlertScs'];
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
        unset($_SESSION['FoldersAlertScs']);
    }

    #RENAME FOLDER SUCCESS
    if (isset ($_SESSION['rn_success'])) {
        ?>
        <div class="alert picAlert" role="alert">
            <span>
                <i class="bi bi-check-circle"></i>
                <h6>
                    <?php
                    echo $_SESSION['rn_success'];
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
        unset($_SESSION['rn_success']);
    }
    #RENAME FOLDER FAIL
    if (isset ($_SESSION['rn_fail'])) {
        ?>
        <div class="alert picAlert" role="alert">
            <span>
                <i class="bi bi-x-circle"></i>
                <h6>
                    <?php
                    echo $_SESSION['rn_fail'];
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
        unset($_SESSION['rn_fail']);
    }
    #RENAME FOLDER ALREADY IN USE
    if (isset ($_SESSION['rn_inuse'])) {
        ?>
        <div class="alert picAlert" role="alert">
            <span>
                <i class="bi bi-x-circle"></i>
                <h6>
                    <?php
                    echo $_SESSION['rn_inuse'];
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
        unset($_SESSION['rn_inuse']);
    }
    #DELETE FOLDER SUCCESS
    if (isset ($_SESSION['del_success'])) {
        ?>
        <div class="alert picAlert" role="alert">
            <span>
                <i class="bi bi-check-circle"></i>
                <h6>
                    <?php
                    echo $_SESSION['del_success'];
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
        unset($_SESSION['del_success']);
    }
    ?>
    <!--ALERT MESSAGE END-->

    <div class="container-fluid">
        <?php
        if (isset ($_SESSION['create_fillup'])) {
            ?>
            <div class="alert alert-danger d-flex align-items-center py-3 px-3 rounded mb-3">
                <p class="p-0 m-0">
                    <?php echo $_SESSION['create_fillup']; ?>
                </p>
            </div>
            <?php
        }
        unset($_SESSION['create_fillup']);
        ?>
        <div class="row">

            <!--CREATING NEW FOLDER-->
            <div class="col-lg-3 col-md-6" id="FolderCreate">
                <div class="card">
                    <a href="#" data-bs-target="#create_folder_category" data-bs-toggle="modal">
                        <div class="card-body">
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-folder-plus"></i>
                                <h6>Create New Folder</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Display folders -->
            <?php

            // READ DATA FOLDER
            $FoldersQuery = mysqli_query($conn, "SELECT * FROM rootfolder");
            while ($Folders = mysqli_fetch_array($FoldersQuery)) {
                $FolderCategory = $Folders['folder'];
                $folders_id = $Folders['id'];

                ?>
                <div class="col-lg-3 col-md-6">
                    <div class="card" id="folders">

                        <div class="card-body">
                            <div class="folderscategory">
                                <div class="d-flex justify-content-between align-items-center">
                                    <i class="bi bi-folder-fill"></i>
                                    <div class="dropstart">
                                        <a href="#" role="button" data-bs-toggle="dropdown"><i
                                                class="fs-5 text-dark bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#rn_<?php echo $folders_id; ?>">Rename</a></li>
                                
                                        </ul>
                                    </div>
                                </div>

                                <a href="subfolders.php?foldername=<?php echo urlencode($Folders['folder']); ?>">
                                    <h6>
                                        <?php echo $Folders['folder']; ?>
                                    </h6>
                                </a>
                                <p class="mb-1">
                                    <?php
                                    $SubFolder = mysqli_query($conn, "SELECT * FROM subfolders WHERE category = '$FolderCategory' AND archive = FALSE ");
                                    $CheckNums = mysqli_num_rows($SubFolder);
                                    if ($CheckNums > 1) {
                                        echo $CheckNums . " " . 'Files';
                                    } else {
                                        echo $CheckNums . " " . 'File';
                                    }
                                    ?>
                                </p>
                                <p class="mb-2 p-0">
                                    <?php echo "SY: "."".$Folders['schoolyear']; ?>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <!--MODAL RENAME-->
                <div class="modal" id="rn_<?php echo $folders_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" id="rename_root">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Rename Folder</h5>
                            </div>
                            <form action="../assets/controller/process.php" method="POST">
                                <div class="modal-body">
                                    <label>Enter a new folder name</label>
                                    <input type="text" class="form-control text-capitalize" name="rn" required>

                                    <input type="hidden" name="old_name" value="<?php echo $FolderCategory; ?>">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="btnclose"
                                        data-bs-dismiss="modal">Close</button>

                                    <button type="submit" class="btn btn-success" name="rename_root">Create</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>


                <!--MODAL DELETE-->
                <div class="modal" id="del_<?php echo $folders_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" id="delete_root">
                            <div class="modal-header">
                                <button type="button" class="fs-3 btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="../assets/controller/process.php" method="POST">
                                <div class="modal-body text-center">
                                    <p>Are you sure you want to delete this folder?</p>
                                    <p>Deleting this folder will also <span style="color: red;">permanently remove all its
                                            contents</span>.</p>
                                    <input type="hidden" name="id" value="<?php echo $folders_id; ?>">
                                    <input type="hidden" name="name" value="<?php echo $FolderCategory; ?>">

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" name="delete_root">Delete</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <?php
            }
            ?>


        </div>
    </div>

    <!--MODAL CREATE-->
    <div class="modal" id="create_folder_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Folder</h5>
                </div>
                <form action="../assets/controller/process.php" method="POST">
                    <div class="modal-body row">

                        <div class="col-lg-12">
                            <label class="fw-bold mb-1">Category Name</label>
                            <input type="text" class="form-control text-capitalize" placeholder="Enter Folder Name"
                                name="folderTitle" required></br>
                        </div>

                        <div class="col-lg-6">
                            <label class="fw-bold mb-1">School Year</label>
                            <input type="text" class="form-control" placeholder="0000-0000" name="schoolyear"
                                maxlength="9" required/></br>
                        </div>

                        <div class="col-lg-6">
                            <label class="fw-bold mb-1">Select Semester</label>
                            <select class="form-select" name="semester" aria-label="Default select example" required>
                                <option value="First Semester">First Semester</option>
                                <option value="Second Semester">Second Semester</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btnclose"
                            data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-success" name="btnCreateFolder">Create</button>
                    </div>
                </form>
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


<!-- Template Dashboard JS File -->
<script src="../assets/js/dashboard.js"></script>

</body>
</html>