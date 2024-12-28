<?php
session_start();
if (
    isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])
) {

    if ($_SESSION['role'] == 'Admin') {
        
        if (
            isset($_POST['id']) &&
            isset($_POST['subject_code']) &&
            isset($_POST['subject_description']) &&
            isset($_POST['professor']) &&
            isset($_POST['schedule'])
        ) {
            
            include "../../DB_connection.php";

            $id = $_POST['id'];
            $subject_code = $_POST['subject_code'];
            $subject_description = $_POST['subject_description'];
            $professor = $_POST['professor'];
            $schedule = $_POST['schedule'];

            $data = 'id='.$id.'&subject_code='.$subject_code.'&subject_description='.$subject_description.'&professor='.$professor.'&schedule='.$schedule;

            if (empty($subject_code)) {
                $em  = "Subject code is required";
                header("Location: ../schedule-edit.php?error=$em&$data");
                exit;
            }else if (empty($subject_description)) {
                $em  = "Subject description is required";
                header("Location: ../schedule-edit.php?error=$em&$data");
                exit;
            }else if (empty($professor)) {
                $em  = "Professor name is required";
                header("Location: ../schedule-edit.php?error=$em&$data");
                exit;
            }else if (empty($schedule)) {
                $em  = "Schedule is required";
                header("Location: ../schedule-edit.php?error=$em&$data");
                exit;
            }else {
                // Update the schedule
                $sql = "UPDATE schedule SET 
                        subject_code=?, 
                        subject_description=?, 
                        professor=?, 
                        schedule=?
                        WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$subject_code, $subject_description, $professor, $schedule, $id]);
                $sm = "Schedule updated successfully";
                header("Location: ../schedule-edit.php?success=$sm&id=$id");
                exit;
            }
            
        }else {
            $em = "An error occurred";
            header("Location: ../schedule.php?error=$em");
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
