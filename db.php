<?php


function lookupActivityByDate($date){

  $db_connection = new mysqli("stardock.cs.virginia.edu", "cs4720cw8df", "spring2014", "cs4720cw8df");
  if (mysqli_connect_errno()) {
      echo "Database Error";
  } else {
    //echo "Connection made";
  }

  $stmt = $db_connection->stmt_init();

  if($stmt->prepare("select Category, Start_time, End_time, Duration, Notes, Media_link from activities where Date_created = ?")) { //if this query looks ok
      $stmt->bind_param("s", $date);  //bind param to that query
      $stmt->execute();
      $stmt->bind_result($category, $start_time, $end_time, $duration, $notes, $media_link); //result of sql query comes back as a table
      while ($stmt->fetch()) { //auto populate the variable name with next available value
              echo "<h6>" . $category . " (". $duration . ")</h6>";
              echo "<p>" . $start_time . '-' . $end_time . '</p>';
              echo '<p>Notes: ' . $notes . '</p>';
              echo '<p>Link: ' . $media_link . '</p>';
              echo "<hr>";
      }
  }
}

function lookupCourse($courseNumber){
  $db_connection = new mysqli("stardock.cs.virginia.edu", "cs4720cw8df", "spring2014", "cs4720cw8df");
    if (mysqli_connect_errno()) {
        echo "Database Error";
    } else {
      //echo "Connection made";
    }
    $stmt = $db_connection->stmt_init();

    if($stmt->prepare("select courseNum, courseTitle, instructor, meetingTimes, meetingRoom, latestHWs from courses where courseNum = ?")) { //if this query looks ok
        $stmt->bind_param("s", $courseNumber);  //bind param to that query
        $stmt->execute();
        $stmt->bind_result($courseNum, $courseTitle, $instructor, $meetingTimes, $meetingRoom, $latestHWs); //result of sql query comes back as a table
        while ($stmt->fetch()) { //auto populate the variable name with next available value
                echo "<h6>" . $courseNum . ": " . $courseTitle . '</h6>';
                echo '<p><b>Instructor: </b>' . $instructor . '</p>';
                echo '<p><b>Meeting Times: </b>' . $meetingTimes . '</p>';
                echo '<p><b>Meeting Room: </b>' . $meetingRoom . '</p>';
                echo "<p><b>Next Due: </b>". $latestHWs . "</p>";
        }
    }

}

function updateHW($HW, $courseNumber){

    $db_connection = new mysqli("stardock.cs.virginia.edu", "cs4720cw8df", "spring2014", "cs4720cw8df");
    if (mysqli_connect_errno()) {
        echo "Database Error";
    } else {
      //echo "Connection made";
    }
    $stmt = $db_connection->stmt_init();

    if($stmt->prepare("update courses SET latestHWs = ? WHERE courseNum = ?")) { //if this query looks ok
        $stmt->bind_param("ss", $HW, $courseNumber);  //bind param to that query
        $stmt->execute();
        echo "Updated!";
    }

}

if(isset($_GET['dateToLookup'])) {
      $dateToLookup = $_GET["dateToLookup"];
      lookupActivityByDate($dateToLookup);
}

if(isset($_GET['courseNumber'])) {
      $courseNumToLookup = $_GET["courseNumber"];
      lookupCourse($courseNumToLookup);
}

if(isset($_GET['HW']) && isset($_GET['courseNumToUpdate'])) {

      $hw = $_GET["HW"];
      $courseNum = $_GET["courseNumToUpdate"];
      updateHW($hw, $courseNum);
}

?>
