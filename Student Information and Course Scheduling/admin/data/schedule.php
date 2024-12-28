<?php

// Get all schedules
function getAllSchedules($conn)
{
    $sql = "SELECT * FROM schedule";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $schedules = $stmt->fetchAll();
        return $schedules;
    } else {
        return 0;
    }
}

// Get schedule by ID
function getScheduleById($conn, $id)
{
    $sql = "SELECT * FROM schedule WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() == 1) {
        $schedule = $stmt->fetch();
        return $schedule;
    } else {
        return 0;
    }
}

// Delete schedule
function removeSchedule($conn, $id)
{
    $sql = "DELETE FROM schedule WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    if ($stmt->rowCount() == 1) {
        return 1;
    } else {
        return 0;
    }
}
