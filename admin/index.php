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



      <section class="content">


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
            </div>

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
            </div>

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
            </div>







          </div>
        </div>

        <!-- <div class="card">
          <div class="card-body">
            <div class="box box-primary">
              <div class="box-body">
                <div id="piechart" style="width: 500; height: 300px"></div>
              </div>
            </div>
          </div>
        </div> -->


        <!-- <div class="card">
          <div class="card-body">
            <div class="box box-primary">
              <div class="box-body">
                <div id="curve_chart" style="width: 500; height: 300px"></div>
              </div>
            </div>
          </div>
        </div> -->



        <div class="card">
          <div class="card-body">
            <div class="box box-primary ">
              <div class="box-body">
                <div id="chart_div" style="padding-left:10px; width: 200; height: 700px"> </div>
              </div>
            </div>
          </div>
        </div>









      </section>

      <br><br>



    </div>

    <?php include('footer.php') ?>
  </div>





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

      // google.charts.load('current', {
      //   packages: ['corechart', 'bar']
      // });
      // google.charts.setOnLoadCallback(drawMaterial);

      // function drawMaterial() {
      //   var data = google.visualization.arrayToDataTable([
      //     ['total', 'BARANGAY I', 'BARANGAY II', 'BARANGAY III', 'BARANGAY IV', 'BARANGAY V', 'BARANGAY VI', 'BAGONBON', 'BULUANGAN', 'CODCOD', 'ERMITA', 'GUADALUPE', 'NATABAN', 'PALAMPAS', 'PROSPERIDAD', 'PUNAO', 'QUEZON', 'RIZAL', 'SAN JUAN'],

      //     <?php
              //     $GET_BRGY = "SELECT DISTINCT
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'BARANGAY I') AS BARANGAYI,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'BARANGAY II' ) AS BARANGAYII,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'BARANGAY III' ) AS BARANGAYIII,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'BARANGAY IV' ) AS BARANGAYIV,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'BARANGAY V' ) AS BARANGAYV,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'BARANGAY VI' ) AS BARANGAYVI,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'BAGONBON' ) AS BAGONBON,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'BULUANGAN' ) AS BULUANGAN,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'CODCOD' ) AS CODCOD,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'ERMITA' ) AS ERMITA,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'GUADALUPE' ) AS GUADALUPE,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'NATABAN' ) AS NATABAN,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'PALAMPAS' ) AS PALAMPAS,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'PROSPERIDAD' ) AS PROSPERIDAD,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'PUNAO' ) AS PUNAO,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'QUEZON' ) AS QUEZON,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'RIZAL' ) AS RIZAL,
              //     (SELECT COUNT(barangay) FROM tbl_positive WHERE barangay = 'SAN JUAN' ) AS SANJUAN,
              //     (SELECT COUNT(timestamp) FROM tbl_positive) AS total 
              //     FROM tbl_positive GROUP BY barangay;
              //     ";
              //     $prepare_brgy = $con->prepare($GET_BRGY);
              //     $prepare_brgy->execute();
              //     while ($get_brgy = $prepare_brgy->fetch(PDO::FETCH_ASSOC)) {

              //       $brgy1 = $get_brgy['BARANGAYI'];
              //       $brgy2 = $get_brgy['BARANGAYII'];
              //       $brgy3 = $get_brgy['BARANGAYIII'];
              //       $brgy4 = $get_brgy['BARANGAYIV'];
              //       $brgy5 = $get_brgy['BARANGAYV'];
              //       $brgy6 = $get_brgy['BARANGAYVI'];
              //       $bagonbon = $get_brgy['BAGONBON'];
              //       $buluangan = $get_brgy['BULUANGAN'];
              //       $codcod = $get_brgy['CODCOD'];
              //       $ermita = $get_brgy['ERMITA'];
              //       $guadalupe = $get_brgy['GUADALUPE'];
              //       $nataban = $get_brgy['NATABAN'];
              //       $palampas = $get_brgy['PALAMPAS'];
              //       $prosperidad = $get_brgy['PROSPERIDAD'];
              //       $punao = $get_brgy['PUNAO'];
              //       $quezon = $get_brgy['QUEZON'];
              //       $rizal = $get_brgy['RIZAL'];
              //       $sanjuan = $get_brgy['SANJUAN'];
              //       $totalcases = $get_total['total'];



              //       echo "['Based on Barangay'," . $brgy1 .  "," . $brgy2 . "," . $brgy3 . "," . $brgy4 . ",
              //       " . $brgy5 . "," . $brgy6 . "," . $bagonbon . "," . $buluangan . "," . $codcod . "
              //       ," . $ermita . "," . $guadalupe . "," . $nataban . "," . $palampas . "," . $prosperidad . "
              //       ," . $punao . "," . $quezon . "," . $rizal . "," . $sanjuan . " ," . $total . "]";

              //     }


              //     
              ?>


      //   ]);

      //   var materialOptions = {
      //     chart: {
      //       title: 'Number of Covid-19 Positive Case' <?php echo $totalcases ?>,
      //     },
      //     hAxis: {
      //       title: 'Total Cases' ,
      //       minValue: 0,
      //     },
      //     vAxis: {
      //       title: 'Barangay' 
      //     },
      //     bars: 'vertical'
      //   };
      //   var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
      //   materialChart.draw(data, materialOptions);
      // }

      // google.charts.load('current', {
      //   'packages': ['corechart']
      // });
      // google.charts.setOnLoadCallback(drawPie);






      // function drawPie() {

      //   var data = google.visualization.arrayToDataTable([
      //     ['Person', 'Entity'],
      //     <?php
              //     $incident = "SELECT barangay, COUNT(entity_no) AS registered,(SELECT COUNT(entity_no) FROM tbl_individual) AS total FROM tbl_individual GROUP BY barangay; 
              //     ";
              //     $prepare = $con->prepare($incident);
              //     $prepare->execute();
              //     while ($incident_result = $prepare->fetch(PDO::FETCH_ASSOC)) {
              //       $type =  $incident_result['barangay'];
              //       $count = $incident_result['registered'];
              //       $total = $incident_result['total'];
              //       echo "['" . $type . "'," . $count . "],";
              //     }
              //     
              ?>

      //   ]);

      //   var options = {
      //     title: 'Total Registered Entity: <?php echo $total ?>'
      //   };

      //   var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      //   chart.draw(data, options);
      // }


      //       function drawPie() {

      // var data = google.visualization.arrayToDataTable([
      //   ['Person', 'Entity'],
      //   <?php
            //   $incident = "SELECT barangay, COUNT(barangay) AS positive,(SELECT COUNT(barangay) FROM tbl_positive) AS total FROM tbl_positive GROUP BY barangay; 
            //   ";
            //   $prepare = $con->prepare($incident);
            //   $prepare->execute();
            //   while ($incident_result = $prepare->fetch(PDO::FETCH_ASSOC)) {
            //     $type =  $incident_result['barangay'];
            //     $count = $incident_result['positive'];
            //     $total = $incident_result['total'];
            //     echo "['" . $type . "'," . $count . "],";
            //   }
            //   
            ?>

      // ]);

      // var options = {
      //   title: 'Total Positive Cases: <?php echo $total ?>'
      // };

      // var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      // chart.draw(data, options);
      // }




    });
  </script>



</body>

</html>