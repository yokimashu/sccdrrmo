<?php

include('../config/db_config.php');


$get_all_vaccine_sql = "SELECT * FROM tbl_assessment ";
$get_all_vaccine_data = $con->prepare($get_all_vaccine_sql);
$get_all_vaccine_data->execute();

$get_all_sinovac_sql = "SELECT * FROM tbl_assessment where Vaccinemanufacturer = 'Sinovac' ";
$get_all_sinovac_data = $con->prepare($get_all_sinovac_sql);
$get_all_sinovac_data->execute();

$get_all_astrazeneca_sql = "SELECT * FROM tbl_assessment where Vaccinemanufacturer = 'Astrazeneca' ";
$get_all_astrazeneca_data = $con->prepare($get_all_astrazeneca_sql);
$get_all_astrazeneca_data->execute();


$get_all_refusal_sql = "SELECT * FROM tbl_assessment where refusal_reasons != 'N/A' ";
$get_all_refusal_data = $con->prepare($get_all_refusal_sql);
$get_all_refusal_data->execute();

$get_all_deferral_sql = "SELECT * FROM tbl_assessment where deferral != 'N/A' ";
$get_all_deferral_data = $con->prepare($get_all_deferral_sql);
$get_all_deferral_data->execute();

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

            <div class="card-header bg-success text-white">
              <h4>
                VACCINE DASHBOARD
              </h4>
            </div>
            <div class="card-body">

              <div class="col-md-12">

                <div class="row">
                  <fieldset class="form-control field_set">



                    <div class="row">
                      <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                          <a href="#" class="info-box-icon bg-warning elevation-1">
                            <span><i class="fas fa-hospital-user"></i></span>
                          </a>
                          <div class="info-box-content">
                            <span class="info-box-text">Vaccinated</span>
                            <span class="info-box-number">
                              <?php echo $get_all_vaccine_data->rowCount() ?>
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                          <a href="#" class="info-box-icon bg-warning elevation-1"><span> <i class="nav-icon fas fa-syringe icons"></i></span></a>
                          <div class="info-box-content">
                            <span class="info-box-text">Refusal</span>
                            <span class="info-box-number">
                              <?php echo $get_all_refusal_data->rowCount() ?>
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                          <a href="#" class="info-box-icon bg-warning elevation-1"><span> <i class="nav-icon fas fa-syringe icons"></i></span></a>
                          <div class="info-box-content">
                            <span class="info-box-text">Deferral</span>
                            <span class="info-box-number">
                              <?php echo $get_all_deferral_data->rowCount() ?>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                          <a href="#" class="info-box-icon bg-warning elevation-1"><span> <i class="nav-icon fas fa-syringe icons"></i></span></a>
                          <div class="info-box-content">
                            <span class="info-box-text">Sinovac</span>
                            <span class="info-box-number">
                              <?php echo $get_all_sinovac_data->rowCount() ?>
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                          <a href="#" class="info-box-icon bg-warning elevation-1"><span> <i class="nav-icon fas fa-syringe icons"></i></span></a>
                          <div class="info-box-content">
                            <span class="info-box-text">Astrazeneca</span>
                            <span class="info-box-number">
                              <?php echo $get_all_astrazeneca_data->rowCount() ?>
                            </span>
                          </div>
                        </div>
                      </div>





                  </fieldset>
                </div>
                <br>

                <br>




              </div>

            </div>
          </div>
        </div>






        <div class="content ">
          <div class="card">
            <div class="card-header bg-success text-white">
              <h4>
                BAKUNA CENTER
              </h4>
            </div>

            <div class="card-body">


              <!-- registered individual by barangay -->
              <div class="card">
                <div class="card-body">
                  <div class="box box-primary ">
                    <div class="box-body">
                      <div id="chart_div" style="padding-left:10px; width: 100; height: 750px"> </div>
                    </div>
                  </div>
                </div>
              </div><br>









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
          ['total','SAN CARLOS DOCTORS HOSPITAL, INC.', 'SAN CARLOS CITY CITY HOSPITAL', 'CITY HEALTH OFFICE SAN CARLOS CITY', 'BRGY. III COVERED COURT', 'BRGY. GUADALUPE COVERED COURT', 'BRGY. PROSPERIDAD COVERED COURT', 'BRGY. PUNAO COVERED COURT', 'BRGY. RIZAL COVERED COURT', 'BRGY. SAN JUAN COVERED COURT', 'BRGY. QUEZON COVERED COURT'],

          <?php
          $GET_SINOVAC = "SELECT DISTINCT
                  (SELECT COUNT(entity_no) FROM tbl_assessment WHERE  bakuna_center = 'SAN CARLOS DOCTORS HOSPITAL, INC.') AS SANDOC,
                  (SELECT COUNT(entity_no) FROM tbl_assessment WHERE  bakuna_center = 'SAN CARLOS CITY CITY HOSPITAL') AS HOSPITAL,
				  (SELECT COUNT(entity_no) FROM tbl_assessment WHERE bakuna_center = 'CITY HEALTH OFFICE SAN CARLOS CITY') AS CHO,
          (SELECT COUNT(entity_no) FROM tbl_assessment WHERE bakuna_center = 'BARANGAY III COVERED COURT') AS BARANGAY_III,
          (SELECT COUNT(entity_no) FROM tbl_assessment WHERE bakuna_center = 'BARANGAY GUADALUPE COVERED COURT') AS GUADALUPE,
          (SELECT COUNT(entity_no) FROM tbl_assessment WHERE bakuna_center = 'BARANGAY PROSPERIDAD COVERED COURT') AS PROSPERIDAD,
          (SELECT COUNT(entity_no) FROM tbl_assessment WHERE bakuna_center = 'BARANGAY PUNAO COVERED COURT') AS PUNAO,
          (SELECT COUNT(entity_no) FROM tbl_assessment WHERE bakuna_center = 'BARANGAY RIZAL COVERED COURT') AS RIZAL,
          (SELECT COUNT(entity_no) FROM tbl_assessment WHERE bakuna_center = 'BARANGAY SAN JUAN COVERED COURT') AS SAN_JUAN,
          (SELECT COUNT(entity_no) FROM tbl_assessment WHERE bakuna_center = 'BARANGAY QUEZON COVERED COURT') AS QUEZON
  
                  FROM tbl_assessment;
                  ";
          $prepare_sinovac = $con->prepare($GET_SINOVAC);
          $prepare_sinovac->execute();
          while ($get_sinovac = $prepare_sinovac->fetch(PDO::FETCH_ASSOC)) {

         
            $sandoc = $get_sinovac['SANDOC'];
            $hospital = $get_sinovac['HOSPITAL'];
            $cho = $get_sinovac['CHO'];
            $bgy3 = $get_sinovac['BARANGAY_III'];
            $guadalupe = $get_sinovac['GUADALUPE'];
            $prosperidad = $get_sinovac['PROSPERIDAD'];
            $punao = $get_sinovac['PUNAO'];
            $rizal = $get_sinovac['RIZAL'];
            $sanjuan = $get_sinovac['SAN_JUAN'];
            $quezon = $get_sinovac['QUEZON'];




            echo "['Based on Bakuna Center Name'," . $sandoc .  "," . $hospital . "," . $cho . "," . $bgy3 . "
            ," . $guadalupe . "," . $prosperidad . "," . $punao . "," . $rizal . "," . $sanjuan . "," . $quezon . "]";
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



                //       
                ?>


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



                //       
                ?>


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