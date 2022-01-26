<?php

include('../config/db_config.php');
include('sql_queries.php');






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
$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


  $db_fullname = $result['fullname'];
}


$get_all_category_sql = "SELECT * FROM tbl_category";
$get_all_category_data = $con->prepare($get_all_category_sql);
$get_all_category_data->execute();

$get_all_brgy_sql = "SELECT * FROM tbl_barangay_code order by barangay asc";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();

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
        <div class="card-header  bg-success text-white">
          <h4>
            Vaccine Masterlist
          </h4>

        </div>


        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-daily" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="card">

              <div class="card-body">
                <div class="box ">
                  <form role="form" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">

                    <div class="card card-success card-outline">

                      <div class="card-header ">
                        <h5 class="m-0">GENERATE REPORT</h5>
                      </div>
                      <div class="box-body">
                        <br>
                        <div class="row">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <div class="col-md-0" align="right">
                            <label>Barangay: </label>
                          </div>

                          <div class="col-md-3">
                            <select class="form-control select2" id="barangay1" style="width: 100%;" name="barangay1" value="<?php echo $barangay1; ?>" required>
                              <option value="" selected="selected">Select Barangay</option>
                              <?php while ($get_brgy = $get_all_brgy_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $get_brgy['code']; ?>"><?php echo $get_brgy['code']; ?></option>
                              <?php } ?>
                            </select>
                          </div>

                          <div class="col-md-0" align="right">
                            <label>Category: <span id="required"></span> </label>
                          </div>

                          <div class="col-md-3">
                            <select class="form-control select2" id="category2" style="width: 100%;" name="category2" value="<?php echo $category1; ?>" required>
                              <option value="" selected="selected">Select Category</option>
                              <?php while ($get_categ = $get_all_category_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $get_categ['description']; ?>"><?php echo $get_categ['description']; ?></option>
                              <?php } ?>
                            </select>
                          </div>

                          <div class="col-md-1" align="right">
                            <label>Consent: </label>
                          </div>
                          <div class="col-md-1">
                            <select name="consent" id="consent" style="width:80%" class="form-control ">
                              <option value="02_No"> No</option>
                              <option value="01_Yes">Yes </option>
                           
                           
                            </select>
                          </div>


<!--                           
                          <div class="col-md-1" align="right">
                            <label>Astrazeneca:  </label>
                          </div>
                          <div class="col-md-1">
                            <select name="sinovac" id="astrazeneca" style="width:80%" class="form-control ">
                              <option value="02_No">No</option>
                              <option value="01_Yes">Yes </option>
                          
                           
                            </select>
                          </div> -->


                        </div>
                        <br>
                        <div class="row">

                          <div class="col-md-5" align="right">
                            <button id="list_categorylist" onClick="loadhistory()" class="btn btn-success"><i class="fa fa-search"></i></button>
                            <!-- <input hidden readonly="true" type="text" name="description" id="description" class="form-control"> -->
                          </div>
                          <div class="col-md-1" style="float:left">
                            &nbsp;
                            <a class="btn btn-danger btn-md" target="blank" id="printlink" href="../plugins/jasperreport/vaccine_masterlist.php?description=<?php echo $description; ?>&barangay=<?php echo $barangay; ?>">
                              <i class="nav-icon fa fa-print"></i>
                            </a>
                          </div>
                        </div>






                      </div>
                      <br>
                      <!-- end of row -->














                    </div>


                </div>

                <div class="card" style="padding:15px;">
                  <div class="box-body">

                    <div class="col-12" style="margin-bottom:30px;padding:auto;">
                      <div class="table-responsive">

                        <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">
                          <thead align="center">
                            <th> Entity_no </th>
                            <th> Date Create</th>
                            <th> Category</th>
                            <th> Full Name </th>
                            <th> Barangay </th>
                            <th> Consent</th>
                            <th> Sinovac</th>
                            <th> Astrazeneca</th>
                          </thead>
                          <tbody id="category_member">

                          </tbody>
                        </table>


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
    $('#users').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'autoHeight': true


    });
    $('.select2').select2();


    function loadhistory() {
      event.preventDefault();
      var category = $('#category2').val();
      var barangay = $('#barangay1').val();
      var consent = $('#consent').val();
    







      $('#category_member').load("load_categorylist.php", {
        category: category,
          barangay: barangay,
          consent: consent
       

        },




        function(response, status, xhr) {
          if (status == "error") {
            alert(msg + xhr.status + " " + xhr.statusText);
            console.log(msg + xhr.status + " " + xhr.statusText);
            console.log("xhr=" + xhr.responseText);
          }


        });

    }



    $(function() {

      $('.select2').select2();
      $("#category").select2({

        ajax: {
          url: "category_query", // json datasource
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function(params) {
            return {
              searchTerm: params.term
            };
          },

          processResults: function(response) {
            return {
              results: response


            };
          },
          cache: true,
          error: function(xhr, b, c) {
            console.log(
              "xhr=" +
              xhr.responseText +
              " b=" +
              b.responseText +
              " c=" +
              c.responseText
            );
          }
        }
      });

    });

    $('#category').on('change', function() {
      var category = this.value;
      console.log(category);
      $.ajax({
        type: "POST",
        url: 'category_list.php',
        data: {
          category: category
        },
        error: function(xhr, b, c) {
          console.log(
            "xhr=" +
            xhr.responseText +
            " b=" +
            b.responseText +
            " c=" +
            c.responseText
          );
        },
        success: function(response) {
          var result = jQuery.parseJSON(response);
          console.log('response from server', result);
          $('#category').val(result.data);
          $('#description').val(result.data1);


        },


      });

    });


    $('#printlink').click(function() {
      var category = $('#category2').val();
      var description = $('#description').val();
      var barangay1 = $('#barangay1').val();
      var consent = $('#consent').val();



      console.log(description);
      var param = "category=" + category + "&barangay=" + barangay1 + "&consent=" + consent + "";
      $('#printlink').attr("href", "../plugins/jasperreport/vaccine_masterlist.php?" + param, '_parent');
    })
  </script>
</body>

</html>