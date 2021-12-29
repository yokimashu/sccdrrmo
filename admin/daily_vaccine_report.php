<?php

include('../config/db_config.php');






// include('list_individual.php');




session_start();
$user_id = $_SESSION['id'];

include('verify_admin.php');
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
} else {
}



date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');
$now = new DateTime();

$category = $date_from = $date_to = '';

//fetch user from database

$get_barangay = " SELECT barangay,code from tbl_barangay_code";
$get_barangay_data = $con->prepare($get_barangay);
$get_barangay_data->execute();




?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CATEGORYLIST </title>
  <?php include('heading.php'); ?>


</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


      <!-- <div class="float-topright">
                <?php echo $alert_msg; ?>
            </div> -->

      <section class="content">

        <br>
        <div class="card-header p-2 bg-success text-white">

          <div class="nav nav-pills" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-daily" role="tab" aria-controls="nav-home" aria-selected="true">DAILY VACCINE REPORT</a>



          </div>
        </div>


        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-daily" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="card">

              <div class="card-body">
                <div class="box box-primary">
                  <form role="form" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                    <div class="box-body">
                      <div class="row">


                        <div class="input-group date">
                          <label style="padding-right:10px;padding-left: 10px">DATE FROM: </label>
                          <div style="padding-right:10px" class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input style="margin-right:5px;" type="text" data-provide="datepicker" class="form-control col-3 " style="font-size:13px" autocomplete="off" name="datefrom" id="dtefrom" value="<?php echo $date_from; ?>">
                          <label style="padding-right:10px;padding-left: 10px">DATE TO: </label>
                          <input style="margin-right:5px;" type="text" data-provide="datepicker" class="form-control col-3 " style="font-size:13px" autocomplete="off" name="dateto" id="dteto" value="<?php echo $date_to; ?>">
                          
                        </div>
                        <br>

                        <br>

             


                        <div class="input-group date" style="padding-right:150px;padding-left: 50px">
                          <a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/daily_vaccine_report.php?datefrom=<?php echo $date_from; ?>"> REPORT 1</a>
                          <br>
                          &nbsp; &nbsp;
                          <a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink1" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/daily_vaccine_report_new.php?datefrom=<?php echo $date_from; ?>"> REPORT 2</a>

                          &nbsp; &nbsp;
                          <a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink2" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/daily_vaccine_report_sinovac.php?datefrom=<?php echo $date_from; ?>"> SINOVAC</a>

                          &nbsp; &nbsp;
                          <a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink3" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/daily_vaccine_report_astra.php?datefrom=<?php echo $date_from; ?>"> ASTRAZENECA</a>

                          &nbsp; &nbsp;
                          <a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink4" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/daily_vaccine_report_pfizer.php?datefrom=<?php echo $date_from; ?>"> PFIZER</a>

                          &nbsp; &nbsp;
                          <a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink5" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/daily_vaccine_report_janssen.php?datefrom=<?php echo $date_from; ?>"> JANSSEN</a>

                          &nbsp; &nbsp;
                          <a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink6" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/vaccine_report.php?datefrom=<?php echo $date_from; ?>"> TOTAL VACCINE REPORT</a>


                        </div>
                      </div>

                      &nbsp; &nbsp; &nbsp;

                      <div class="card-body">
                <div class="box box-primary">
                <div class="input-group date">
                        <div class="col-md-5">
                        <label style="padding-right:10px;padding-left: 10px">BARANGAY: </label>
                          <!-- <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender"> -->
                          <select class="form-control select2" id="barangay1" name="barangay">
                            <option selected value=" ">Select Bakuna Center</option>
                            <?php while ($get_barangay = $get_barangay_data->fetch(PDO::FETCH_ASSOC)) { ?>
                              <option value="<?php echo $get_barangay['code']; ?>"> <?php echo $get_barangay['code'] ?> </option>

                            <?php } ?>
                          </select>
                          &nbsp; &nbsp;
                          <a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink7" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/vaccine_report_barangay.php?datefrom=<?php echo $date_from; ?>"> PRINT REPORT</a>
                        </div>

                        
                        </div>
                        
                        </div>
                        </div>



                    </div>
                </div>
                </form>
              </div>
            </div>

          </div>

        </div>



    </div>
    </section>




  </div>

  <?php include('footer.php') ?>

  </div>






  <?php include('pluginscript.php') ?>




  <script>
    //REPORT1
    $('#printlink').click(function() {
      var date_from = $('#dtefrom').val();
      var date_to = $('#dteto').val();

      console.log(date_from);
      var param = "datefrom=" + date_from + "&dateto=" + date_to + "";
      $('#printlink').attr("href", "../plugins/jasperreport/daily_vaccine_report.php?" + param, '_parent');
    })

    //REPORT2
    $('#printlink1').click(function() {
      var date_from = $('#dtefrom').val();
      var date_to = $('#dteto').val();

      console.log(date_from);
      var param = "datefrom=" + date_from + "&dateto=" + date_to + "";
      $('#printlink1').attr("href", "../plugins/jasperreport/daily_vaccine_report_new.php?" + param, '_parent');
    })


    //SINOVAC
    $('#printlink2').click(function() {
      var date_from = $('#dtefrom').val();
      var date_to = $('#dteto').val();

      console.log(date_from);
      var param = "datefrom=" + date_from + "&dateto=" + date_to + "";
      $('#printlink2').attr("href", "../plugins/jasperreport/daily_vaccine_report_sinovac.php?" + param, '_parent');
    })

    //ASTRAZENECA
    $('#printlink3').click(function() {
      var date_from = $('#dtefrom').val();
      var date_to = $('#dteto').val();

      console.log(date_from);
      var param = "datefrom=" + date_from + "&dateto=" + date_to + "";
      $('#printlink3').attr("href", "../plugins/jasperreport/daily_vaccine_report_astra.php?" + param, '_parent');
    })


    //PFIZER
    $('#printlink4').click(function() {
      var date_from = $('#dtefrom').val();
      var date_to = $('#dteto').val();

      console.log(date_from);
      var param = "datefrom=" + date_from + "&dateto=" + date_to + "";
      $('#printlink4').attr("href", "../plugins/jasperreport/daily_vaccine_report_pfizer.php?" + param, '_parent');
    })

    //JANSSEN
    $('#printlink5').click(function() {
      var date_from = $('#dtefrom').val();
      var date_to = $('#dteto').val();




      console.log(date_from);
      var param = "datefrom=" + date_from + "&dateto=" + date_to + "";
      $('#printlink5').attr("href", "../plugins/jasperreport/daily_vaccine_report_janssen.php?" + param, '_parent');
    })


    //TOTAL VACCINATED
    $('#printlink6').click(function() {
      var date_from = $('#dtefrom').val();
      var date_to = $('#dteto').val();




      console.log(date_from);
      var param = "datefrom=" + date_from + "&dateto=" + date_to + "";
      $('#printlink6').attr("href", "../plugins/jasperreport/vaccine_report.php?" + param, '_parent');
    })


    $('#printlink7').click(function() {
      var date_from = $('#dtefrom').val();
      var date_to = $('#dteto').val();
      var barangay = $('#barangay1').val();




      console.log(date_from);
      var param = "datefrom=" + date_from + "&dateto=" + date_to + "&barangay=" + barangay + "";
      $('#printlink7').attr("href", "../plugins/jasperreport/vaccine_report_barangay.php?" + param, '_parent');
    })



  </script>
</body>



</html>