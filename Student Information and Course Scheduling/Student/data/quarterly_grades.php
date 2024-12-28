<?php

// Function to add or update a quarterly grade
function addQuarterlyGrade($conn, $student_id, $course_name, $first_quarter, $second_quarter, $overall, $remarks, $academic_year) {
    // Check if grade already exists
    $sql = "SELECT * FROM quarterly_grades 
            WHERE student_id = ? AND course_name = ? AND academic_year = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$student_id, $course_name, $academic_year]);
    
    if ($stmt->rowCount() > 0) {
        // Update existing grade
        $sql = "UPDATE quarterly_grades 
                SET first_quarter = ?, 
                    second_quarter = ?, 
                    overall = ?, 
                    remarks = ? 
                WHERE student_id = ? 
                AND course_name = ? 
                AND academic_year = ?";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $first_quarter, 
            $second_quarter, 
            $overall, 
            $remarks, 
            $student_id, 
            $course_name,  
            $academic_year
        ]);
    } else {
        // Insert new grade
        $sql = "INSERT INTO quarterly_grades 
                (student_id, course_name, first_quarter, second_quarter, overall, remarks, academic_year) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $student_id,
            $course_name,  
            $first_quarter, 
            $second_quarter, 
            $overall, 
            $remarks, 
            $academic_year
        ]);
    }
}

// Function to get all quarterly grades for a student
function getQuarterlyGrades($conn, $student_id, $academic_year) {
    $sql = "SELECT * FROM quarterly_grades 
            WHERE student_id = ? AND academic_year = ? 
            ORDER BY course_name";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$student_id, $academic_year]);
    
    if ($stmt->rowCount() >= 1) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return [];
    }
}

// Function to calculate GWA (General Weighted Average)
function calculateGWA($grades) {
    if (empty($grades)) {
        return 0;
    }
    
    $total = 0;
    $count = 0;
    
    foreach ($grades as $grade) {
        if (isset($grade['overall']) && is_numeric($grade['overall'])) {
            $total += $grade['overall'];
            $count++;
        }
    }
    
    return $count > 0 ? round($total / $count, 2) : 0;
}

// Function to delete a quarterly grade
function deleteQuarterlyGrade($conn, $student_id, $course_name, $academic_year) {
    $sql = "DELETE FROM quarterly_grades 
            WHERE student_id = ? 
            AND course_name = ? 
            AND academic_year = ?";
    
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$student_id, $course_name, $academic_year]);
}
