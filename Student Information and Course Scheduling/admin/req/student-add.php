<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['fname']) &&
    isset($_POST['lname']) &&
    isset($_POST['username']) &&
    isset($_POST['pass']) &&
    isset($_POST['section']) &&
    isset($_POST['address']) &&
    isset($_POST['gender']) &&
    isset($_POST['email_address']) &&
    isset($_POST['date_of_birth']) &&
    isset($_POST['parent_fname']) &&
    isset($_POST['parent_lname']) &&
    isset($_POST['parent_phone_number']) &&
    isset($_POST['intake']) &&
    isset($_POST['department']) &&
    isset($_POST['semester']) &&
    isset($_POST['year']) &&
    isset($_POST['lrn'])) {
    
    include "../../DB_connection.php";
    include "../data/student.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];
    $pass = $_POST['pass'];
    $section = $_POST['section'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $email_address = $_POST['email_address'];
    $date_of_birth = $_POST['date_of_birth'];
    $parent_fname = $_POST['parent_fname'];
    $parent_lname = $_POST['parent_lname'];
    $parent_phone_number = $_POST['parent_phone_number'];
    $intake = $_POST['intake'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];
    $lrn = $_POST['lrn'];
    $year = $_POST['year'];

    $data = 'lrn='.$lrn.'&fname='.$fname.'&lname='.$lname.'&uname='.$uname.'&section='.$section.'&address='.$address.'&gender='.$gender.'&email='.$email_address.'&pfn='.$parent_fname.'&pln='.$parent_lname.'&ppn='.$parent_phone_number.'&year='.$year;

    if (empty($fname)) {
        $em  = "First name is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($lname)) {
        $em  = "Last name is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($uname)) {
        $em  = "Username is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (!unameIsUnique($uname, $conn)) {
        $em  = "Username is taken! try another";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($pass)) {
        $em  = "Password is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($section)) {
        $em  = "Section is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($address)) {
        $em  = "Address is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em  = "Gender is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($email_address)) {
        $em  = "Email address is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em  = "Date of birth is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($parent_fname)) {
        $em  = "Parent first name is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($parent_lname)) {
        $em  = "Parent last name is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($parent_phone_number)) {
        $em  = "Parent phone number is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($lrn)) {
        $em  = "LRN is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (strlen($lrn) != 12 || !is_numeric($lrn)) {
        $em  = "LRN must be exactly 12 digits";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($year)) {
        $em  = "Year is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else {
        // hashing the password
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql  = "INSERT INTO
                 students(username, password, fname, lname, section, address, gender, email_address, date_of_birth, parent_fname, parent_lname, parent_phone_number, intake, department, semester, year, lrn)
                 VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname, $pass, $fname, $lname, $section, $address, $gender, $email_address, $date_of_birth, $parent_fname, $parent_lname, $parent_phone_number, $intake, $department, $semester, $year, $lrn]);
        $sm = "New student registered successfully";
        header("Location: ../student.php?success=$sm");
        exit;
    }
    
}else {
    $em = "An error occurred";
    header("Location: ../student-add.php?error=$em");
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
