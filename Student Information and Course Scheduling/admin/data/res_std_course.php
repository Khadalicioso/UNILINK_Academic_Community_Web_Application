<?php

// Function to get student's complete courses
function getStudentCompleteCourse($conn, $student_id)
{
    $sql = "SELECT COUNT(*) as complete_count FROM student_course 
            WHERE student_id=? AND completed=1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$student_id]);

    $result = $stmt->fetch();
    return $result['complete_count'];
}

// Function to get student's current courses
function getStudentCurrentCourse($conn, $student_id)
{
    $sql = "SELECT COUNT(*) as current_count FROM student_course 
            WHERE student_id=? AND completed=0";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$student_id]);

    $result = $stmt->fetch();
    return $result['current_count'];
}

// Function to get all courses for a student
function getStudentCourses($conn, $student_id)
{
    $sql = "SELECT sc.*, c.course_name, c.course_code 
            FROM student_course sc
            JOIN courses c ON sc.course_id = c.course_id
            WHERE sc.student_id=?
            ORDER BY sc.completed ASC, c.course_name ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$student_id]);

    return $stmt->fetchAll();
}
