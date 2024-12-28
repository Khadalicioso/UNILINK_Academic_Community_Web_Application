<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
  if ($_SESSION['role'] == 'Admin') {
    include "../DB_connection.php";
    include "data/student.php";
    $students = getAllStudents($conn);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Student Records</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
      <?php include "inc/header.php"; ?>
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

        /* Alternating row colors */
        .table tbody tr:nth-child(even) td {
          background-color: #fafafa;
        }

        .table tbody tr:nth-child(even):hover td {
          background-color: #f0f7ff;
        }

        /* Excel-like header */
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
        <div class="container mt-5">
          <div class="student-container">
            <div class="student-header">
              <h3 class="student-title">
                <i class="fas fa-user-graduate me-2"></i>
                Student Management
              </h3>
              <div class="d-flex gap-2">
                <input type="text"
                  class="form-control"
                  id="searchInput"
                  placeholder="Search by name or LRN...">
                <a href="student-add.php" class="btn btn-add-student">
                  <i class="fas fa-plus"></i> Add Student
                </a>
              </div>
            </div>

            <div class="table-responsive mt-4">
              <table class="table student-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>LRN</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Strand</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($students as $student) {
                    // Ensure LRN is properly formatted to 12 digits
                    $lrn = !empty($student['lrn']) ? $student['lrn'] : str_pad($student['student_id'], 12, '0', STR_PAD_LEFT);
                  ?>
                    <tr>
                      <td><?= $i ?></td>
                      <td><?= htmlspecialchars($lrn) ?></td>
                      <td><?= htmlspecialchars($student['fname']) ?></td>
                      <td><?= htmlspecialchars($student['lname']) ?></td>
                      <td><?= htmlspecialchars($student['username']) ?></td>
                      <td><?= htmlspecialchars($student['department']) ?></td>
                      <td>
                        <div class="action-buttons">
                          <a href="student-edit.php?student_id=<?= $student['student_id'] ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href="student-delete.php?id=<?= $student['student_id'] ?>" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                  <?php
                    $i++;
                  }
                } else { ?>
                  <tr>
                    <td colspan="8" class="text-center">No students found</td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <script>
          document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('.student-table tbody tr');

            rows.forEach(row => {
              const lrn = row.cells[1].textContent.toLowerCase();
              const fname = row.cells[2].textContent.toLowerCase();
              const lname = row.cells[3].textContent.toLowerCase();
              const username = row.cells[4].textContent.toLowerCase();

              if (lrn.includes(searchValue) ||
                fname.includes(searchValue) ||
                lname.includes(searchValue) ||
                username.includes(searchValue)) {
                row.style.display = '';
              } else {
                row.style.display = 'none';
              }
            });
          });
        </script>
    </body>

    </html>
<?php
  } else {
    header("Location: ../login.php");
    exit;
  }
} else {
  header("Location: ../login.php");
  exit;
}
?>