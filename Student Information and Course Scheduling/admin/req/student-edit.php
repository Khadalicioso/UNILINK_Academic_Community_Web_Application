<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
        
if (isset($_POST['fname'])      &&
    isset($_POST['lname'])      &&
    isset($_POST['username'])   &&
    isset($_POST['student_id']) &&
    isset($_POST['address'])    &&
    isset($_POST['email_address']) &&
    isset($_POST['gender'])        &&
    isset($_POST['date_of_birth']) &&
    isset($_POST['section'])       &&
    isset($_POST['parent_fname'])  &&
    isset($_POST['parent_lname'])  &&
    isset($_POST['parent_phone_number']) &&
    isset($_POST['department']) &&
    isset($_POST['lrn']) &&
    isset($_POST['semester'])) {
    
    include '../../DB_connection.php';
    include "../data/student.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $section = $_POST['section'];
    $email_address = $_POST['email_address'];
    $date_of_birth = $_POST['date_of_birth'];
    $parent_fname = $_POST['parent_fname'];
    $parent_lname = $_POST['parent_lname'];
    $parent_phone_number = $_POST['parent_phone_number'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];
    $student_id = $_POST['student_id'];
    $lrn = $_POST['lrn'];
    
    $data = 'student_id='.$student_id;

    if (empty($fname)) {
        $em  = "First name is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($lname)) {
        $em  = "Last name is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($uname)) {
        $em  = "Username is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (!unameIsUnique($uname, $conn, $student_id)) {
        $em  = "Username is taken! try another";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($address)) {
        $em  = "Address is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em  = "Gender is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($email_address)) {
        $em  = "Email address is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em  = "Date of birth is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($parent_fname)) {
        $em  = "Parent first name is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($parent_lname)) {
        $em  = "Parent last name is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($parent_phone_number)) {
        $em  = "Parent phone number is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($section)) {
        $em  = "Section is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($department)) {
        $em  = "Department is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($semester)) {
        $em  = "Semester is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($lrn)) {
        $em  = "LRN is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (strlen($lrn) != 12 || !is_numeric($lrn)) {
        $em  = "LRN must be exactly 12 digits";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else {
        try {
            // Check if LRN is unique (excluding current student)
            $check_sql = "SELECT student_id FROM students WHERE lrn = ? AND student_id != ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->execute([$lrn, $student_id]);
            
            if ($check_stmt->rowCount() > 0) {
                $em = "This LRN is already assigned to another student";
                header("Location: ../student-edit.php?error=$em&$data");
                exit;
            }

            $sql = "UPDATE students SET
                    username = ?, fname=?, lname=?, 
                    section=?, address=?, gender=?, 
                    email_address=?, date_of_birth=?,
                    parent_fname=?, parent_lname=?,
                    parent_phone_number=?, department=?, 
                    semester=?, lrn=?
                    WHERE student_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$uname, $fname, $lname, $section, 
                          $address, $gender, $email_address, 
                          $date_of_birth, $parent_fname, 
                          $parent_lname, $parent_phone_number,
                          $department, $semester, $lrn,
                          $student_id]);
            $sm = "Successfully updated!";
            header("Location: ../student.php?success=$sm");
            exit;
        } catch (PDOException $e) {
            $em = "Error: " . $e->getMessage();
            header("Location: ../student-edit.php?error=$em&$data");
            exit;
        }
    }
    
  }else {
    $em = "All fields are required";
    header("Location: ../student.php?error=$em");
    exit;
  }

  }else {
    header("Location: ../../logout.php");
    exit;
  } 
}else {
    header("Location: ../../logout.php");
    exit;
} 
?>
