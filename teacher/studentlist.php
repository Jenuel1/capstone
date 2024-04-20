<?php
include "main.php";
?>

<main id="main" class="main">
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Registered Accounts</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="container-fluid">



    <div class="card" id="FoldersList">
  
      <div class="card-body">
        <div class="table-responsive">
          <table class="table teacher_table" id="docx-table" style="width:100%;">
            <thead class="table-primary">
              <tr>
                <th>Student No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Section</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $StudentData = mysqli_query($conn, "SELECT * FROM registrationdata");
              while ($StudentRow = mysqli_fetch_array($StudentData)) {
                ?>
                <tr>
                  <td>
                    <?php echo $StudentRow['student_id']; ?>
                  </td>
                  <td>
                    <?php echo $StudentRow['name']; ?>
                  </td>
                  <td>
                    <?php echo $StudentRow['lastname']; ?>
                  </td>
                  <td>
                    <?php echo $StudentRow['section']; ?>
                  </td>
                  <td>
                    <?php echo $StudentRow['email']; ?>
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



  </div>

</main><!-- End #main -->

<?php include ('footer.php'); ?><!--FOOTER-->


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>




<!-- Template Main JS File -->
<script src="../assets/js/dashboard.js"></script>
<!-- DataTable JS -->
<script src="../assets/datatables/js/dataTables.js"></script>
<script src="../assets/datatables/js/dataTables.bootstrap5.js"></script>
<script src="../assets/datatables/js/dataTables.responsive.js"></script>
<script src="../assets/datatables/js/responsive.bootstrap5.js"></script>
<script src="../assets/datatables/js/dataTables.dateTime.min.js"></script>
<!-- Custom JS -->
<script src="../assets/js/teacher/archivedatatable.js"></script>

</body>

</html>