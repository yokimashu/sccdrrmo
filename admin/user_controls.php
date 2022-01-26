<?php

include('../config/db_config.php');

//get all draft from announcement



#


$get_all_draft_sql = "SELECT * FROM tbl_announcement WHERE status = 'draft'";
$get_all_draft_data = $con->prepare($get_all_draft_sql);
$get_all_draft_data->execute();
$numberofdraft = $get_all_draft_data->rowCount();


$post_announcepost_announce = '';
$get_individual_entity = ' ';

$break = '<br><br><br><br><br><br><br><br><br>';

//entitites
$entities = ' 
  <div>
    <label id="label1" style="font-size:18px; ">
      &nbsp;
      <i class="nav-icon fa fa-address-book icons "></i>
      &nbsp;
      ENTITIES
    </label>


    <li class="nav-item">
      <a href="list_individual" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fa fa-user icons"></i>
        <p> &nbsp; Individual</p>
      </a>
    </li>



    <li class="nav-item">
      <a href="list_juridical" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fa fa-building icons"></i>
        <p> &nbsp; Juridical</p>
      </a>
    </li>



    <li class="nav-item has-treeview">
      <a href="#" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fa fa-car icons "></i>
        <p> &nbsp; Transportation</p>
      </a>


      <ul class="nav nav-treeview ">


        <li class="nav-item">
          <a href="list_land_trans" id="lightgreen" class="nav-link ">
            &nbsp; &nbsp; &nbsp;

            <i class=" nav-icon fa fa-motorcycle icons"></i>
            <p> &nbsp; Land Trans.</p>
          </a>
        </li>

        <li class=" nav-item">
          <a href="list_sea_trans" id="lightgreen" class="nav-link ">
            &nbsp; &nbsp; &nbsp;

            <i class="nav-icon fa fa-ship icons"></i>
            <p> &nbsp; Sea Trans.</p>
          </a>
        </li>



      </ul>
    </li>
  </div><br>
';
$view_history = ' 
  <a class="btn btn-success btn-sm" id="view_history" href="view_individual_history.php?&entity_no=' . $get_individual_entity . '">
    <i class="fa fa-suitcase"></i>
  </a>
';
//end of entities


//masterlist
$label_masterlist = '
  <label id="label1" style="font-size:18px; ">
      &nbsp;
      <i class="nav-icon fas fa-clipboard-list icons"></i>

      &nbsp;
      MASTERLIST
  </label>
';
$masterlist_symptoms = '
  <li class="nav-item">
    <a href="list_symptoms" class="nav-link sidebar-link">
      &nbsp;
      <i class="nav-icon fas fa-head-side-cough icons"></i>
      <p>&nbsp; Signs & Symptoms </p>
    </a>
  </li>
';
//end of masterlist

//COVID 19 CASES
$content_covid_case = '
  <div>
    <label id="label1" style="font-size:18px; ">
          &nbsp;
          <i class="nav-icon fas fa-briefcase-medical icons "></i>
          &nbsp;
          COVID-19 CASES
    </label>
    <li class="nav-item">
      <a href="list_close_contact" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-id-card-alt icons"></i>
        <p> &nbsp; Close Contacts </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="list_sources_infection" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-check-square icons"></i>
        <p> &nbsp; Confirmed Case </p>
      </a>
    </li>





  </div><br>

  
';
//end of masterlist of tracer 

//VACCINATION
$data_center_vaccination='
  <div>
    <label id="label1" style="font-size:18px; ">
        &nbsp;
        <i class="nav-icon fas fa-briefcase-medical icons "></i>
        &nbsp;
        VACCINATION
    </label>
    <li class="nav-item">
      <a href="vaccine_dashboard" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-laptop-medical icons "></i>
        
        <p> &nbsp;Vaccine Dashboard </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="list_vaccine_profile" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-syringe icons"></i>
        <p> &nbsp;Registration </p>
      </a>
    </li> 

    <li class="nav-item">
      <a href="list_assessment" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-hands-helping icons"></i>
        <p> &nbsp;Assessment </p>
      </a>
    </li>

  

  </div><br>



';
$brgy_encoders_vaccination='
  <div>
    <label id="label1" style="font-size:18px; ">
        &nbsp;
        <i class="nav-icon fas fa-briefcase-medical icons "></i>
        &nbsp;
        VACCINATION
    </label>
    <li class="nav-item">
      <a href="vaccine_dashboard" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-laptop-medical icons "></i>
        
        <p> &nbsp;Vaccine Dashboard </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="list_vaccine_profile" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-syringe icons"></i>
        <p> &nbsp;Registration </p>
      </a>
    </li> 



  </div><br>



';

$content_vaccination = '
  <div>
    <label id="label1" style="font-size:18px; ">
      &nbsp;
      <i class="nav-icon fas fa-briefcase-medical icons "></i>
      &nbsp;
      VACCINATION
    </label>

    <li class="nav-item">
      <a href="vaccine_dashboard" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-laptop-medical icons "></i>
      
        <p> &nbsp;Vaccine Dashboard </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="list_vaccine_profile" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-syringe icons"></i>
        <p> &nbsp;Registration </p>
      </a>
    </li> 

    <li class="nav-item">
      <a href="list_assessment" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-hands-helping icons"></i>
        <p> &nbsp;Assessment </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="list_schedule" class="nav-link sidebar-link">
        &nbsp;
        <i class="fas fa-calendar-plus nav-icon "></i>
        <p> &nbsp;Schedule </p>
      </a>
    </li> 
    <li class="nav-item">
      <a href="list_bakuna_center" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-hospital-o"></i>
        <p> &nbsp;Bakuna Center </p>
      </a>
    </li> 
    <li class="nav-item">
      <a href="list_vaccinators" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-user-md"></i>
        <p> &nbsp;Vaccinator </p>
      </a>
    </li> 
   

    
    
  </div><br>
';
// end of vaccination

// REPORT
$content_report = '
  <div>
    <label id="label1" style="font-size:18px; ">
        &nbsp;
        <i class="fas fa-print nav-icon icons"></i>
        &nbsp;
        REPORT
    </label>
    <li class="nav-item">
      <a href="list_categorylist" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-syringe icons"></i>
        <p> &nbsp;Vaccine Masterlist </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="list_vaccinatedlist" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-syringe icons"></i>
        <p> &nbsp;Vaccinated Masterlist </p>
      </a>
    </li> 
    <li class="nav-item">
      <a href="../plugins/jasperreport/populationreport.php?"" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-syringe icons"></i>
        <p> &nbsp;Eligible Population </p>
      </a>
    </li> 
    <li class="nav-item">
      <a href="../plugins/jasperreport/populationreport_no.php?"" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-syringe icons"></i>
        <p> &nbsp;All Population </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="../plugins/jasperreport/eligible_population.php?"" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-syringe icons"></i>
        <p> &nbsp;Eligible Population per Priority Group </p>
      </a>
    </li> 
    <li class="nav-item">
      <a href="../plugins/jasperreport/vaccine_linelist.php?"" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-syringe icons"></i>
        <p> &nbsp;Sinovac Linelist </p>
      </a>
    </li> 
    <li class="nav-item">
      <a href="../plugins/jasperreport/vaccine_sandoc.php?"" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-syringe icons"></i>
        <p> &nbsp;SanDoc Linelist </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="../plugins/jasperreport/vaccine_deped.php?"" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-syringe icons"></i>
        <p> &nbsp;DEPED Linelist</p>
      </a>
    </li> 
    <li class="nav-item">
      <a href="../plugins/jasperreport/daily_vaccine_report_new.php?"" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-syringe icons"></i>
        <p> &nbsp;Vaccine Overall Report </p>
      </a>
    </li> 
    <li class="nav-item">
      <a href="daily_vaccine_report" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-id-card-alt icons"></i>
        <p> &nbsp;Daily Count </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="list_vaccine_profile_test" class="nav-link sidebar-link">
        &nbsp;
        <i class="nav-icon fas fa-id-card-alt icons"></i>
        <p> &nbsp;TEST PAGE <DO NOT USE> </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="print_individual" class="nav-link sidebar-link">
        &nbsp;
        <i class="fas fa-qrcode icons nav-icon"></i>
        <p> &nbsp;Multiple QR</p>
      </a>
    </li>

  </div><br>

';
// END OF REPORT


//SETTINGS
$content_settings = '
  <div>
    <label id="label1" style="font-size:18px; ">
      &nbsp;
      <i class="nav-icon fa fa-cogs icons"></i>
      &nbsp;
      SETTINGS
    </label>
    <li class="nav-item ">
      <a href="#addnew" data-toggle="modal" data-target="#push_notify" class="nav-link sidebar-link">
       &nbsp; 
        <i class="fa fa-bell-o nav-icon icons" ></i>
        <p>&nbsp; Mobile Alert</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="list_users" class="nav-link sidebar-link">
        &nbsp; 
        <i class="nav-icon fa fa-users icons"></i>
        <p> &nbsp;User Credentials</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="list_incident" class="nav-link sidebar-link">
        &nbsp; 
        <i class="fas fa-car-crash " id="icons"></i>
        <p> &nbsp;Incident Report </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="view_all_posts" class="nav-link sidebar-link">
        &nbsp; 
        <i class="nav-icon fa fa-bullhorn icons"></i>
        <span class="badge badge-danger navbar-badge"> 
        </span>   
        <p>&nbsp; Post Announcement </p>
      </a>
    </li>
    
  </div><br>
';
//end of settings content


// ABOUT US CONTENT
$content_about_us = '
  <div>

    <label id="label1" style="font-size:18px; ">
      &nbsp;
      <i class="nav-icon fa fa-info-circle icons"></i>
      &nbsp; ABOUT US
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

  
  
  </div><br>


';
// END OF ABOUT US CONTENT




//EDIT PROFILE & SIGNOUT
$user_account = ' 
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



  </div>

';
//end of user account credentials 
