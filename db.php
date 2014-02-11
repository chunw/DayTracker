<?php
function lookupCourse($courseNumber){
  echo $courseNumber;

  $db_connection = new mysqli("stardock.cs.virginia.edu", "cs4720cw8df", "spring2014", "cs4720cw8df");
  //$db_connection = new mysqli("server", "username", "password", "database");
  if (mysqli_connect_errno()) {
      echo "Database Error";
  } else {
    //echo "Connection made";
  }
  $stmt = $db_connection->stmt_init();

  /*
  if($stmt->prepare("select courseID, deptID, courseNum from section1122 where courseNum = ?")) { //if this query looks ok
      $stmt->bind_param("s", $courseNumber);  //bind param to that query
      $stmt->execute();
      $stmt->bind_result($courseID, $deptID, $courseNum); //result of sql query comes back as a table
      while ($stmt->fetch()) { //auto populate the variable name with next available value
              echo "<tr><td>" . $courseID . "</td>";
              echo '<td>' . $deptID . '</td>';
              echo "<td>". $courseNum . "</td></tr>";
      }
  }
  */

  if($stmt->prepare("select * from courses where courseNum = ?")) { //if this query looks ok
      $stmt->bind_param("s", $courseNumber);  //bind param to that query
      echo $courseNumber;
      $stmt->execute();
      $stmt->bind_result($courseNum, $courseTitle, $instructor, $meetingTimes, $meetingRoom, $latestHWs); //result of sql query comes back as a table
      while ($stmt->fetch()) { //auto populate the variable name with next available value
              echo "<tr><td>" . $courseNum . "</td>";
              echo '<td>' . $courseTitle . '</td>';
              echo '<td>' . $instructor . '</td>';
              echo '<td>' . $meetingTimes . '</td>';
              echo '<td>' . $meetingRoom . '</td>';
              echo "<td>". $latestHWs . "</td></tr>";
      }
  }

}

$courseNumToLookup = $_GET["courseNumber"];

lookupCourse($courseNumToLookup);
?>
