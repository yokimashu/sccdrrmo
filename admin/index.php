<?php

include('../config/db_config.php');
// $user_id = $_SESSION['id'];

// if (!isset($_SESSION['id'])) {
//     header('location:../index.php');
// } else {

// }

//select all pum
$get_all_individual_sql = "SELECT * FROM tbl_individual";
$get_all_individual_data = $con->prepare($get_all_individual_sql);
$get_all_individual_data->execute();

$get_all_juridical_sql = "SELECT * FROM tbl_juridical";
$get_all_juridical_data = $con->prepare($get_all_juridical_sql);
$get_all_juridical_data->execute();



$title = 'VAMOS | Dashboard';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">


  <?php include('heading.php'); ?>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header"></div>

      <div class="container-fluid">

        <div class="row">

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <a href="list_pum.php" class="info-box-icon bg-warning elevation-1"><span><i class="fa fa-male"></i></span></a>
              <div class="info-box-content">
                <span class="info-box-text">Individual</span>
                <span class="info-box-number">
                  <?php echo $get_all_individual_data->rowCount() ?>
                </span>
              </div>
            </div>
          </div> <!-- /.col-12 col-sm-6 col-md-3 -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <a class="info-box-icon bg-orange elevation-1" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><span><i class="fa fa-male"></i></span></a>
              <div class="info-box-content">
                <span class="info-box-text">Juridical</span>
                <span class="info-box-number">
                <?php echo $get_all_juridical_data->rowCount() ?>
                </span>
              </div>
            </div>
</div>

            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <a class="info-box-icon bg-orange elevation-1" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><span><i class="fa fa-male"></i></span></a>
              <div class="info-box-content">
                <span class="info-box-text">Transportation</span>
                <span class="info-box-number">
                  5
                  <?php echo "<pre";
                  echo print_r($_SESSION['user_type']);
                  echo "</pre>";
                  ?>
                </span>
              </div>
            </div>


           

          </div> <!-- /.col-12 col-sm-6 col-md-3 -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <a href="#" class="info-box-icon bg-danger elevation-1"><span><i class="fa fa-male"></i></span></a>
              <div class="info-box-content">
                <span class="info-box-text">Positive Cases</span>
                <span class="info-box-number">
                  0
                </span>
              </div>
            </div>
          </div> <!-- /.col-12 col-sm-6 col-md-3 -->

         

        </div><!-- end row -->
        <div class="row">
          <div class="col-2"></div>
          <div class="col-8">
            <div class="float">
              <div id="display_update"></div>
            </div>

          </div>
        </div><!-- end row -->
        <div class="row">
          <div class="col-6">
            <div id="curve_chart" style="width: 500; height: 300px"></div>
          </div>

          <div class="col-6">
            <div id="chart_div" style="width: 500; height: 300px"></div>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <div id="piechart" style="width: 500; height: 300px"></div>
          </div>

        </div>
      </div><!-- end container-fluid -->


    </div><!-- /.content-wrapper -->

    <?php include('footer.php') ?>

  </div> <!-- /.wrapper -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- datepicker -->
  <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    load_update();

    function load_update() {
      $.ajax({
        url: "load_update_fetch.php",
        method: "POST",
        success: function(data) {
          $('#display_update').html(data);
        },
        complete: function() {
          setTimeout(load_update, 2000); //After completion of request, time to redo it after a second
        }
      });
    }
  </script>
  <script>
    $('#users').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'autoHeight': true
    })

    $(document).ready(function() {

      google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Year', 'Suspect', 'Probable', 'Confirment', "Death", "Recovered"],
          <?php

          $sql = "Select *,DATE_FORMAT(date,'%b-%d') as datefilter from tbl_covid ";
          $get_sql = $con->prepare($sql);
          $get_sql->execute();
          while ($result = $get_sql->fetch(PDO::FETCH_ASSOC)) {
            $pum = $result['pum'];
            $pui = $result['pui'];
            $positive = $result['positive'];
            $death = $result['death'];
            $recovery = $result['recovery'];
            $date = $result['datefilter'];
            echo "['" . $date . "'," . $pum . "," . $pui . "," . $positive . "," . $death . "," . $recovery . "],";
          }
          ?>

        ]);

        var options = {
          title: 'COVID-19 REPORT',
          curveType: 'function',
          legend: {
            position: 'bottom'
          }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }

      google.charts.load('current', {
        packages: ['corechart', 'bar']
      });
      google.charts.setOnLoadCallback(drawMaterial);

      function drawMaterial() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Male', 'Female'],

          <?php
          $GET_GENDER = "select date_format(date_report,'%b-%d') as date_report,(Select count(gender)from tbl_pum where gender = 'Male')as Male,(Select count(gender)from tbl_pum where gender = 'Female')as Female from tbl_pum group by date_report";
          $prepare_gender = $con->prepare($GET_GENDER);
          $prepare_gender->execute();
          while ($get_sex = $prepare_gender->fetch(PDO::FETCH_ASSOC)) {
            $datefilter = $get_sex['date_report'];
            $male = $get_sex['Male'];
            $female = $get_sex['Female'];
            echo "['" . $datefilter . "'," . $male . "," . $female . "],";
          }

          ?>


        ]);

        var materialOptions = {
          chart: {
            title: 'Confirmed Cases by Gender'
          },
          hAxis: {
            title: 'Total Population',
            minValue: 0,
          },
          vAxis: {
            title: 'Date'
          },
          bars: 'horizontal'
        };
        var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
        materialChart.draw(data, materialOptions);
      }

      google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(drawPie);

      function drawPie() {

        var data = google.visualization.arrayToDataTable([
          ['Incidents', 'Total Incidents'],
          <?php
          $incident = "select type ,count(type) as count , (Select Count(objid) from tbl_incident) as total from tbl_incident GROUP BY type order by type";
          $prepare = $con->prepare($incident);
          $prepare->execute();
          while ($incident_result = $prepare->fetch(PDO::FETCH_ASSOC)) {
            $type =  $incident_result['type'];
            $count = $incident_result['count'];
            $total = $incident_result['total'];
            echo "['" . $type . "'," . $count . "],";
          }
          ?>

        ]);

        var options = {
          title: 'Incidents Reported Total: <?php echo $total ?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

    });
  </script>



</body>

</html>