<?php
session_start();
if (
    isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])
) {

    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/schedule.php";

        $id = $_GET['id'];

        if (removeSchedule($conn, $id) != 0) {
            $sm = "Successfully deleted!";
            header("Location: schedule.php?success=$sm");
            exit;
        } else {
            $em = "An error occurred";
            header("Location: schedule.php?error=$em");
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
