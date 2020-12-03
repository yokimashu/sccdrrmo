<?php

session_start();

$now = new DateTime();

$entity_no = $date_register = $user_name = $firstname = $middlename = $lastname = $birthdate = $age = $gender = $barangay = $street =
    $city = $province = $mobile_no = $telephone_no = $email = $individual = $individual2 =  $fullname = $entity_no1 = $fullname1 = $photo = '';

$btnSave = $btnEdit = "";
$btnNew = 'hidden';
$btn_enabled = 'enabled';
$img = '';


if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
$user_id = $_SESSION['id'];

include('../config/db_config.php');
include('insert_individual.php');
include('sql_individual.php');
// include('verify_admin.php');

$get_all_brgy_sql = "SELECT * FROM tbl_barangay";
$get_all_brgy_data = $con->prepare($get_all_brgy_sql);
$get_all_brgy_data->execute();



$province = 'NEGROS OCCIDENTAL ';
$city = 'SAN CARLOS CITY';
// $photo1 = '1601524087.jpg';

$title = 'VAMOS | COVID-19 Patient Form';

?>


<!DOCTYPE html>
<html>

<head>
    <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $title; ?></title>
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

    <link rel="stylesheet" href="../plugins/pixelarity/pixelarity.css">
    <!-- <link rel="stylesheet" href="../plugins/pixelarity/jquerysctipttop.css"> -->
    <!-- <link rel="stylesheet" href="../plugins/toastr/toastr.min.css"> -->

    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
    <!-- <link rel="stylesheet" href="../plugins/datatables/jquery.dataTables.css"> -->
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <script src="https://kit.fontawesome.com/629c6e6cbc.js" crossorigin="anonymous"></script>

    <!-- <style>
        #webcam {
            width: 350px;
            height: 350px;
            border: 1px solid black;
        }

        #photo {
            display: block;
            position: relative;
            margin-top: 40px;
        }

        .tabs a.active {

            background: lightgreen;

        }

        .nav-link>.active>a {
            color: aqua;
            background-color: chartreuse;
        }

        .nav-item>a:hover {
            color: aqua;
        }
    </style> -->

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

                    <div class="card-header p-2 bg-success text-white">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">PRINT INDIVIDUAL</a></li>
                            <li class="nav-item"><a class="nav-link" href="#profilepicture" data-toggle="tab">FORM 2 </a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">FORM 3</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="box-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="activity">

                                    <form action=" ">

                                        <div class="col-md-8">
                                            <a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/entity_multi.php?entity_no=<?php echo $entity_no; ?>&entity_no1=<?php echo $entity_no1; ?>&fullname1=<?php echo $fullname1; ?>&street1=<?php echo $street1; ?>">

                                                <i class="nav-icon fa fa-print"></i></a>
                                        </div>
                                        <br>


                                        <div class="row">

                                            <div class="col-md-8">
                                                <label> PRINT 1: </label>
                                                <select class="form-control select2" id="entity1" style="width: 100%;" name="entity_no" value="<?php echo $entity_no; ?>">
                                                    <option>Please select...</option>

                                                </select>
                                            </div>


                                            <video id="webcam" autoplay playsinline width="100" height="100" align="center" hidden class="photo  img-thumbnail"></video>
                                            <canvas id="canvas" class="d-none" hidden width="100" height="100" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>

                                            <img src="../flutter/images/<?php echo $photo; ?>" id="tphoto" style="height: 100px; width:100px;margin:auto;" class="photo img-thumbnail">

                                            <div style="margin:auto">
                                                <div class="col-12" style="margin:auto;margin-top:30px;margin-bottom:30px">
                                                    <span class="align-baseline">
                                                        <input type="hidden" name="image" class="image-tag" value=<?php echo $img; ?>>


                                                    </span>
                                                </div>

                                            </div>




                                        
                                            <div class="row">
                                            <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="entity_no" name="entity_no" placeholder="entity_no">
                                                    </div>

                                                    <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="fullname" name="fullname" placeholder="fullname">
                                            
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="street" name="street" placeholder="street">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="barangay" name="barangay" placeholder="barangay">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="mobile_no" name="mobile_no" placeholder="mobile_no">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="photo" name="photo" placeholder="photo1">
                                                </div>
                                                </div>

                                        


                                            <br>

                                            <!-- //PRINT 2 -->






                                            <div class="col-md-8">
                                                <label> PRINT 2: </label>
                                                <select class="form-control select2" id="entity2" style="width: 100%;" name="entity_no" value="<?php echo $entity_no; ?>">
                                                    <option>Please select...</option>

                                                </select>
                                            </div>


                                            <video id="webcam" autoplay playsinline width="100" height="100" align="center" hidden class="photo  img-thumbnail"></video>
                                            <canvas id="canvas" class="d-none" hidden width="100" height="100" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>

                                            <img src="../flutter/images/<?php echo $photo; ?>" id="tphoto1" style="height: 100px; width:100px;margin:auto;" class="photo img-thumbnail">

                                            <div style="margin:auto">
                                                <div class="col-12" style="margin:auto;margin-top:30px;margin-bottom:30px">
                                                    <span class="align-baseline">
                                                        <input type="hidden" name="image" class="image-tag" value=<?php echo $img; ?>>


                                                    </span>
                                                </div>

                                            </div>



                                            <div class="row">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="entity_no1" name="entity_no1" placeholder="entity_no1">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="fullname1" name="fullname1" placeholder="fullname1">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="street1" name="street1" placeholder="street1">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="barangay1" name="barangay1" placeholder="barangay1">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="mobile_no1" name="mobile_no1" placeholder="mobile_no1">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="photo1" name="photo1" placeholder="photo1">
                                                </div>
                                            </div>





                                            <br>

                                            <!-- //PRINT 3 -->
                                            <div class="col-md-8">
                                                <label> PRINT 3: </label>
                                                <select class="form-control select2" id="entity3" style="width: 100%;" name="entity_no" value="<?php echo $entity_no; ?>">
                                                    <option>Please select...</option>

                                                </select>
                                            </div>


                                            <video id="webcam" autoplay playsinline width="100" height="100" align="center" hidden class="photo  img-thumbnail"></video>
                                            <canvas id="canvas" class="d-none" hidden width="100" height="100" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>

                                            <img src="../flutter/images/<?php echo $photo; ?>" id="tphoto3" style="height: 100px; width:100px;margin:auto;" class="photo img-thumbnail">

                                            <div style="margin:auto">
                                                <div class="col-12" style="margin:auto;margin-top:30px;margin-bottom:30px">
                                                    <span class="align-baseline">
                                                        <input type="hidden" name="image" class="image-tag" value=<?php echo $img; ?>>


                                                    </span>
                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="entity_no3" name="entity_no3" placeholder="entity_no3">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="fullname3" name="fullname3" placeholder="fullname3">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="street3" name="street3" placeholder="street3">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="barangay3" name="barangay3" placeholder="barangay3">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="mobile_no3" name="mobile_no3" placeholder="mobile_no3">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="photo3" name="photo3" placeholder="photo3">
                                                </div>
                                            </div>


                                            <br>

                                            <!-- //PRINT 4 -->

                                            <div class="col-md-8">
                                                <label> PRINT 4: </label>
                                                <select class="form-control select2" id="entity4" style="width: 100%;" name="entity_no" value="<?php echo $entity_no; ?>">
                                                    <option>Please select...</option>

                                                </select>
                                            </div>


                                            <video id="webcam" autoplay playsinline width="100" height="100" align="center" hidden class="photo  img-thumbnail"></video>
                                            <canvas id="canvas" class="d-none" hidden width="100" height="100" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>

                                            <img src="../flutter/images/<?php echo $photo; ?>" id="tphoto4" style="height: 100px; width:100px;margin:auto;" class="photo img-thumbnail">

                                            <div style="margin:auto">
                                                <div class="col-12" style="margin:auto;margin-top:30px;margin-bottom:30px">
                                                    <span class="align-baseline">
                                                        <input type="hidden" name="image" class="image-tag" value=<?php echo $img; ?>>


                                                    </span>
                                                </div>

                                            </div>

                                            <div class="row">
                                           
                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="entity_no4" name="entity_no4" placeholder="entity_no4">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="fullname4" name="fullname4" placeholder="fullname4">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="street4" name="street4" placeholder="street4">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="barangay4" name="barangay4" placeholder="barangay4">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="mobile_no4" name="mobile_no4" placeholder="mobile_no4">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="photo4" name="photo4" placeholder="photo4">
                                                    </div>
                                                </div>
                                         

                                            <br>

                                            <!-- //PRINT 5 -->
                                            <div class="col-md-8">
                                                <label> PRINT 5: </label>
                                                <select class="form-control select2" id="entity5" style="width: 100%;" name="entity_no" value="<?php echo $entity_no; ?>">
                                                    <option>Please select...</option>

                                                </select>
                                            </div>


                                            <video id="webcam" autoplay playsinline width="100" height="100" align="center" hidden class="photo  img-thumbnail"></video>
                                            <canvas id="canvas" class="d-none" hidden width="100" height="100" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>

                                            <img src="../flutter/images/<?php echo $photo; ?>" id="tphoto5" style="height: 100px; width:100px;margin:auto;" class="photo img-thumbnail">

                                            <div style="margin:auto">
                                                <div class="col-12" style="margin:auto;margin-top:30px;margin-bottom:30px">
                                                    <span class="align-baseline">
                                                        <input type="hidden" name="image" class="image-tag" value=<?php echo $img; ?>>


                                                    </span>
                                                </div>

                                            </div>

                                            <div class="row">

                                              
                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="entity_no5" name="entity_no5" placeholder="entity_no5">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="fullname5" name="fullname5" placeholder="fullname5">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="street5" name="street5" placeholder="street5">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="barangay5" name="barangay5" placeholder="barangay5">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="mobile_no5" name="mobile_no5" placeholder="mobile_no5">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control" id="photo5" name="photo5" placeholder="photo5">
                                                    </div>
                                          
                                            </div>
                                  

                                        <br>

                                        <!-- //PRINT 6 -->

                                        <div class="col-md-8">
                                            <label> PRINT 6: </label>
                                            <select class="form-control select2" id="entity6" style="width: 100%;" name="entity_no" value="<?php echo $entity_no; ?>">
                                                <option>Please select...</option>

                                            </select>
                                        </div>


                                        <video id="webcam" autoplay playsinline width="100" height="100" align="center" hidden class="photo  img-thumbnail"></video>
                                        <canvas id="canvas" class="d-none" hidden width="100" height="100" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>

                                        <img src="../flutter/images/<?php echo $photo; ?>" id="tphoto6" style="height: 100px; width:100px;margin:auto;" class="photo img-thumbnail">

                                        <div style="margin:auto">
                                            <div class="col-12" style="margin:auto;margin-top:30px;margin-bottom:30px">
                                                <span class="align-baseline">
                                                    <input type="hidden" name="image" class="image-tag" value=<?php echo $img; ?>>


                                                </span>
                                            </div>

                                        </div>

                                        <div class="row">
                                          
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="entity_no6" name="entity_no6" placeholder="entity_no6">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="fullname6" name="fullname6" placeholder="fullname6">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="street6" name="street6" placeholder="street6">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="barangay6" name="barangay6" placeholder="barangay6">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="mobile_no6" name="mobile_no6" placeholder="mobile_no6">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="photo6" name="photo6" placeholder="photo6">
                                                </div>
                                           
                                        </div>


                                        <!-- //PRINT 7 -->

                                        <div class="col-md-8">
                                            <label> PRINT 7: </label>
                                            <select class="form-control select2" id="entity7" style="width: 100%;" name="entity_no" value="<?php echo $entity_no; ?>">
                                                <option>Please select...</option>

                                            </select>
                                        </div>


                                        <video id="webcam" autoplay playsinline width="100" height="100" align="center" hidden class="photo  img-thumbnail"></video>
                                        <canvas id="canvas" class="d-none" hidden width="100" height="100" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>

                                        <img src="../flutter/images/<?php echo $photo; ?>" id="tphoto7" style="height: 100px; width:100px;margin:auto;" class="photo img-thumbnail">

                                        <div style="margin:auto">
                                            <div class="col-12" style="margin:auto;margin-top:30px;margin-bottom:30px">
                                                <span class="align-baseline">
                                                    <input type="hidden" name="image" class="image-tag" value=<?php echo $img; ?>>


                                                </span>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="form-group">
                                                <input type="text" readonly class="form-control" id="entity_no7" name="entity_no7" placeholder="entity_no7">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" readonly class="form-control" id="fullname7" name="fullname7" placeholder="fullname7">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" readonly class="form-control" id="street7" name="street7" placeholder="street7">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" readonly class="form-control" id="barangay7" name="barangay7" placeholder="barangay7">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" readonly class="form-control" id="mobile_no7" name="mobile_no7" placeholder="mobile_no7">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" readonly class="form-control" id="photo7" name="photo7" placeholder="photo7">
                                            </div>
                                        </div>


                                        <!-- //PRINT 8 -->

                                        <div class="col-md-8">
                                            <label> PRINT 8: </label>
                                            <select class="form-control select2" id="entity8" style="width: 100%;" name="entity_no" value="<?php echo $entity_no; ?>">
                                                <option>Please select...</option>

                                            </select>
                                        </div>


                                        <video id="webcam" autoplay playsinline width="100" height="100" align="center" hidden class="photo  img-thumbnail"></video>
                                        <canvas id="canvas" class="d-none" hidden width="100" height="100" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>

                                        <img src="../flutter/images/<?php echo $photo; ?>" id="tphoto8" style="height: 100px; width:100px;margin:auto;" class="photo img-thumbnail">

                                        <div style="margin:auto">
                                            <div class="col-12" style="margin:auto;margin-top:30px;margin-bottom:30px">
                                                <span class="align-baseline">
                                                    <input type="hidden" name="image" class="image-tag" value=<?php echo $img; ?>>


                                                </span>
                                            </div>

                                        </div>

                                        <div class="row">
                                          
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="entity_no8" name="entity_no8" placeholder="entity_no8">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="fullname8" name="fullname8" placeholder="fullname8">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="street8" name="street8" placeholder="street8">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="barangay8" name="barangay8" placeholder="barangay8">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="mobile_no8" name="mobile_no8" placeholder="mobile_no8">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="photo8" name="photo8" placeholder="photo8">
                                                </div>
                                           
                                        </div>



                                        <!-- //PRINT 9 -->

                                        <div class="col-md-8">
                                            <label> PRINT 9: </label>
                                            <select class="form-control select2" id="entity9" style="width: 100%;" name="entity_no" value="<?php echo $entity_no; ?>">
                                                <option>Please select...</option>

                                            </select>
                                        </div>


                                        <video id="webcam" autoplay playsinline width="100" height="100" align="center" hidden class="photo  img-thumbnail"></video>
                                        <canvas id="canvas" class="d-none" hidden width="100" height="100" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>

                                        <img src="../flutter/images/<?php echo $photo; ?>" id="tphoto9" style="height: 100px; width:100px;margin:auto;" class="photo img-thumbnail">

                                        <div style="margin:auto">
                                            <div class="col-12" style="margin:auto;margin-top:30px;margin-bottom:30px">
                                                <span class="align-baseline">
                                                    <input type="hidden" name="image" class="image-tag" value=<?php echo $img; ?>>


                                                </span>
                                            </div>

                                        </div>

                                        <div class="row">
                                          
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="entity_no9" name="entity_no9" placeholder="entity_no9">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="fullname9" name="fullname9" placeholder="fullname9">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="street9" name="street9" placeholder="street9">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="barangay9" name="barangay9" placeholder="barangay9">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="mobile_no9" name="mobile_no9" placeholder="mobile_no9">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="photo9" name="photo9" placeholder="photo9">
                                                </div>
                                          
                                        </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>





                </form>

        </div>

        <div class="tab-pane" id="profilepicture">

        </div>
    </div>
    </div>
    </div>
    </div>

    </section>
    </div>


    <?php include('footer.php') ?>

    </div>



    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <!-- <script src="../dist/css/jquery-ui.min.js"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        // $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Morris.js charts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
    <!-- <script src="../plugins/morris/morris.min.js"></script> -->
    <!-- Sparkline -->
    <!-- <script src="../plugins/sparkline/jquery.sparkline.min.js"></script> -->
    <!-- jvectormap -->
    <!-- <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
    <!-- <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
    <!-- jQuery Knob Chart -->
    <!-- <script src="../plugins/knob/jquery.knob.js"></script> -->
    <!-- daterangepicker -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script> -->
    <!-- <script src="../plugins/daterangepicker/daterangepicker.js"></script> -->
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

    <script src="../plugins/pixelarity/pixelarity-face.js"></script>
    <script src="../plugins/cameracapture/webcam-easy.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- <script type="text/javascript" src="../plugins/cameracapture/photo_template.js"></script> -->
    <!-- <script src="../plugins/webcamjs/webcam.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->
    <!-- textarea wysihtml style -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- Select2 -->

    <script src="../plugins/select2/select2.full.min.js"></script>


    <!-- Page script -->
    <!-- 
    <script language="JavaScript">
        $('.select2').select2();
    </script>
     -->






    <script>
        $('#entity1').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_individual.php',
                data: {
                    entity_no: entity_no
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
                    $('#entity_no').val(result.data);
                    $('#fullname').val(result.data1);
                    $('#street').val(result.data2);
                    $('#barangay').val(result.data3);
                    $('#mobile_no').val(result.data4);
                    $('#photo').val(result.data5);

                    // $('#photo').val(result.data5);
                    $('#tphoto').attr("src", "../flutter/images/" + result.data5);

                },

            });

        });

        $(function() {

            //Initialize Select2 Elements
            $('.select2').select2();
            $("#entity1").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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
    </script>


    <script>
        //PRINT 2

        $('#entity2').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_individual.php',
                data: {
                    entity_no: entity_no
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
                    $('#entity_no1').val(result.data);
                    $('#fullname1').val(result.data1);
                    $('#street1').val(result.data2);
                    $('#barangay1').val(result.data3);
                    $('#mobile_no1').val(result.data4);
                    $('#photo1').val(result.data5);
                    $('#tphoto1').attr("src", "../flutter/images/" + result.data5);

                },


            });

        });

        $(function() {

            //Initialize Select2 Elements
            $('.select3').select2();
            $("#entity2").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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

        //PRINT 3

        $('#entity3').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_individual.php',
                data: {
                    entity_no: entity_no
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
                    $('#entity_no3').val(result.data);
                    $('#fullname3').val(result.data1);
                    $('#street3').val(result.data2);
                    $('#barangay3').val(result.data3);
                    $('#mobile_no3').val(result.data4);
                    $('#photo3').val(result.data5);
                    $('#tphoto3').attr("src", "../flutter/images/" + result.data5);

                },

            });

        });

        $(function() {

            //Initialize Select2 Elements
            $('.select4').select2();
            $("#entity3").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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



        //PRINT 4

        $('#entity4').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_individual.php',
                data: {
                    entity_no: entity_no
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
                    $('#entity_no4').val(result.data);
                    $('#fullname4').val(result.data1);
                    $('#street4').val(result.data2);
                    $('#barangay4').val(result.data3);
                    $('#mobile_no4').val(result.data4);
                    $('#photo4').val(result.data5);
                    $('#tphoto4').attr("src", "../flutter/images/" + result.data5);

                },

            });

        });

        $(function() {

            //Initialize Select2 Elements
            $('.select5').select2();
            $("#entity4").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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


        //PRINT 5

        $('#entity5').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_individual.php',
                data: {
                    entity_no: entity_no
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
                    $('#entity_no5').val(result.data);
                    $('#fullname5').val(result.data1);
                    $('#street5').val(result.data2);
                    $('#barangay5').val(result.data3);
                    $('#mobile_no5').val(result.data4);
                    $('#photo5').val(result.data5);
                    $('#tphoto5').attr("src", "../flutter/images/" + result.data5);

                },

            });

        });

        $(function() {

            //Initialize Select2 Elements
            $('.select6').select2();
            $("#entity5").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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

        //PRINT 6

        $('#entity6').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_individual.php',
                data: {
                    entity_no: entity_no
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
                    $('#entity_no6').val(result.data);
                    $('#fullname6').val(result.data1);
                    $('#street6').val(result.data2);
                    $('#barangay6').val(result.data3);
                    $('#mobile_no6').val(result.data4);
                    $('#photo6').val(result.data5);
                    $('#tphoto6').attr("src", "../flutter/images/" + result.data5);

                },

            });

        });

        $(function() {

            //Initialize Select2 Elements
            $('.select7').select2();
            $("#entity6").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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


        //PRINT 7

        $('#entity7').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_individual.php',
                data: {
                    entity_no: entity_no
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
                    $('#entity_no7').val(result.data);
                    $('#fullname7').val(result.data1);
                    $('#street7').val(result.data2);
                    $('#barangay7').val(result.data3);
                    $('#mobile_no7').val(result.data4);
                    $('#photo7').val(result.data5);
                    $('#tphoto7').attr("src", "../flutter/images/" + result.data5);

                },

            });

        });

        $(function() {

            //Initialize Select2 Elements
            $('.select8').select2();
            $("#entity7").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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


        //PRINT 8

        $('#entity8').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_individual.php',
                data: {
                    entity_no: entity_no
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
                    $('#entity_no8').val(result.data);
                    $('#fullname8').val(result.data1);
                    $('#street8').val(result.data2);
                    $('#barangay8').val(result.data3);
                    $('#mobile_no8').val(result.data4);
                    $('#photo8').val(result.data5);
                    $('#tphoto8').attr("src", "../flutter/images/" + result.data5);

                },

            });

        });

        $(function() {

            //Initialize Select2 Elements
            $('.select9').select2();
            $("#entity8").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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


        //PRINT 9

        $('#entity9').on('change', function() {
            var entity_no = this.value;
            console.log(entity_no);
            $.ajax({
                type: "POST",
                url: 'sql_query_get_individual.php',
                data: {
                    entity_no: entity_no
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
                    $('#entity_no9').val(result.data);
                    $('#fullname9').val(result.data1);
                    $('#street9').val(result.data2);
                    $('#barangay9').val(result.data3);
                    $('#mobile_no9').val(result.data4);
                    $('#photo9').val(result.data5);
                    $('#tphoto9').attr("src", "../flutter/images/" + result.data5);

                },

            });

        });

        $(function() {

            //Initialize Select2 Elements
            $('.select10').select2();
            $("#entity9").select2({
                //  minimumInputLength: 3,
                // placeholder: "hello",
                ajax: {
                    url: "individual_query", // json datasource
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




        $(document).ready(function() {
            $('#printlink').click(function() {

                var entity_no = $('#entity_no').val();
                //PRINT 2
                var entity_no1 = $('#entity_no1').val();
                var fullname1 = $('#fullname1').val();
                var street1 = $('#street1').val();
                var barangay1 = $('#barangay1').val();
                var mobile_no1 = $('#mobile_no1').val();
                var photo1 = $('#photo1').val();
                //PRINT 3
                var entity_no3 = $('#entity_no3').val();
                var fullname3 = $('#fullname3').val();
                var street3 = $('#street3').val();
                var barangay3 = $('#barangay3').val();
                var mobile_no3 = $('#mobile_no3').val();
                var photo3 = $('#photo3').val();
                //PRINT 4
                var entity_no4 = $('#entity_no4').val();
                var fullname4 = $('#fullname4').val();
                var street4 = $('#street4').val();
                var barangay4 = $('#barangay4').val();
                var mobile_no4 = $('#mobile_no4').val();
                var photo4 = $('#photo4').val();
                //PRINT 5
                var entity_no5 = $('#entity_no5').val();
                var fullname5 = $('#fullname5').val();
                var street5 = $('#street5').val();
                var barangay5 = $('#barangay5').val();
                var mobile_no5 = $('#mobile_no5').val();
                var photo5 = $('#photo5').val();
                //PRINT 6
                var entity_no6 = $('#entity_no6').val();
                var fullname6 = $('#fullname6').val();
                var street6 = $('#street6').val();
                var barangay6 = $('#barangay6').val();
                var mobile_no6 = $('#mobile_no6').val();
                var photo6 = $('#photo6').val();
                //PRINT 7
                var entity_no7 = $('#entity_no7').val();
                var fullname7 = $('#fullname7').val();
                var street7 = $('#street7').val();
                var barangay7 = $('#barangay7').val();
                var mobile_no7 = $('#mobile_no7').val();
                var photo7 = $('#photo7').val();
                //PRINT 8
                var entity_no8 = $('#entity_no8').val();
                var fullname8 = $('#fullname8').val();
                var street8 = $('#street8').val();
                var barangay8 = $('#barangay8').val();
                var mobile_no8 = $('#mobile_no8').val();
                var photo8 = $('#photo8').val();
                //PRINT 9
                var entity_no9 = $('#entity_no9').val();
                var fullname9 = $('#fullname9').val();
                var street9 = $('#street9').val();
                var barangay9 = $('#barangay9').val();
                var mobile_no9 = $('#mobile_no9').val();
                var photo9 = $('#photo9').val();

                console.log(entity_no);
                var param = "entity_no=" + entity_no +
                    "&entity_no1=" + entity_no1 + "&fullname1=" + fullname1 + "&street1=" + street1 + "&barangay1=" + barangay1 + "&mobile_no1=" + mobile_no1 + "&photo1=" + photo1 +
                    "&entity_no3=" + entity_no3 + "&fullname3=" + fullname3 + "&street3=" + street3 + "&barangay3=" + barangay3 + "&mobile_no3=" + mobile_no3 + "&photo3=" + photo3 +
                    "&entity_no4=" + entity_no4 + "&fullname4=" + fullname4 + "&street4=" + street4 + "&barangay4=" + barangay4 + "&mobile_no4=" + mobile_no4 + "&photo4=" + photo4 +
                    "&entity_no5=" + entity_no5 + "&fullname5=" + fullname5 + "&street5=" + street5 + "&barangay5=" + barangay5 + "&mobile_no5=" + mobile_no5 + "&photo5=" + photo5 +
                    "&entity_no6=" + entity_no6 + "&fullname6=" + fullname6 + "&street6=" + street6 + "&barangay6=" + barangay6 + "&mobile_no6=" + mobile_no6 + "&photo6=" + photo6 +
                    "&entity_no7=" + entity_no7 + "&fullname7=" + fullname7 + "&street7=" + street7 + "&barangay7=" + barangay7 + "&mobile_no7=" + mobile_no7 + "&photo7=" + photo7 +
                    "&entity_no8=" + entity_no8 + "&fullname8=" + fullname8 + "&street8=" + street8 + "&barangay8=" + barangay8 + "&mobile_no8=" + mobile_no8 + "&photo8=" + photo8 +
                    "&entity_no9=" + entity_no9 + "&fullname9=" + fullname9 + "&street9=" + street9 + "&barangay9=" + barangay9 + "&mobile_no9=" + mobile_no9 + "&photo9=" + photo9 +

                    "";

                $('#printlink').attr("href", "../plugins/jasperreport/entity_multi.php?" + param, '_parent');
            })
        });
    </script>







</body>

</html>