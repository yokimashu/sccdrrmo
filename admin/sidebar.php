<!-- navbar and sidebar -->
<style>
  label {

    font-size: 16px;
    color: green;

  }

  .fas,
  .icons,
  #icons {
    color: black;
  }




  p {
    color: green;
  }

  .sidebar-link:hover,
  #lightgreen:hover {

    background-color: lightgreen;
  }


  /* .top-link{

  } */
  .top-link:hover {
    background-color: green;
    color: black;
  }

  #label1::after {
    content: '';
    display: block;
    position: absolute;

    background-color: black;
    width: 200px;
    height: 1px;


    /* bottom: -3px; */
  }
</style>
<?php
include_once('session.php');
include('../config/db_config.php');
include('send_notification.php');
include('user_controls.php');
include('unread_messages.php');
// include('session.php');


// include ('../config/db_config.php');
// session_start();
// $user_id = $_SESSION['id'];

// if (!isset($_SESSION['id'])) {
//     header('location:../index.php');
// } else {

// }
$user_id = $_SESSION['id'];

$db_fullname = '';
$photo = '';

//fetch user from database
$get_user_sql = " SELECT CONCAT(firstname,' ',LEFT(middlename, 1),'. ',lastname) as fullname FROM tbl_users where id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result4 = $user_data->fetch(PDO::FETCH_ASSOC)) {
  $db_fullname = $result4['fullname'];
  // $photo = $result4['photo'];
}

//get all draft from announcement
$get_all_draft_sql = "SELECT * FROM tbl_announcement WHERE status = 'draft'";
$get_all_draft_data = $con->prepare($get_all_draft_sql);
$get_all_draft_data->execute();
$numberofdraft = $get_all_draft_data->rowCount();

//get all new report from report pum/pui
$get_all_newreport_sql = "SELECT * FROM tbl_reportpum WHERE remarks = 'NEW REPORT'";
$get_all_newreport_data = $con->prepare($get_all_newreport_sql);
$get_all_newreport_data->execute();
$numberofnewreport = $get_all_newreport_data->rowCount();

?>

<nav class="main-header navbar navbar-expand greenBG navbar-light border-bottom">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">VAMOS | SYSTEM</a>
    </li>


    <li class="nav-item">
      <a href="index" class="nav-link ">HOME PAGE</a>
    </li>


    <!-- <li class="nav-item">
      <a href="announcement" class="nav-link ">
      
        ANNOUNCEMENTS
   
      </a>
    </li> -->


  </ul>

  <ul class="navbar-nav ml-auto">
    <!-- <li class="nav-item">
      <a href="#" class="nav-link">Contact Us</a>
    </li> -->


    <!-- <li class="nav-item">
      <a href="#" class="nav-link">About Us</a>
    </li>

    <li class="nav-item">
      <a href="#" class="nav-link">Profile</a>
    </li> -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"><?php echo $unread_messages; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
          </a>
        </div>
      </li> -->




    </ul>



</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <div class="greenBG">

    <!-- <a href="index" class="brand-link">  
      <img src="../dist/img/scdrrmo_logo.png" class="img-circle elevation-2" width="40px">   
    </a> -->

    <!-- Sidebar -->

    <!-- Sidebar user panel (optional) -->
    <div class="sidebar">
      &nbsp; &nbsp; &nbsp; &nbsp;
      <img src="../dist/img/final_logo_white.png" width="150px" height="80px">

      <label style="color:white" class="d-block">
        &nbsp; &nbsp;
        <?php echo strtoupper($db_fullname) ?> </label>

      <!-- <div class="user-panel mt-2 pb-2 mb-2 d-flex"> -->
      <!-- <div class="image">
          <img src="../dist/img/vamoslogo-png.png" class="img-circle elevation-2" alt="User Image">
        </div> -->

      <!-- 

        <div class="info" align="center">

        </div>

      </div> -->

    </div>

  </div>
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->



        <?php
        echo $entities;

        ?>


        <?php
        // masterlist enities
        // echo $single_break;
        // end of masterlist entities


        // masterlist in symptoms

        // echo $label_masterlist;
        // echo $masterlist_symptoms;
        // echo $single_break;


        // masterlist for covid-19
        echo $label_covid_case;
        echo $list_close_contact;
        echo $list_positive_case;
        echo $single_break;


        ?>





        <?php echo $label_vaccination; ?>
        <?php echo $vaccine_dashboard; ?>
        <?php echo $list_vaccine; ?>
        <?php echo $list_assessment; ?>
        <?php echo $list_schedule; ?>
        <?php echo $list_bakuna_center; ?>
        <?php echo $list_vaccinators; ?>
        <?php echo $single_break; ?>
        <!-- end of masterlist of covid-19 -->

        <div>
          <label id="label1" style="font-size:18px; ">
            &nbsp;
            <i class="fas fa-print nav-icon icons"></i>
            &nbsp;
            REPORT
          </label>

          <?php echo $list_categorylist; ?>
          <?php echo $list_vaccine_report; ?>
          <?php echo $list_vaccine_report_no; ?>
          <?php echo $list_eligible_report; ?>
          <?php echo $list_vaccine_linelist; ?>
         
          <?php echo $list_astrazeneca; ?>
          <?php echo $vaccine_sandoc; ?>
          <?php echo $list_deped_report; ?>
     
          <?php echo $daily_report; ?>




          <li class="nav-item">
            <a href="print_individual" class="nav-link sidebar-link">
              &nbsp;
              <i class="fas fa-qrcode icons nav-icon"></i>
              <p> &nbsp; Multiple QR</p>
            </a>
          </li>

        </div><br>


        <div>

          <label id="label1" style="font-size:18px; ">
            &nbsp;
            <i class="nav-icon fa fa-info-circle icons"></i>
            &nbsp;
            ABOUT US
          </label>


          <li class="nav-item">
            <a href="information" class="nav-link sidebar-link">
              &nbsp;
              <i class="nav-icon fa fa-question icons"></i>
              <p> &nbsp; Information</p>
            </a>
          </li>


          <li class="nav-item">
            <a href="download_app" class="nav-link sidebar-link">
              &nbsp;
              <i class="nav-icon fa fa-download icons"></i>
              <p> &nbsp; Download App</p>
            </a>
          </li>





          <li class="nav-item">
            <a href="how_to_register" class="nav-link sidebar-link">
              &nbsp;
              <i class="far fa-id-badge nav-icon icons"></i>
              <p> &nbsp; How to Register</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="scan_qrcode" class="nav-link sidebar-link">
              &nbsp;
              <i class="fas fa-qrcode icons nav-icon"></i>
              <p> &nbsp; Scan QR Code</p>
            </a>
          </li>


          <li class="nav-item">
            <a href="privacy_terms" class="nav-link sidebar-link">
              &nbsp;
              <i class="fas fa-database nav-icon icons"></i>
              <p> &nbsp; Privacy Policy </p>
            </a>
          </li>


        </div> <br>



        <div>


          <?php echo $settings; ?>
          <?php echo $mobile_alert; ?>
          <?php echo $registration_list; ?>
          <?php echo $post_announce_last; ?>
          <?php echo $incident_report ?>
        </div><br>

        <div>

          <label id="label1" style="font-size:18px; ">
            &nbsp;
            <i class="nav-icon fa fa-lock icons"></i>
            &nbsp;
            ACCOUNT
          </label>



          <li class="nav-item">
            <a href="edit_profile" class="nav-link sidebar-link">
              &nbsp;
              <i class="nav-icon fa fa-pencil-square-o icons"></i>
              <p> &nbsp; Edit Profile</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../index" class="nav-link  sidebar-link">
              &nbsp;
              <i class="fa fa-sign-out nav-icon icons"></i>
              <p> &nbsp; Sign Out</p>
            </a>
          </li>



        </div><br>







        <?php echo $break; ?>













        <!-- <li class="nav-item has-treeview" style="font-size:16px">
          <a href="../index" class="nav-link">
            <i class="fa fa-sign-out nav-icon"></i>
            <p>SIGN OUT</p>
          </a>


        </li> -->





      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->

  <?php include('push_notification.php'); ?>

</aside>