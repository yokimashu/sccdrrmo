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
                        <input style="margin-right:5px;" type="text" data-provide="datepicker" class="form-control col-3 " style="font-size:13px" autocomplete="off" name="datefrom" id="dtefrom"value="<?php echo $date_from; ?>">
                        <label style="padding-right:10px;padding-left: 10px">DATE TO: </label>
                        <input style="margin-right:5px;" type="text" data-provide="datepicker" class="form-control col-3 " style="font-size:13px" autocomplete="off" name="dateto" id="dteto"value="<?php echo $date_to; ?>">
                        </div>
                        <br>
                       
                        <div class="input-group date" style="padding-right:150px;padding-left: 50px">  
                        <a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/daily_vaccine_report.php?datefrom=<?php echo $date_from; ?>"> REPORT 1</a>
                        <br>
                        &nbsp;
<a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink1" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/daily_vaccine_report_new.php?datefrom=<?php echo $date_from; ?>"> REPORT 2</a>
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
 

  




    $('#printlink').click(function() {
      var date_from = $('#dtefrom').val();
      var date_to = $('#dteto').val();
   
  


      console.log(date_from);
      var param = "datefrom=" + date_from + "&dateto=" + date_to + "";
      $('#printlink').attr("href", "../plugins/jasperreport/daily_vaccine_report.php?" + param, '_parent');
    })

    $('#printlink1').click(function() {
      var date_from = $('#dtefrom').val();
      var date_to = $('#dteto').val();
   
  


      console.log(date_from);
      var param = "datefrom=" + date_from + "&dateto=" + date_to + "";
      $('#printlink1').attr("href", "../plugins/jasperreport/daily_vaccine_report_new.php?" + param, '_parent');
    })
  </script>
</body>

</html>