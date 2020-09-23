<?php

include('../config/db_config.php');
include('sql_queries.php');
include('generate_pum.php');




session_start();
$user_id = $_SESSION['id'];

include('verify_admin.php');

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {
}

$now = new DateTime();

$btnSave = $btnEdit = $ent_number = $name_org = $org = $nature_bus =
    $street_add = $brgy = $admin_name = $admin_position = $mobile_no =
    $telephone_no = $email_add = $juri_username = $juri_password = '';
$btnNew = 'hidden';



$get_all_brgy_sql = "SELECT * FROM tbl_barangay";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();



$get_all_categ_sql = "SELECT * FROM categ_juridical";
$get_all_categ_data = $con->prepare($get_all_categ_sql);
$get_all_categ_data->execute();




?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SCCDRRMO ERP | Add Juridical</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
    <!-- <link rel="stylesheet" href="../plugins/datatables/jquery.dataTables.css"> -->
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <style>
        .required {
            color: red;
        }
    </style>
</head>

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
                        <h4>Add Juridical </h4>
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
                                                <label>Entity #: </label>
                                                <input type="number" readonly class="form-control" name="entity_number" id="patient_number" placeholder="Entity Number" value="<?php echo $ent_number; ?>" required>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Date Registered: </label>
                                                <div class="input-group date" data-provide="datepicker">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" readonly class="form-control pull-right" id="datepicker" name="date_reg" placeholder="Date Registered" value="<?php echo $now->format('m-d-Y'); ?>">
                                                </div>

                                            </div>
                                            <div class="col-md-3">
                                                <label>Name of Organization <span class="required">*</span>: </label>
                                                <input type="text" readonly class="form-control" name="name_org" id="name_org" placeholder="Name of Organization" value="<?php echo $name_org; ?>" required>
                                            </div>



                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-1"></div>

                                            <div class="col-md-3">
                                                <label>Type of Organization <span class="required">*</span>: </label>
                                                <select class="form-control select2" id="organization" style="width: 100%;" name="organization" value="<?php echo $org; ?>">
                                                    <option selected="selected">Select Organization</option>
                                                    <?php while ($get_categ = $get_all_categ_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <option value="<?php echo $get_categ['categ_id']; ?>"><?php echo $get_categ['categ_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Nature of Business : </label>
                                                <input type="text" readonly class="form-control" name="nature_bus" id="nature_bus" placeholder="Nature of Business" value="<?php echo $nature_bus; ?>" required>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Street Address / Block #: </label>
                                                <input type="text" readonly class="form-control" name="street_add" id="street_add" placeholder="Street Address / Block #" value="<?php echo $street_add; ?>" required>
                                            </div>



                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-1"></div>

                                            <div class="col-md-3">
                                                <label>Barangay: </label>
                                                <select class="form-control select2" id="barangay" style="width: 100%;" name="barangay" value="<?php echo $brgy; ?>">
                                                    <option selected="selected">Select Barangay</option>
                                                    <?php while ($get_brgy = $get_all_brgy_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <option value="<?php echo $get_brgy['barangay']; ?>"><?php echo $get_brgy['barangay']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label>City: </label>
                                                <input type="text" readonly class="form-control" name="city" id="city" placeholder="City" value="San Carlos City" required>

                                            </div>
                                            <div class="col-md-3">
                                                <label>Province: </label>
                                                <input type="text" readonly class="form-control" name="province" id="province" placeholder="Province" value="Negros Occidental" required>
                                            </div>
                                        </div><br>



                                    </div>
                                </div>
                                <!-- personal information -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6>ADMINISTRATOR</h6>
                                    </div>
                                    <div class="box-body">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-3">
                                                <label>Admininstrator's Name: </label>
                                                <input type="text" readonly class="form-control" name="admin_name" id="admin_name" placeholder="Admininstrator's Name" value="<?php echo $admin_name ?>" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Position: </label>
                                                <input type="text" readonly class="form-control" name="admin_position" id="admin_position" placeholder="Admininstrator's Position" value="<?php echo $admin_position; ?>" required>
                                            </div>
                                        </div><br>



                                    </div>
                                </div>

                                <!-- travel history -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6>CONTACT INFORMATION</h6>
                                    </div>
                                    <div class="box-body">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-3">
                                                <label>Mobile #: </label>
                                                <input type="number" readonly class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile Number" value="<?php echo $mobile_no ?>" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Telephone #: </label>
                                                <input type="number" readonly class="form-control" name="tel_no" id="tel_no" placeholder="Telephone Number" value="<?php echo $telephone_no ?>" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Email Address: </label>
                                                <input type="text" readonly class="form-control" name="email_add" id="email_add" placeholder="Email Address" value="<?php echo $email_add ?>" required>
                                            </div>
                                        </div><br>


                                    </div>
                                </div>

                                <!--  -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6>JURIDICAL CREDENTIALS</h6>
                                    </div>
                                    <div class="box-body">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-3">
                                                <label>Username<span class="required">*</span>: </label>
                                                <input type="text" readonly class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $juri_username ?>" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Password<span class="required">*</span>: </label>
                                                <input type="password" readonly class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $juri_password ?>" required>
                                            </div>

                                        </div><br>

                                    </div>
                                </div>



                                <div class="box-footer" align="center">

                                    <button type="button" <?php echo $btnEdit; ?> name="edit" id="btnEdit" class="btn btn-info">
                                        <i class="fa fa-edit fa-fw"> </i> </button>

                                    <button type="submit" <?php echo $btnSave; ?> name="add_pum" id="btnSubmit" class="btn btn-success">
                                        <i class="fa fa-check fa-fw"> </i> </button>

                                    <a href="add_pum.php">
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
    <!-- textarea wysihtml style -->
    <script>
        $('.select2').select2();


        $('#btnEdit').on('change', function() {
            var type = $(this).val();
            // var office = $('#department').val();

            alert(hello);
            $.ajax({
                type: 'POST',
                data: {},
                url: 'generate_pum.php',
                success: function(data) {
                    $('#patient_number').val(data);

                }


            });
            //  }
        });

        $(function() {
            $('.textarea').wysihtml5({
                toolbar: {
                    fa: true
                }
            })
        });

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        });

        $("#btnSubmit").attr("disabled", true);
        $(".select2").attr("disabled", true);

        $(document).ready(function() {
            $('#btnEdit').click(function() {
                $("input[name='entity_number']").removeAttr("readonly");
                $("input[name='date_reg']").removeAttr("readonly");
                $("input[name='name_org']").removeAttr("readonly");
                $("input[name='organization']").removeAttr("readonly");
                $("input[name='nature_bus']").removeAttr("readonly");
                $("input[name='street_add']").removeAttr("readonly");
                $("input[name='city']").removeAttr("readonly");
                $("input[name='province']").removeAttr("readonly");
                $("input[name='admin_name']").removeAttr("readonly");

                $("input[name='admin_position']").removeAttr("readonly");
                $("input[name='mobile_no']").removeAttr("readonly");
                $("input[name='tel_no']").removeAttr("readonly");
                $("input[name='email_add']").removeAttr("readonly");

                $("input[name='username']").removeAttr("readonly");
                $("input[name='password']").removeAttr("readonly");


                $(".select2").attr("disabled", false);
                $("#btnSubmit").attr("disabled", false);
                $("#btnEdit").attr("disabled", true);
            });
        });

        // $('#btnEdit').on('change',function(){
        //             var type = $(this).val();
        //             // var office = $('#department').val();

        //             alert(hello);
        //             $.ajax({
        //               type:'POST',
        //               data:{ },
        //               url:'generate_pum.php',
        //               success:function(data){
        //                 $('#patient_number').val(data);

        //               }


        //             });           
        //     //  }
        //   });
    </script>




</body>

</html>