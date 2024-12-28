<?php
session_start();
if (
    isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])
) {

    if ($_SESSION['role'] == 'Admin') {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject_code = $_POST['subject_code'];
            $subject_description = $_POST['subject_description'];
            $professor = $_POST['professor'];
            $schedule = $_POST['schedule'];
            $strand_id = !empty($_POST['strand_id']) ? $_POST['strand_id'] : null;

            include "../../DB_connection.php";

            try {
                $sql = "INSERT INTO schedule (subject_code, subject_description, professor, schedule, strand_id) 
                        VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$subject_code, $subject_description, $professor, $schedule, $strand_id]);

                $sm = "New schedule created successfully";
                header("Location: ../schedule.php?success=$sm");
                exit;
            } catch(PDOException $e) {
                $em = "Error adding schedule: " . $e->getMessage();
                header("Location: ../add_schedule.php?error=$em&subject_code=$subject_code&subject_description=$subject_description&professor=$professor&schedule=$schedule&strand_id=$strand_id");
                exit;
            }
        } else {
            header("Location: ../schedule.php");
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
