<?php
include "main.php";

$stmt = $conn->prepare("SELECT * FROM teacheraccount WHERE id= ?");
$stmt->bind_param("s", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_object($result);
$name = $row->name;
$middlename = $row->middlename;
$lastname = $row->lastname;
$pic = $row->pic;
$age = $row->age;
$id = $row->id;
$email = $row->email;
$password = $row->password;

if ($pic != null) {
  $profilepic = $row->pic;
} else {
  $profilepic = 'default.jpg';
}
?>



<main id="main" class="main">


  <section class="section profile">

    <?php
     #EDIT INFO SUCCESS
    if (isset ($_SESSION['picAlertTeacher'])) {
      ?>
      <div class="alert picAlert" role="alert">
        <span>
          <i class="bi bi-check-circle"></i>
          <h6>
            <?php
            echo $_SESSION['picAlertTeacher'];
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
      unset($_SESSION['picAlertTeacher']);
    }

   
    #ALERT RENAMED
    if (isset ($_SESSION['updateINFOTeacher'])) {
      ?>
      <div class="alert picAlert" role="alert">
        <span>
          <i class="bi bi-check-circle"></i>
          <h6>
            <?php
            echo $_SESSION['updateINFOTeacher'];
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
      unset($_SESSION['updateINFOTeacher']);
    }

    #ChANGE PASS SAVED
    if (isset ($_SESSION['changepass_successTeacher'])) {
      ?>
      <div class="alert picAlert" role="alert">
        <span>
          <i class="bi bi-check-circle"></i>
          <h6>
            <?php
            echo $_SESSION['changepass_successTeacher'];
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
      unset($_SESSION['changepass_successTeacher']);
    }

    ?>

    <div class="row align-items-center justify-content-center">


      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">



              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                  Profile</button>
              </li>


              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                  Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">
              <?php
              if (isset ($_SESSION['empty_passTeacher'])) {
                $active = "";
                ?>
                <div class="tab-pane <?php echo $active; ?> profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->

                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="../assets/profileimg/<?php echo $profilepic; ?>" alt="Profile">
                      <div class="pt-2">
                        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image" data-bs-toggle="modal"
                          data-bs-target="#uploadphoto" id="uploadPicBtn"><i class="bi bi-upload"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image" data-bs-toggle="modal"
                          data-bs-target="#deletephoto"><i class="bi bi-trash"></i></a>
                      </div>
                    </div>
                  </div>

                  <?php
                  if (isset ($_SESSION['picAlertErrorTeacher'])) {
                    ?>
                    <div class="row mb-3">
                      <label class="col-md-4 col-lg-3 col-form-label"></label>
                      <div class="col-md-8 col-lg-9">
                        <div class="">
                          <p class="text-danger">
                            <?php echo $_SESSION['picAlertErrorTeacher']; ?>
                          </p>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                  unset($_SESSION['picAlertErrorTeacher']);
                  ?>


                  <form action="../assets/controller/process.php" method="POST">
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="fullName" value="<?php echo $name; ?>">
                      </div>
                    </div>



                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="middlename" type="text" class="form-control" id="company"
                          value="<?php echo $middlename; ?>">
                      </div>
                    </div>



                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastname" type="text" class="form-control" id="Address"
                          value="<?php echo $lastname; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Age</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="age" type="text" class="form-control" id="Phone" value="<?php echo $age; ?>">
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Phone" value="<?php echo $email; ?>">
                        <?php if (isset ($_SESSION['email_inuseTeacher'])) {
                          ?>
                          <p class="text-danger">
                            <?php echo $_SESSION['email_inuseTeacher']; ?>
                          </p>
                          <?php
                          unset($_SESSION['email_inuseTeacher']);
                        } ?>
                      </div>

                    </div>





                    <div class="text-center">
                      <button type="submit" name="saveChangesTeacher" id="saveChanges" class="btn btn-primary">Save
                        Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>
                <?php
              } else {
                $active = "active show";
                ?>
                <div class="tab-pane <?php echo $active; ?> profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->

                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="../assets/profileimg/<?php echo $profilepic; ?>" alt="Profile">
                      <div class="pt-2">
                        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image" data-bs-toggle="modal"
                          data-bs-target="#uploadphoto" id="uploadPicBtn"><i class="bi bi-upload"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image" data-bs-toggle="modal"
                          data-bs-target="#deletephoto"><i class="bi bi-trash"></i></a>
                      </div>
                    </div>
                  </div>

                  <?php
                  if (isset ($_SESSION['picAlertErrorTeacher'])) {
                    ?>
                    <div class="row mb-3">
                      <label class="col-md-4 col-lg-3 col-form-label"></label>
                      <div class="col-md-8 col-lg-9">
                        <div class="">
                          <p class="text-danger">
                            <?php echo $_SESSION['picAlertErrorTeacher']; ?>
                          </p>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                  unset($_SESSION['picAlertErrorTeacher']);
                  ?>


                  <form action="../assets/controller/process.php" method="POST">
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="fullName" value="<?php echo $name; ?>">
                      </div>
                    </div>



                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="middlename" type="text" class="form-control" id="company"
                          value="<?php echo $middlename; ?>">
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastname" type="text" class="form-control" id="Address"
                          value="<?php echo $lastname; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Age</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="age" type="text" class="form-control" id="Phone" value="<?php echo $age; ?>">
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Phone" value="<?php echo $email; ?>">
                        <?php if (isset ($_SESSION['email_inuseTeacher'])) {
                          ?>
                          <p class="text-danger">
                            <?php echo $_SESSION['email_inuseTeacher']; ?>
                          </p>
                          <?php
                          unset($_SESSION['email_inuseTeacher']);
                        } ?>
                      </div>

                    </div>


                  
                    <input type="hidden" name="id" value="<?php echo $id; ?>">


                    <div class="text-center">
                      <button type="submit" name="saveChangesTeacher" id="saveChanges" class="btn btn-primary">Save
                        Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>
                <?php

              }
              ?>

              <?php
              if (isset ($_SESSION['empty_passTeacher'])) {
                $active = "active show";
                ?>
                <div class="tab-pane fade pt-3 <?php echo $active; ?>" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="../assets/controller/process.php" method="POST">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <div id="currentPass">
                          <input type="password" value="<?php echo $password; ?>" class="form-control"
                            id="currentPassword" readonly>
                          <a href="#" id="showPass">
                            <i class="current_pass_fill bi bi-eye-fill"></i>
                            <i class="current_pass_slash bi bi-eye-slash-fill" id="showPass"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <div id="newPass">
                          <input name="newpassword" name="newPassword" type="password" class="form-control"
                            id="newPassword">
                          <a href="#">
                            <i class="newpass_fill bi bi bi-eye-fill" id="showNewPass"></i>
                            <i class="newpass_slash bi bi-eye-slash-fill" id="showNewPass"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <?php
                    #PASS EMPTY
                    if (isset ($_SESSION['empty_passTeacher'])) {
                      ?>
                      <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-8 col-lg-9">
                          <p class="text-danger">
                            <?php echo $_SESSION['empty_passTeacher']; ?>
                          </p>
                        </div>
                      </div>
                      <?php
                      unset($_SESSION['empty_passTeacher']);
                    }
                    ?>

                    <input type="hidden" name="id" value="<?php echo $id; ?>" />


                    <div class="text-center">
                      <button type="submit" name="changePassTeacher" id="changePass" class="btn btn-primary">Change
                        Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>
                <?php

              } else {
                $active = "";
                ?>
                <div class="tab-pane fade pt-3 <?php echo $active; ?>" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="../assets/controller/process.php" method="POST">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <div id="currentPass">
                          <input type="password" value="<?php echo $password; ?>" class="form-control"
                            id="currentPassword" readonly>
                          <a href="#">
                            <i class="current_pass_fill bi bi-eye-fill"></i>
                            <i class="current_pass_slash bi bi-eye-slash-fill" id="showPass"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <div id="newPass">
                          <input name="newpassword" name="newPassword" type="password" class="form-control"
                            id="newPassword">
                          <a href="#">
                            <i class="newpass_fill bi bi bi-eye-fill" id="showNewPass"></i>
                            <i class="newpass_slash bi bi-eye-slash-fill" id="showNewPass"></i>
                          </a>
                        </div>
                      </div>
                    </div>


                    <input type="hidden" name="id" value="<?php echo $id; ?>">


                    <div class="text-center">
                      <button type="submit" name="changePassTeacher" id="changePass" class="btn btn-primary">Change
                        Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>
                <?php
              }
              ?>
            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>

    <!-- MODAL CHANGE PHOTO-->
    <div class="modal fade" id="uploadphoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Upload a new photo</h5>

          </div>
          <form action="../assets/controller/process.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">

              <input type="file" name="newpic" class="form-control" required />
              <input type="hidden" name="id" value="<?php echo $id; ?>" />


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="uploadPicTeacher" class="btn-save">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- MODAL DELETE PHOTO-->
    <div class="modal fade" id="deletephoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

          <div class="modal-body">
            <h6>Are you sure you want to delete photo?</h6>
          </div>


          <div class="modal-footer">
            <form action="../assets/controller/process.php" method="POST" enctype="multipart/form-data">

              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="deletePhotoTeacher" class="btn btn-primary" id="btnDeletePic">Yes</button>
              <input type="hidden" name="id" value="<?php echo $id; ?>" />
              <input type="hidden" name="pic" value="<?php echo $pic; ?>" />
            </form>
          </div>

        </div>
      </div>
    </div>

  </section>

</main><!-- End #main -->


<!-- ======= Footer ======= -->
<?php include ('footer.php'); ?>
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>

<!-- Template Dashboard JS File -->
<script src="../assets/js/dashboard.js"></script>

<script src="../assets/js/student/profilepassword.js"></script>

</body>
</html>