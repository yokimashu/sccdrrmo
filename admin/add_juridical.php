<?php

include('../config/db_config.php');
// include('sql_queries.php');
// include('generate_id.php');
include('insert_juridical.php');



session_start();
$user_id = $_SESSION['id'];

include('verify_admin.php');

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {
}

$now = new DateTime();

$btnSave = $btnEdit = $id = $name_org = $org = '';



$btnNew = 'hidden';


$get_all_brgy_sql = "SELECT * FROM tbl_barangay";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();


$get_all_category_sql = "SELECT * FROM categ_juridical";
$get_all_category_data = $con->prepare($get_all_category_sql);
$get_all_category_data->execute();


$title = '';
?>


<!DOCTYPE html>
<html>

<?php include('heading.php'); ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('sidebar.php'); ?>

        <div class="content-wrapper">
            <div class="content-header"></div>

            <div class="float-topright">
                <?php echo $alert_msg; ?>
            </div>

            <section class="content">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h4>Jurdical Form </h4>
                    </div>

                    <div class="card-body">
                        <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                            <div class="box-body">


                                <div class="card">
                                    <div class="card-header">
                                        <h6>GENERAL INFORMATION</h6>
                                    </div>
                                    <div class="box-body">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>

                                            <div class="col-md-3">
                                                <label>Entity ID : </label>
                                                <input type="text" class="form-control" name="entity_no" id="entityid" placeholder="Entity ID" value="<?php echo $id; ?>" required>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Date Registered: </label>
                                                <div class="input-group date" data-provide="datepicker">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="datepicker" name="date_reg" placeholder="Date Registered" value="<?php echo $now->format('Y-m-d'); ?>">
                                                </div>

                                            </div>
                                            <!-- <div class="col-md-3">
                                                <label>Name of Organization: <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="name_org" id="name_org" placeholder="Name of Organization" value="<?php echo $name_org; ?>">
                                            </div> -->

                                        </div><br>


                                        <!-- <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-3">
                                                <label>Type of Organization: <span class="required">*</span></label>
                                                <select class="form-control select2" id="organization" style="width: 100%;" name="organization" value="<?php echo $org; ?>">
                                                    <option selected="selected">Select Organization</option>
                                                    <?php while ($get_categ = $get_all_category_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <option value="<?php echo $get_categ['categ_id']; ?>"><?php echo $get_categ['categ_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Nature of Business: </label>
                                                <input type="text" class="form-control" name="nature_bus" id="nature_bus" placeholder="Nature of Business" value="<?php echo $nature_bus; ?>">
                                            </div>

                                            <div class="col-md-3">
                                                <label>Street Address / Block #: </label>
                                                <input type="text" class="form-control" name="street_add" id="street_add" placeholder="Street Address / Block #" value="<?php echo $street_add; ?>">
                                            </div>

                                        </div><br> -->



                                    </div>
                                </div><br>

                                <div class="card">
                                    <div class="card-header">
                                        <h6>ADMINISTRATOR</h6>
                                    </div>
                                    <div class="box-body">
                                        <br>


                                    </div>

                                </div>


                                <div class="card">
                                    <div class="card-header">
                                        <h6>CONTACT INFORMATION</h6>
                                    </div>
                                    <div class="box-body">
                                        <br>


                                    </div>

                                </div>


                                <div class="card">
                                    <div class="card-header">
                                        <h6>JURIDICAL CREDENTIALS</h6>
                                    </div>
                                    <div class="box-body">
                                        <br>


                                    </div>

                                </div>









                                <div class="box-footer" align="center">


                                    <button type="submit" <?php echo $btnSave; ?> name="insert_juridical" id="btnSubmit" class="btn btn-success">
                                        <i class="fa fa-check fa-fw"> </i> </button>

                                    <a href="list_juridical">
                                        <button type="button" name="cancel" class="btn btn-danger">
                                            <i class="fa fa-close fa-fw"> </i> </button>
                                    </a>
                                </div>
                                <!-- end box-footer -->
                            </div>
                            <!-- end box-body -->
                        </form>
                        <!-- end form -->
                    </div>






                </div>

            </section>
        </div>


        <?php include('footer.php') ?>

    </div>



    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- CK Editor -->
    <script src="../../plugins/ckeditor/ckeditor.js"></script>
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
    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js"></script>
    <!-- <script src="../plugins/webcamjs/webcam.js"></script> -->


    <script>
        $('.select2').select2();
        // $(function() {

        //     $.ajax({
        //         type: 'POST',
        //         data: {},
        //         url: 'generate_id.php',
        //         success: function(data) {
        //             $('#entity_id').val(data);
        //         }
        //     });




        // });
    </script>

</body>

</html>