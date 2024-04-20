<?php include "main.php"; ?>

<main id="main" class="main">



    <div class="container-fluid">

        <div class="row align-items-center justify-content-center">
            <div class="card rounded col-lg-6 col-md-6" id="StudentProfile">
                <div class="pagetitle">
                    <h1>Student Profile</h1>
                </div>

                <div class="card-body">


                    <?php
                    $id = $_GET['id'];
                    $DataQuery = mysqli_query($conn, "SELECT * FROM registrationdata WHERE id = '$id'");
                    $row = mysqli_fetch_array($DataQuery);
                    $pic = $row['pic'];
                    ?>
                    <ul>
                        <div class="ProfileImg">
                            <?php
                            if($pic == null) {
                                ?>
                                <img src="../assets/profileimg/default.jpg" style="width:100px">
                                <?php
                            } else {
                                ?>
                                <img src="../assets/profileimg/<?php echo $row['pic']; ?>">
                                <?php
                            }
                            ?>
                        </div>
                        <li>
                            <label>First Name</label>
                            <h6>
                                <?php echo $row['name']; ?>
                            </h6>
                        </li>
                        <li>
                            <label>Middle Name</label>
                            <h6>
                                <?php echo $row['middlename']; ?>
                            </h6>
                        </li>
                        <li>
                            <label>Last Name</label>
                            <h6>
                                <?php echo $row['lastname']; ?>
                            </h6>
                        </li>
                        <li>
                            <label>Email</label>
                            <h6>
                                <?php echo $row['email']; ?>
                            </h6>
                        </li>
                        <li>
                            <label>Section</label>
                            <h6>
                                <?php echo $row['section']; ?>
                            </h6>
                        </li>
                    </ul>
                    <?php
                    ?>
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


<!-- Template Dashboard JS File -->
<script src="../assets/js/dashboard.js"></script>


</body>

</html>