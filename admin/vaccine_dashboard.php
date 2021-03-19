<?php

include('../config/db_config.php');




$title = 'VAMOS | Dashboard';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">


  <?php include('heading.php'); ?>

  <style>
    .field_set {
      border-color: green;
      border-style: solid;
    }

    #fieldset {
      color: #31A231;
      width: 10%;
      padding: 5px 10px;

    }

    #fieldset_verify {
      color: #31A231;
      width: 15%;
      padding: 5px 10px;

    }
  </style>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header"></div>

      <!-- individual content graphs -->
      <section class="content">

        <div class="container-fluid">
          <div class="card">

      


        </div>

        <div class="content ">
          <div class="card">
            <div class="card-header bg-success text-white">
              <h4>
                DASHBOARD
              </h4>
            </div>

            <div class="card-body">


              <!-- registered individual by barangay -->
              <div class="card">
                <div class="card-body">
                  <div class="box box-primary ">
                    <div class="box-body">
                      <div id="chart_div" style="padding-left:10px; width: 200; height: 750px"> </div>
                    </div>
                  </div>
                </div>
              </div><br>



              <!-- <div class="card">
                <div class="card-body">
                  <div class="box box-primary ">
                    <div class="box-body">
                      <div id="chart_div2" style="padding-left:10px; width: 200; height: 700px"> </div>
                    </div>
                  </div>
                </div>
              </div> -->





            </div>
          </div>


        </div>

      </section>




      <br>



    </div>

    <?php include('footer.php') ?>
  </div>





  <!-- jQuery -->
  <script src=" ../plugins/jquery/jquery.min.js"> </script> <!-- Bootstrap 4 -->
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
        packages: ['corechart', 'bar']
      });
      google.charts.setOnLoadCallback(drawMaterial1);

      function drawMaterial1() {
        var data = google.visualization.arrayToDataTable([
          ['total', 'SAN CARLOS DOCTORS HOSPITAL, INC.', 'SAN CARLOS CITY CITY HOSPITAL'],

          <?php
          $GET_SINOVAC = "SELECT DISTINCT
                  (SELECT COUNT(entity_no) FROM tbl_assessment WHERE VaccineManufacturer = 'Sinovac' and bakuna_center = 'SAN CARLOS DOCTORS HOSPITAL, INC.') AS SANDOC,
                  (SELECT COUNT(entity_no) FROM tbl_assessment WHERE VaccineManufacturer = 'Sinovac' and bakuna_center = 'SAN CARLOS CITY CITY HOSPITAL') AS HOSPITAL
             
             
                  FROM tbl_assessment GROUP BY VaccineManufacturer;
                  ";
          $prepare_sinovac = $con->prepare($GET_SINOVAC);
          $prepare_sinovac->execute();
          while ($get_sinovac = $prepare_sinovac->fetch(PDO::FETCH_ASSOC)) {

            $sandoc = $get_sinovac['SANDOC'];
            $hospital = $get_sinovac['HOSPITAL'];
        



            echo "['Based on Bakuna Center Name'," . $sandoc .  "," . $hospital . "]";
          }



          ?>


        ]);

        var materialOptions = {
          chart: {
            title: 'Vaccinated',
          },
          hAxis: {
            title: 'Total ',
            minValue: 0,
          },
          vAxis: {
            title: 'Sinovac'
          },
          bars: 'vertical'
        };
        var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
        materialChart.draw(data, materialOptions);
      }


    //   google.charts.load('current', {
    //     packages: ['corechart', 'bar']
    //   });
    //   google.charts.setOnLoadCallback(drawMaterial3);

    //   function drawMaterial3() {
    //     var data = google.visualization.arrayToDataTable([
    //       ['total', 'JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'],

    //       <?php
    //       $GET_MONTH = "SELECT DISTINCT
    //               (SELECT COUNT(barangay) FROM tbl_individual WHERE date_register BETWEEN '2020-01-01' AND '2020-01-31') AS JANUARY,
    //               (SELECT COUNT(barangay) FROM tbl_individual WHERE date_register BETWEEN '2020-02-01' AND '2020-02-31') AS FEBRUARY,
    //               (SELECT COUNT(barangay) FROM tbl_individual WHERE date_register BETWEEN '2020-03-01' AND '2020-03-31') AS MARCH,
    //               (SELECT COUNT(barangay) FROM tbl_individual WHERE date_register BETWEEN '2020-04-01' AND '2020-04-31') AS APRIL,
    //               (SELECT COUNT(barangay) FROM tbl_individual WHERE date_register BETWEEN '2020-05-01' AND '2020-05-31') AS MAY,
    //               (SELECT COUNT(barangay) FROM tbl_individual WHERE date_register BETWEEN '2020-06-01' AND '2020-06-31') AS JUNE,
    //               (SELECT COUNT(barangay) FROM tbl_individual WHERE date_register BETWEEN '2020-07-01' AND '2020-07-31') AS JULY,
    //               (SELECT COUNT(barangay) FROM tbl_individual WHERE date_register BETWEEN '2020-08-01' AND '2020-08-31') AS AUGUST,
    //               (SELECT COUNT(barangay) FROM tbl_individual WHERE date_register BETWEEN '2020-09-01' AND '2020-09-31') AS SEPTEMBER,
    //               (SELECT COUNT(barangay) FROM tbl_individual WHERE date_register BETWEEN '2020-10-01' AND '2020-10-31') AS OCTOBER,
    //               (SELECT COUNT(barangay) FROM tbl_individual WHERE date_register BETWEEN '2020-11-01' AND '2020-11-31') AS NOVEMBER,
    //               (SELECT COUNT(barangay) FROM tbl_individual WHERE date_register BETWEEN '2020-12-01' AND '2020-12-31') AS DECEMBER
                  
                 
             
    //               FROM tbl_individual GROUP BY date_register;
    //               ";
    //       $prepare_month = $con->prepare($GET_MONTH);
    //       $prepare_month->execute();
    //       while ($get_month = $prepare_month->fetch(PDO::FETCH_ASSOC)) {

    //         $jan = $get_month['JANUARY'];
    //         $feb = $get_month['FEBRUARY'];
    //         $march = $get_month['MARCH'];
    //         $april = $get_month['APRIL'];
    //         $may = $get_month['MAY'];
    //         $june = $get_month['JUNE'];
    //         $july = $get_month['JULY'];
    //         $august = $get_month['AUGUST'];
    //         $september = $get_month['SEPTEMBER'];
    //         $october = $get_month['OCTOBER'];
    //         $november = $get_month['NOVEMBER'];
    //         $december = $get_month['DECEMBER'];




    //         echo "['Based on Month'," . $jan .  "," . $feb . "," . $march . "," . $april . ",
    //                 " . $may . "," . $june . "," . $july . "," . $august . "," . $september . "
    //                 ," . $october . "," . $november . "," . $december . "]";
    //       }



    //       ?>


    //     ]);

    //     var materialOptions = {
    //       chart: {
    //         title: 'Monthly Registered Individual ',
    //       },
    //       hAxis: {
    //         title: 'Total Cases',
    //         minValue: 0,
    //       },
    //       vAxis: {
    //         title: 'Month Of'
    //       },
    //       bars: 'vertical'
    //     };
    //     var materialChart = new google.charts.Bar(document.getElementById('chart_div2'));
    //     materialChart.draw(data, materialOptions);
    //   }





    //   google.charts.load('current', {
    //     packages: ['corechart', 'bar']
    //   });
    //   google.charts.setOnLoadCallback(drawMaterial);


    //   function drawMaterial() {
    //     var data = google.visualization.arrayToDataTable([
    //       ['total', 'GOVERNMENT', 'CORPORATION', 'COOPERATIVE', 'ASSOCIATION', 'RELIGIOUS', 'FOUNDATION', 'PARTNERSHIP', 'SCHOOL', 'NGO', 'BUSINESS', 'HOUSEHOLD'],

    //       <?php
    //       $GET_ORGTYPE = "SELECT DISTINCT
    //               (SELECT COUNT(org_type) FROM tbl_juridical WHERE org_type = 'Corporation') AS CORPORATION,
    //               (SELECT COUNT(org_type) FROM tbl_juridical WHERE org_type = 'Cooperative' ) AS COOPERATIVE,
    //               (SELECT COUNT(org_type) FROM tbl_juridical WHERE org_type = 'Association' ) AS ASSOCIATION,
    //               (SELECT COUNT(org_type) FROM tbl_juridical WHERE org_type = 'Religious' ) AS RELIGIOUS,
    //               (SELECT COUNT(org_type) FROM tbl_juridical WHERE org_type = 'Foundation' ) AS FOUNDATION,
    //               (SELECT COUNT(org_type) FROM tbl_juridical WHERE org_type = 'Partnership' ) AS PARTNERSHIP,
    //               (SELECT COUNT(org_type) FROM tbl_juridical WHERE org_type = 'Government' ) AS GOVERNMENT,
    //               (SELECT COUNT(org_type) FROM tbl_juridical WHERE org_type = 'School' ) AS SCHOOL,
    //               (SELECT COUNT(org_type) FROM tbl_juridical WHERE org_type = 'NGO' ) AS NGO,
    //               (SELECT COUNT(org_type) FROM tbl_juridical WHERE org_type = 'Business' ) AS BUSINESS,
    //               (SELECT COUNT(org_type) FROM tbl_juridical WHERE org_type = 'Household' ) AS HOUSEHOLD
    
             
    //               FROM tbl_juridical GROUP BY org_type;
    //               ";
    //       $prepare_orgtype = $con->prepare($GET_ORGTYPE);
    //       $prepare_orgtype->execute();
    //       while ($get_orgtype = $prepare_orgtype->fetch(PDO::FETCH_ASSOC)) {

    //         $CORPORATION = $get_orgtype['CORPORATION'];
    //         $COOPERATIVE = $get_orgtype['COOPERATIVE'];
    //         $ASSOCIATION = $get_orgtype['ASSOCIATION'];
    //         $RELIGIOUS = $get_orgtype['RELIGIOUS'];
    //         $FOUNDATION = $get_orgtype['FOUNDATION'];
    //         $PARTNERSHIP = $get_orgtype['PARTNERSHIP'];
    //         $GOVERNMENT = $get_orgtype['GOVERNMENT'];
    //         $SCHOOL = $get_orgtype['SCHOOL'];
    //         $NGO = $get_orgtype['NGO'];
    //         $BUSINESS = $get_orgtype['BUSINESS'];
    //         $HOUSEHOLD = $get_orgtype['HOUSEHOLD'];




    //         echo "['Based on Juridical'," . $CORPORATION .  "," . $COOPERATIVE . "," . $ASSOCIATION . "," . $RELIGIOUS . ",
    //                 " . $FOUNDATION . "," . $PARTNERSHIP . "," . $GOVERNMENT . "," . $SCHOOL . "," . $NGO . "
    //                 ," . $BUSINESS . "," . $HOUSEHOLD . "]";
    //       }



    //       ?>


    //     ]);

    //     var materialOptions = {
    //       chart: {
    //         title: 'Registered Juridical',
    //       },
    //       hAxis: {
    //         title: 'Total Cases',
    //         minValue: 0,
    //       },
    //       vAxis: {
    //         title: 'JURIDICAL'
    //       },
    //       bars: 'vertical'
    //     };
    //     var materialChart = new google.charts.Bar(document.getElementById('chart_div3'));
    //     materialChart.draw(data, materialOptions);
    //   }

    


    });
  </script>



</body>

</html>