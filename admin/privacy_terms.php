<?php

include('../config/db_config.php');

session_start();
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {
}


//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


    $db_fullname = $result['fullname'];
}




?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>VAMOS | Data Privacy & Terms </title>
    <?php include('heading.php'); ?>


    <style>
        #information {
            font-size: 20px;
            padding-left: 60px;

        }

        #list-office {
            font-size: 20px;
            padding-left: 110px;
            color: green;
        }

        #hand-login {
            width: 400px;
            height: 800px;
        }

        #app_label {
            font-size: 25px;
            text-decoration: underline;
        }

        #number {
            width: 50px;
            height: 50px;
        }


        #fbpage:hover {

            background-color: lightgreen;
        }


        #text-english {
            font-size: 20px;
            font-weight: normal !important;
            line-height: 1;

        }

        #list-privacy {
            padding-left: 140px;
            font-size: 20px;
            color: green;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            border-color: green;
            color: green;


        }

        th,
        td {
            padding: 15px;
        }

        .specs {
            padding-left: 80px;
        }
    </style>

</head>



<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include('sidebar.php'); ?>

        <div class="content-wrapper">
            <div class="content-header"></div>


            <section class="content">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4> VAMOS MOBILE PRIVACY POLICY </h4>

                    </div>
                    <div class="card-body">
                        <div class="box-body">
                            <div class="card">
                                <br>
                                <p id="information">

                                    <b>VAMOS MOBILE PRIVACY POLICY</b>
                                    <br><br>



                                    VAMOS MOBILE is the official contact tracing mobile application of San Carlos City,
                                    Negros Occidental, Philippines. It is <br> designed to register entities, such as individual,
                                    juridical and transportation, for the monitoring of their activities for easier <br> and faster contact tracing.
                                    <br><br>


                                    Keeping track of citizens’ whereabouts is important in fighting against coronavirus. So whenever you go out in public places such
                                    as malls, markets, offices, churches, schools, government offices and other buildings or establishments, please make sure to use your
                                    VAMOS mobile application or ID to record your activities. VAMOS helps the government track people in close contact with suspected patients.
                                    Here are some of the objectives in using the app: <br>

                                </p>



                                <ol id="list-privacy">
                                    <li>To keep an eye on citizens’ whereabouts;</li>
                                    <li>To ensure people follow quarantine protocols;</li>
                                    <li>To avoid long queues;</li>
                                    <li>To help students, workers and residents stay safe;</li>
                                    <li>To make it safer for customers to dine-in; </li>
                                    <li>To collect medical information; </li>
                                    <li>To enlighten people on their likelihood of infection;</li>
                                    <li>To register visitors’ from neighboring towns and cities;</li>
                                    <li>To track the movement of residents;</li>
                                    <li>To encourage people to use digital tools.</li>
                                </ol>


                                <p id="information">

                                    It is your right as data subjects to be informed how we process your personal information.
                                    This Privacy Policy applies to <br> all entities who register via the mobile application.
                                    VAMOS deserves the right to update this policy from time to time.
                                    <br><br><br>

                                    <b>OUR PRIVACY NOTICE</b>
                                    <br><br>


                                    VAMOS collects the following information from you when you submit to us your personal data record as seen in the
                                    <br> registration form you have completed.
                                    <br><br>

                                    The platform shall collect personal and sensitive personal information to ensure proper selection, management <br>
                                    and deployment of staff. This platform shall collect the following:
                                    <br><br>
                                </p>




                                <p id="information">
                                    &nbsp; &nbsp;
                                    <b> <u> FOR INDIVIDUAL </u></b>
                                    <br>
                                </p>

                                <div class="col-md-10 specs">

                                    <table>
                                        <tr>
                                            <th style="width: 30%">INFORMATION TITLE</th>
                                            <th style="width: 30%">TYPE OF PERSONAL INFORMATION</th>

                                        </tr>
                                        <!-- 1 -->
                                        <tr>
                                            <td>Username</td>
                                            <td>Sensitive Personal Information</td>

                                        </tr>
                                        <tr>
                                            <td>Password</td>
                                            <td>Sensitive Personal Information</td>

                                        </tr>
                                        <tr>
                                            <td>First Name</td>
                                            <td>Regular Personal Information</td>

                                        </tr>

                                        <tr>
                                            <td>Middle Name Initial</td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Last Name</td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Number</td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Telephone Number (Optional)</td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Email Address</td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Gender </td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Birthdate </td>
                                            <td> Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Street </td>
                                            <td> Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Barangay </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td> City </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td> Province </td>
                                            <td>Regular Personal Information</td>
                                        </tr>

                                        <tr>
                                            <td>Photo</td>
                                            <td> Sensitive Personal Information</td>
                                        </tr>


                                    </table>
                                </div>
                                <br><br><br>

                                <p id="information">
                                    &nbsp; &nbsp;
                                    <b> <u> FOR JURIDICAL </u></b>
                                    <br>
                                </p>
                                <div class="col-md-10 specs">
                                    <table>
                                        <tr>
                                            <th style="width: 30%">INFORMATION TITLE</th>
                                            <th style="width: 30%">TYPE OF PERSONAL INFORMATION</th>

                                        </tr>

                                        <tr>
                                            <td>Username </td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Password </td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Organization Name</td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Organization Type </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Business Nature</td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Street </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Barangay </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>City </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Province </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Contact Name </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Contact Name’s Position </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Number </td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Telephone Number </td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Email Address </td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Photo </td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>




                                    </table>
                                </div>
                                <br><br><br>


                                <p id="information">
                                    &nbsp; &nbsp;
                                    <b> <u> FOR TRANSPORTATION </u></b>
                                    <br>
                                </p>
                                <div class="col-md-10 specs ">
                                    <table>
                                        <tr>
                                            <th style="width: 30%">INFORMATION TITLE</th>
                                            <th style="width: 30%">TYPE OF PERSONAL INFORMATION</th>

                                        </tr>
                                        <tr>
                                            <td>Username </td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Password </td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Land Transportation Type </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Vehicle Name </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Vehicle Number </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Route </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Plate Number </td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Vessel Name </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Voyage Number </td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Port Embarkation </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Contact Name </td>
                                            <td>Regular Personal Information</td>
                                        </tr>
                                        <tr>
                                            <td>Contact Name’s Position </td>
                                            <td>Regular Personal Information</td>

                                        </tr>
                                        <tr>
                                            <td>Mobile Number </td>
                                            <td>Sensitive Personal Information</td>

                                        </tr>
                                        <tr>
                                            <td>Telephone Number </td>
                                            <td>Sensitive Personal Information</td>

                                        </tr>
                                        <tr>
                                            <td>Email Address </td>
                                            <td>Sensitive Personal Information</td>

                                        </tr>
                                        <tr>
                                            <td>Photo </td>
                                            <td>Sensitive Personal Information</td>
                                        </tr>


                                    </table>

                                </div>
                                <br><br><br>

                                <p id="information">

                                    It is important that we collect accurate information about the entity. If you feel that some of the information we collect <br>
                                    is not necessary, please feel free to contact us so that our technical team can explain why the information is important.
                                    <br><br>


                                    <b>WHY DO WE COLLECT YOUR PERSONAL DATA?</b>
                                    <br><br>

                                    The Information Technology and Computer Services Office (ITCSO), as the Personal Information Controller (PIC), <br>
                                    shall use your personal data to properly receive volunteer inquiries, forward them to appropriate internal units for <br> action
                                    and response, in a legitimate format and in orderly and timely manner.
                                    <br><br>

                                    <b>DO WE SHARE YOUR PERSONAL DATA TO OTHER INSTITUTIONS OR ORGANIZATIONS?</b>
                                    <br><br>

                                    YES, the platform has three other Personal Information Processors (PIPs), namely:
                                </p>
                                <ul id="list-office">
                                    <li> Office of the City Mayor</li>
                                    <li>City Health Office</li>
                                    <li>City Disaster Risk Reduction Management Office </li>
                                </ul>

                                <p id="information">
                                    with whom we may share your information solely for the purpose of contact tracing, data collection, organization, <br>
                                    communication and management, in accordance with the RA 10173 or the Data Privacy Act.
                                    <br><br>


                                    Together, the PPIs enable ITCSO to properly address inquiries, forward them to appropriate internal units for action <br>
                                    and response, in a legitimate format and in an orderly and timely manner.
                                    <br><br>

                                    <b>HOW DO WE SECURE YOUR PERSONAL DATA?</b>
                                    <br><br>

                                    Only authorized ITCSO personnel as well as staff from the above mentioned data processors will have access to the personal information on a need-to-know basis.
                                    The exchange of which will be facilitated through generation of reports. These data <br> will be
                                    stored in a secured database in accordance with the period provided by ITCSO.
                                    <br><br>

                                    All personal and sensitive information about you will be destroyed along with its erasure from the database, or in line with <br> either the individuals upon ITCSO decision.
                                    All personal and sensitive information process by ITCSO and authorized <br> personal information processor shall be kept under strict confidentiality for the entire period of retention.
                                    <br><br>

                                    <b>HOW CAN YOU CONTACT US?</b>
                                    <br><br>
                                    You have the right to ask for a copy of your personal information we hold about you, as well as to ask for it to be corrected <br> if you think it is erroneous.
                                    To do so, please contact Information Technology and Computer Services Office through the <br> following channels:
                                    <br><br>
                                    &nbsp; &nbsp;&nbsp; &nbsp; Telephone Number: <br>
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SACATEL - (034) 312-6152 <br>
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; GLOBELINES – (034) 729-3086 <br><br>

                                    &nbsp; &nbsp; &nbsp; &nbsp;E-mail Address: lgusccno.itcso@gmail.com <br><br>

                                    &nbsp; &nbsp;&nbsp; &nbsp; Facebook Page:
                                    <a href="https://www.facebook.com/lgusccno.itcso" style="color:green;" id="fbpage" target="_blank">
                                        <b> www.facebook.com/lgusccno.itcso</b>
                                    </a>


                                </p>





                                <br><br>




                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <br>
        </div>

        <?php include('footer.php'); ?>

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
    </script>





</body>

</html>