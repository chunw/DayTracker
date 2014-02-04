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
                    $duration = 0;
                    echo "<b>Category:</b> $category <br>";
                    echo "<b>Start time:</b> $start_time <br>";
                    echo "<b>End time:</b> $end_time <br>";
                    //TODO form field validation (check start time < end time)
                    $start_time = substr($start_time, 0, -2);
                    $end_time = substr($end_time, 0, -2);
                    $hour_diff = substr($end_time,0, -3)- substr($start_time,0, -3);
                    $minute_diff = substr($end_time, -2)- substr($start_time, -2);
                    echo "<b>Duration:</b> $hour_diff hours, $minute_diff mintues <br>";
                    echo "<b>Notes:</b> $notes <br>";
                    echo "<b>Media link:</b> $media_link <br>";
                  ?>
              </p>
            </div>
          </div>

      </section>
  </div>
</body>
</html>
