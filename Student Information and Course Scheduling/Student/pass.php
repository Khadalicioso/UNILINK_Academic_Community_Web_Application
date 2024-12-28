<?php
session_start();
if (
  isset($_SESSION['student_id']) &&
  isset($_SESSION['role'])
) {

  if ($_SESSION['role'] == 'Student') {
?>
    <?php
    include "inc/header.php";
    ?>
    <style>
      .password-container {
        max-width: 500px;
        margin: 2rem auto;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        padding: 2rem;
      }

      .page-title {
        color: #1B0E60;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
      }

      .form-label {
        color: #1B0E60;
        font-weight: 500;
        font-size: 0.95rem;
      }

      .form-control {
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        padding: 0.6rem 1rem;
        transition: all 0.3s ease;
      }

      .form-control:focus {
        border-color: #1B0E60;
        box-shadow: 0 0 0 0.2rem rgba(27, 14, 96, 0.15);
      }

      .random-btn {
        background-color: #FF8C4C !important;
        border: none;
        color: white;
        padding: 0.6rem 1.2rem;
        transition: all 0.3s ease;
      }

      .random-btn:hover {
        background-color: #ff7a33 !important;
        transform: translateY(-1px);
      }

      .submit-btn {
        background-color: #1B0E60;
        border: none;
        color: white;
        padding: 0.6rem 2rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        font-weight: 500;
      }

      .submit-btn:hover {
        background-color: #2a1875;
        transform: translateY(-1px);
      }

      .alert {
        border-radius: 8px;
        border: none;
        padding: 1rem;
        margin-bottom: 1.5rem;
      }

      .input-group {
        position: relative;
      }

      hr {
        opacity: 0.1;
        margin: 1.5rem 0;
      }
    </style>

    <body>
      <?php
      include "inc/navbar.php";
      ?>
      <div class="container">
        <div class="password-container">
          <h2 class="page-title">
            <i class="fas fa-key"></i>
            Change Password
          </h2>

          <?php if (isset($_GET['perror'])) { ?>
            <div class="alert alert-danger" role="alert">
              <i class="fas fa-exclamation-circle me-2"></i>
              <?= $_GET['perror'] ?>
            </div>
          <?php } ?>
          <?php if (isset($_GET['psuccess'])) { ?>
            <div class="alert alert-success" role="alert">
              <i class="fas fa-check-circle me-2"></i>
              <?= $_GET['psuccess'] ?>
            </div>
          <?php } ?>

          <form method="post" action="req/student-change.php" id="change_password">
            <div class="mb-4">
              <label class="form-label">Old Password</label>
              <input type="password" class="form-control" name="old_pass" placeholder="Enter your current password">
            </div>

            <div class="mb-4">
              <label class="form-label">New Password</label>
              <div class="input-group">
                <input type="text" class="form-control" name="new_pass" id="passInput" placeholder="Enter new password">
                <button class="btn random-btn" id="gBtn">
                  <i class="fas fa-dice me-1"></i>Random
                </button>
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label">Confirm New Password</label>
              <input type="text" class="form-control" name="c_new_pass" id="passInput2" placeholder="Confirm new password">
            </div>

            <button type="submit" class="submit-btn">
              <i class="fas fa-save me-2"></i>Update Password
            </button>
          </form>
        </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
      <script>
        $(document).ready(function() {
          $("#navLinks li:nth-child(7) a").addClass('active');
        });

        function makePass(length) {
          var result = '';
          var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
          var charactersLength = characters.length;
          for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
          }
          var passInput = document.getElementById('passInput');
          var passInput2 = document.getElementById('passInput2');
          passInput.value = result;
          passInput2.value = result;
        }

        var gBtn = document.getElementById('gBtn');
        gBtn.addEventListener('click', function(e) {
          e.preventDefault();
          makePass(4);
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