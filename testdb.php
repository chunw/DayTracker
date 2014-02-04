<?php
function lookupCourse($courseNum){
  $db_connection = new mysqli("stardock.cs.virginia.edu", "cs4720cw8df", "spring2014", "cs4720cw8df");
  //$db_connection = new mysqli("server", "username", "password", "database");
  if (mysqli_connect_errno()) {
      echo "Error";
  } else {

    echo "Connection made";

  }
  $stmt = $db_connection->stmt_init();
  if($stmt->prepare("select courseID, deptID, courseNum from section1122 where courseNum = ?")) { //if this query looks ok
      $stmt->bind_param("s", $courseNum);  //bind param to that query
      $stmt->execute();
      $stmt->bind_result($courseID, $deptID, $courseNum); //result of sql query comes back as a table
      while ($stmt->fetch()) { //auto populate the variable name with next available value
              echo "<tr><td>" . $courseID . "</td>";
              echo '<td>' . $deptID . '</td>';
              echo "<td>". $courseNum . "</td></tr>";
      }
  }

}

lookupCourse('2150');
?>
