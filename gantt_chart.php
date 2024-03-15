<!--start of gantt chart generator file -->
<?php
// taking data from task_details form or index.html
// taking length of tasks or number of tasks
$task_length = $_POST['task_length'];
if ($task_length === null) {
  $task_length = 1;
}
// taking task_details through loop and storing them in arrays
for ($i = 1; $i <= $task_length; $i++) {
  $task_names[$i] = $_REQUEST["task_name$i"];
  $task_ids[$i] = $task_names[$i];
  $task_start[$i] = $_REQUEST["task_start_date$i"];
  $task_end[$i] = $_REQUEST["task_end_date$i"];
  $task_start_dates[$i] = date("Y,m,d", strtotime($task_start[$i]));
  $task_end_dates[$i] = date("Y,m,d", strtotime($task_end[$i]));
}
// end of loop
?>
<html>

<head>
  <!-- bootstrap cdn link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- google charts loader js link -->
  <script src="https://www.gstatic.com/charts/loader.js"></script>
<!-- js  -->
  <script>
    // loading google charts package
    google.charts.load("current", { packages: ["gantt"] });
    google.charts.setOnLoadCallback(drawChart);
// for calculating duration
    function toMilliseconds(minutes) {
      return minutes * 60 * 1000;
    }
// this method will contain data and show chart
    function drawChart() {
      var otherData = new google.visualization.DataTable();
      otherData.addColumn("string", "Task ID");
      otherData.addColumn("string", "Task Name");
      otherData.addColumn("string", "Resource");
      otherData.addColumn("date", "Start");
      otherData.addColumn("date", "End");
      otherData.addColumn("number", "Duration");
      otherData.addColumn("number", "Percent Complete");
      otherData.addColumn("string", "Dependencies");

      otherData.addRows([
        // printing loop 
        <?php
        for ($i = 1; $i <= $task_length; $i++) {
          echo '["' . $task_ids[$i] . '","' . $task_names[$i] . '",null,new Date("' . $task_start_dates[$i] . '"),new Date("' . $task_end_dates[$i] . '"),null,null,null ],';
        }
        ?>
      ]);
// options
      var options = {
        height: 275,
        gantt: {
          criticalPathEnabled: true,
          criticalPathStyle: {
            stroke: '#e64a19',
            strokeWidth: 5
          }
        }
      };
// chart will 
      var chart = new google.visualization.Gantt(
        document.getElementById("chart_div")
      );
      // method will draw chart.
      chart.draw(otherData, options);
    }
  </script>
</head>

<body>
  <!-- start of container -->
  <div class="container">
    <!-- start of heading -->
    <h1>Gantt Chart Generator</h1>
    <!-- charts will be print inside this div -->
    <div id="chart_div"></div>
  </div>
  <!-- end of container -->
  </body>
</html>
<!-- end of gantt chart generator file -->