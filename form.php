<html>
<head>
  <meta charset="UTF-8">
  <title>Activity added!</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
</head>
<body>
  <body class="inner">
  <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="brand" href="#">DayTracker </a>
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="http://plato.cs.virginia.edu/~cw8df/hw2/">Home</a></li>
            </ul>
          </div>
        </div>
      </div>
  </div>
 <!-- wrapper -->
  <div id="wrapper">
      <!-- sidebar -->
      <section id="sidebar">
      </section>
      <!-- main section -->
      <section class="main">
        <!-- container -->
          <div class="content-block" id="about">
            <?php
              $category = $_POST["category"];
              $start_time = $_POST["start_time"];
              $end_time = $_POST["end_time"];
              $notes = $_POST["note"];
              $media_link = $_POST["media"];
            ?>
            <div class="activity-confirmation">
              <h3>
                  Activity added.
              </h3>
              <p>
                  <?php
                    //TODO: parse current date
                    $date = "02/09/2014";

                    echo "<b>Category:</b> $category <br>";
                    echo "<b>Date:</b> $date <br>";
                    echo "<b>Start time:</b> $start_time <br>";
                    echo "<b>End time:</b> $end_time <br>";

                    //TODO form field validation (check start time < end time && end time != 12:00am)
                     $arr1 = explode(':', $start_time);
                     $start_hour = intval($arr1[0]);
                     $start_minute = intval($arr1[1]);

                     $arr2 = explode(':', $end_time);
                     $end_hour = intval($arr2[0]);
                     $end_minute = intval($arr2[1]);


                     if (substr($start_time, -2)=="am"){
                        if ($start_hour==12) {$start_hour = 0;}
                     } else {
                        if ($start_hour!=12) {$start_hour = $start_hour + 12;}
                     }

                     if (substr($end_time, -2)=="am"){
                        if ($end_hour==12) {$end_hour = 0;}
                     } else {
                        if ($end_hour!=12) {$end_hour = $end_hour + 12;}
                     }

                    $hour_diff = $end_hour - $start_hour;
                    $minute_diff = $end_minute - $start_minute ;

                    if ($minute_diff < 0) {
                      $hour_diff = $hour_diff -1;
                      $minute_diff = 60 + $minute_diff;
                    }
                    $duration = "$hour_diff hours, $minute_diff minutes";
                    echo "<b>Duration:</b> $duration <br>";
                    echo "<b>Notes:</b> $notes <br>";
                    echo "<b>Media link:</b> $media_link <br>";

                    //save data to db
                    $db_connection = new mysqli("stardock.cs.virginia.edu", "cs4720cw8df", "spring2014", "cs4720cw8df");

                    if (mysqli_connect_errno()) {
                        echo "Error connecting to database.";
                    } else {
                      $stmt = $db_connection->stmt_init();
                      if($stmt->prepare("INSERT INTO `activities` (Category, Date, Start_time, End_time, Duration, Notes, Media_link) values(?,?,?,?,?,?,?);")) {
                          $stmt->bind_param("s", $category, $date, $start_time, $end_time, $duration, $notes, $media_link);
                          $stmt->execute();
                          $inserts = $db_connection->affected_rows;
                          echo $inserts . " rows inserted!";
                      } else {
                          echo "<br><b style="color:red;"> Failed to save activity.</b>";
                      }
                    }
                  ?>
              </p>
            </div>
          </div>

      </section>
  </div>
</body>
</html>
