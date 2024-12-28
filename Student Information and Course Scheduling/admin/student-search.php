<?php
session_start();
if (
  isset($_SESSION['admin_id']) &&
  isset($_SESSION['role'])
) {

  if ($_SESSION['role'] == 'Admin') {
    if (isset($_GET['searchKey'])) {

      $search_key = $_GET['searchKey'];
      include "../DB_connection.php";
      include "data/student.php";
      $students = searchStudents($search_key, $conn);
?>
      <?php
      include "req/header.php";
      ?>
      <style>
        /* Excel-like styles */
        .card {
          border: none;
          box-shadow: none;
        }

        .table-container {
          border: 1px solid #d4d4d4;
          border-radius: 4px;
          overflow: hidden;
        }

        .table {
          margin-bottom: 0;
          background: white;
          border-collapse: collapse;
        }

        .table thead th {
          background: #f8f9fa;
          color: #1B0E60;
          font-weight: 600;
          border: 1px solid #d4d4d4;
          padding: 12px;
          position: sticky;
          top: 0;
          z-index: 1;
          white-space: nowrap;
        }

        .table tbody td {
          padding: 8px 12px;
          border: 1px solid #d4d4d4;
          vertical-align: middle;
          background: white;
        }

        .table tbody tr:hover td {
          background-color: #f0f7ff;
        }

        .table tbody tr:nth-child(even) td {
          background-color: #fafafa;
        }

        .table tbody tr:nth-child(even):hover td {
          background-color: #f0f7ff;
        }

        .excel-header {
          background: #f8f9fa;
          border: 1px solid #d4d4d4;
          border-bottom: none;
          padding: 10px;
          display: flex;
          justify-content: space-between;
          align-items: center;
        }

        .btn-add {
          background-color: #1B0E60;
          color: white;
          border: none;
          padding: 8px 16px;
          border-radius: 4px;
        }

        .btn-add:hover {
          background-color: #150b4d;
          color: white;
        }

        .search-box {
          background: white;
          border: 1px solid #d4d4d4;
          border-radius: 4px;
          overflow: hidden;
        }

        .search-box input {
          border: none;
          padding: 8px 12px;
        }

        .search-box input:focus {
          outline: none;
          box-shadow: none;
        }

        .search-box button {
          background: #FF8C4C;
          border: none;
          color: white;
          padding: 8px 16px;
        }

        .search-box button:hover {
          background: #ff7a33;
        }

        .student-link {
          color: #0366d6;
          text-decoration: none;
        }

        .student-link:hover {
          text-decoration: underline;
          color: #0366d6;
        }

        .action-buttons .btn {
          padding: 4px 8px;
          font-size: 13px;
          margin: 0 2px;
        }

        .btn-warning {
          background: #FF8C4C;
          border: none;
          color: white;
        }

        .btn-warning:hover {
          background: #ff7a33;
          color: white;
        }

        .alert {
          margin-bottom: 16px;
          border-radius: 4px;
        }
      </style>

      <body>
        <?php
        include "inc/navbar.php";
        if ($students != 0) {
        ?>
          <div class="container mt-4">
            <div class="excel-header mb-3">
              <div class="d-flex align-items-center">
                <h5 class="mb-0 me-3">Search Results</h5>
                <a href="student-add.php" class="btn btn-add">
                  <i class="fa fa-plus me-1"></i>Add New Student
                </a>
              </div>
              <form action="student-search.php" method="get" class="d-flex" style="width: 300px;">
                <div class="input-group search-box">
                  <input type="text" class="form-control" name="searchKey" value="<?= $search_key ?>" placeholder="Search records...">
                  <button class="btn">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </form>
            </div>

            <div class="table-container">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>LRN</th>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Strand</th>
                      <th>Section</th>
                      <th>Guardian's Name</th>
                      <th>Guardian's Phone</th>
                      <th style="text-align: center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($students as $student) { ?>
                      <tr>
                        <td><?= $student['student_id'] ?></td>
                        <td>
                          <a href="student-view.php?student_id=<?= $student['student_id'] ?>" class="student-link">
                            <?= $student['fname'] . ' ' . $student['lname'] ?>
                          </a>
                        </td>
                        <td><?= $student['username'] ?></td>
                        <td><?= $student['department'] ?></td>
                        <td><?= $student['section'] ?></td>
                        <td><?= $student['parent_fname'] . ' ' . $student['parent_lname'] ?></td>
                        <td><?= $student['parent_phone_number'] ?></td>
                        <td style="text-align: center" class="action-buttons">
                          <a href="student-edit.php?student_id=<?= $student['student_id'] ?>" class="btn btn-warning">
                            <i class="fa fa-edit"></i>
                          </a>
                          <a href="student-delete.php?student_id=<?= $student['student_id'] ?>" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          <?php } else { ?>
            <div class="card mt-4">
              <div class="card-body text-center py-5">
                <i class="fa fa-search fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No Results Found</h5>
                <p class="mb-0">Try searching with different keywords.</p>
                <a href="student.php" class="btn btn-primary mt-3">Back to Student List</a>
              </div>
            </div>
          <?php } ?>
          </div>

          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
          <script>
            $(document).ready(function() {
              $("#navLinks li:nth-child(3) a").addClass('active');
            });
          </script>
      </body>

      </html>
<?php
    } else {
      header("Location: student.php");
      exit;
    }
  } else {
    header("Location: ../login.php");
    exit;
  }
} else {
  header("Location: ../login.php");
  exit;
}
?>