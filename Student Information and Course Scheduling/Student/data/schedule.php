<?php 

function getStudentSchedule($conn){
    $sql = "SELECT * FROM schedule";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
 
    if ($stmt->rowCount() >= 1) {
      $schedule = $stmt->fetchAll();
      return $schedule;
    }else {
     return 0;
    }
}

?>
