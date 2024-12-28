<?php
session_start();
if (
    isset($_SESSION['student_id']) &&
    isset($_SESSION['role']) &&
    $_SESSION['role'] == 'Student'
) {
    include "../../DB_connection.php";
    include "../data/student.php";

    $student_id = $_SESSION['student_id'];
    
    if (
        isset($_POST['email']) &&
        isset($_POST['phone_number']) &&
        isset($_POST['address']) &&
        isset($_POST['guardian_name']) &&
        isset($_POST['guardian_phone_number']) &&
        isset($_POST['guardian_address'])
    ) {
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $guardian_name = $_POST['guardian_name'];
        $guardian_phone_number = $_POST['guardian_phone_number'];
        $guardian_address = $_POST['guardian_address'];

        $sql = "UPDATE students SET 
                email = ?, 
                phone_number = ?,
                address = ?,
                guardian_name = ?,
                guardian_phone_number = ?,
                guardian_address = ?
                WHERE student_id = ?";
        
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([
            $email,
            $phone_number,
            $address,
            $guardian_name,
            $guardian_phone_number,
            $guardian_address,
            $student_id
        ]);

        if ($result) {
            $sm = "Profile successfully updated!";
            header("Location: ../student-profile.php?success=$sm");
            exit;
        } else {
            $em = "Unknown error occurred";
            header("Location: ../student-profile.php?error=$em");
            exit;
        }
    } else {
        $em = "All fields are required";
        header("Location: ../student-profile.php?error=$em");
        exit;
    }
} else {
    header("Location: ../../logout.php");
    exit;
}
