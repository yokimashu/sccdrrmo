<?php

include('../config/db_config.php');
include('update_bakuna_center.php');
session_start();
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {
}

date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$now = new DateTime();
$time = date('H:i:s');

$btnSave = $btnEdi = $btn_enabled = $get_date_register =
    $get_bc_code = $get_bc_name = $get_bc_address = '';

//fetch user from database

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $get_data_sql = "SELECT * FROM tbl_bakuna_center  where bc_code = :id ";
    $get_data_data = $con->prepare($get_data_sql);
    $get_data_data->execute([':id' => $id]);

    while ($result = $get_data_data->fetch(PDO::FETCH_ASSOC)) {

        $get_bc_code = $result['bc_code'];
        $get_bc_name = $result['bc_name'];
        $get_bc_address = $result['bc_address'];
        $get_date_register = $result['date_register'];
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>VAMOS | Bakuna Center Update </title>
    <?php include('heading.php'); ?>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include('sidebar.php'); ?>

        <div class="content-wrapper">
            <div class="content-header"></div>


            <section class="content">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h4>Bakuna Center Form</h4>
                    </div>


                    <div class="card-body">

                        <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="<?php htmlspecialchars("PHP_SELF"); ?>">

                            <div class="box-body">
                                <div class="row">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="m-1 pb-1"> </div>
                                    <div class="card col-md-12">

                                        <div class=" card-header">
                                            <h6><strong>GENERAL INFORMATION</strong></h6>
                                        </div>

                                        <div class="box-body">
                                            <br>

                                            <div class="row">

                                                <div class="col-md-1"></div>
                                                <div class="col-lg-5">
                                                    <label>Date Registered: </label>
                                                    <div class="input-group date" data-provide="datepicker">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input readonly type="text" class="form-control pull-right" id="datepicker" name="date_register" placeholder="Date Process" value="<?php echo $get_date_register; ?>">

                                                    </div>
                                                </div>
                                                <input hidden type="text" class="form-control pull-right" id="id" name="id" placeholder="id" value="<?php echo $id; ?>">

                                                <div class="col-lg-5">
                                                    <label>Bakuna Center Code : </label>
                                                    <input readonly type="text" class="form-control" name="bc_code" id="bc_code" placeholder="Bakuna Center Code" value="<?php echo $get_bc_code; ?>" required>
                                                </div>

                                            </div></br>

                                            <div class="row">
                                                <div class="col-md-1"></div>

                                                <div class="col-md-5">
                                                    <label>Bakuna Center Name : </label>
                                                    <input type="text" class="form-control" id="bc_name" name="bc_name" placeholder="Bakuna Center Name" onblur="checkUsername()" value="<?php echo $get_bc_name; ?>" required>
                                                    <div id="status"></div>

                                                </div>

                                                <div class="col-md-5">
                                                    <label>Bakuna Center Address : </label>
                                                    <input type="text" class="form-control" id="bc_address" name="bc_address" placeholder="Bakuna Center Full Address" onblur="checkUsername()" value="<?php echo $get_bc_address; ?>" required>
                                                    <div id="status"></div>

                                                </div>
                                            </div></br>

                                            <div class="box-footer" align="center">

                                                <button type="submit" id="btnSubmit" name="update_bakuna_center" class="btn btn-success">
                                                    <i class="fa fa-check fa-fw"> </i>
                                                    <!-- <h5>Update Form</h4> -->
                                                </button>

                                                <a href="list_bakuna_center.php">
                                                    <button type="button" name="cancel" class="btn btn-danger">
                                                        <i class="fa fa-close fa-fw"> </i> </button>
                                                </a>
                                            </div><br>
                                        </div>
                                    </div>
                                </div>
                        </form>
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
    <!-- DataTables Bootstrap -->
    <script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js"></script>
    <script src="../plugins/sweetalert/sweetalert.min.js"></script>


    <script>
        $('#users').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            'autoHeight': true,
            initComplete: function() {
                this.api().columns([4]).every(function() {
                    var column = this;
                    var select = $('<select class="form-control select2"><option value="">show all</option></select>')
                        .appendTo('#combo')
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }

        });
        $('.select2').select2();
    </script>
</body>

</html>