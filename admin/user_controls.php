<?php

include('../config/db_config.php');

//get all draft from announcement





$incident_report  = '';
$registration_list = '';
$get_individual_entity = '';
$mobile_alert = '';
$post_announce = ' ';
$post_announce_last = ' ';
$settings = ' ';
$announce = ' ';
$numberofdraft = ' ';
$post_last = ' ';
$break = ' ';






// masterlist 
$label_covid_case = ' ';
$label_masterlist = '';
$masterlist_symptoms = '';
$list_vaccine = '';
$list_vaccine_report = ' ';
$list_vaccine_report_no = ' ';

$list_close_contact = ' ';
$list_positive_case = ' ';
$single_break = ' ';


$label_vaccination = ' ';
$list_assessment = ' ';
$list_bakuna_center = ' ';


//google forms
$label_tracer = ' ';
$add_positive_case = ' ';


$get_all_draft_sql = "SELECT * FROM tbl_announcement WHERE status = 'draft'";
$get_all_draft_data = $con->prepare($get_all_draft_sql);
$get_all_draft_data->execute();
$numberofdraft = $get_all_draft_data->rowCount();



//sidebar buttons
if ($_SESSION['user_type'] == 1) {

  // individual form  
  $view_history =
    '   <a class="btn btn-success btn-sm" id="view_history" href="view_individual_history.php?&entity_no=' . $get_individual_entity . '">
        <i class="fa fa-suitcase"></i>
      </a>';




  // masterlist
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

  // end of masterlist


  // vaccination masterlist
  $label_vaccination =
    '  
  <label id="label1" style="font-size:18px; ">
      &nbsp;
      <i class="nav-icon fas fa-briefcase-medical icons "></i>
      &nbsp;
       VACCINATION
   </label>';





  $list_vaccine = '<li class="nav-item">
   <a href="list_vaccine_profile" class="nav-link sidebar-link">
     &nbsp;
     <i class="nav-icon fas fa-syringe icons"></i>
     <p> Registration </p>
   </a>
 </li> ';

  $list_assessment = '<li class="nav-item">
 <a href="list_assessment" class="nav-link sidebar-link">
   &nbsp;
   <i class="nav-icon fas fa-hands-helping icons"></i>

   <p> Assessment </p>
 </a>
</li> ';

  $list_bakuna_center = '<li class="nav-item">
 <a href="list_bakuna_center" class="nav-link sidebar-link">
   &nbsp;
   <i class="nav-icon fas fa-hospital-o icons"></i>

   <p> Bakuna Center </p>
 </a>
</li> ';

  // end of masterlist vaccination




  // masterlist of covid-19
  $label_covid_case =
    '  
    <label id="label1" style="font-size:18px; ">
          &nbsp;
          <i class="nav-icon fas fa-briefcase-medical icons "></i>
          &nbsp;
          COVID-19 CASES
    </label>';




  $list_close_contact = '
       <li class="nav-item">
         <a href="list_close_contact" class="nav-link sidebar-link">
           &nbsp;
           <i class="nav-icon fas fa-id-card-alt icons"></i>
           <p> Close Contacts </p>
         </a>
       </li>';




  $list_positive_case =
    '<li class="nav-item">
        <a href="list_sources_infection" class="nav-link sidebar-link">
          &nbsp;
          <i class="nav-icon fas fa-check-square icons"></i>

          <p> Confirmed Case </p>
        </a>
    </li> ';
  //end of masterlist of tracer 


  // report for vaccine
  $list_vaccine_report = '<li class="nav-item">
<a href="../plugins/jasperreport/populationreport.php?"" class="nav-link sidebar-link">
  &nbsp;
  <i class="nav-icon fas fa-syringe icons"></i>
  <p> Eligible Population </p>
</a>
</li> ';

  $list_vaccine_report_no = '<li class="nav-item">
<a href="../plugins/jasperreport/populationreport_no.php?"" class="nav-link sidebar-link">
  &nbsp;
  <i class="nav-icon fas fa-syringe icons"></i>
  <p> All Population </p>
</a>
</li> ';

  // end report for vaccine 



  // SETTINGS MENU

  $settings = '  <label id="label1" style="font-size:18px; ">
      &nbsp;
      <i class="nav-icon fa fa-cogs icons"></i>
      &nbsp;
      SETTINGS
  </label>';

  $incident_report =
    ' <li class="nav-item">
        <a href="list_incident" class="nav-link sidebar-link">
          &nbsp; 
          <i class="fas fa-car-crash " id="icons"></i>
          <p> &nbsp;
            Incident Report
          </p>
        </a>
      </li>';


  $registration_list =
    '<li class="nav-item">
            <a href="list_users" class="nav-link sidebar-link">
              &nbsp; 
  
              <i class="nav-icon fa fa-users icons"></i>
              <p> &nbsp; User Credentials</p>
            </a>
      </li>';



  $mobile_alert =  '    <li class="nav-item ">

              <a href="#addnew" data-toggle="modal" data-target="#push_notify" class="nav-link sidebar-link">
              &nbsp; 
              <i class="fa fa-bell-o nav-icon icons" ></i>
              <p>&nbsp; Mobile Alert</p>
              </a>

          </li>';

  $post_announce = '
                            <li class="nav-item">
                              <a href="view_all_posts" class="nav-link sidebar-link">
                                &nbsp; 
                                <i class="nav-icon fa fa-bullhorn icons"></i>
                  
                                <span class="badge badge-danger navbar-badge">  ';

  $post_last = '</span> 
                                
                <p>&nbsp; Post Announcement </p>
                </a>
                </li>';




  $single_break = '<br> ';

  if ($numberofdraft > 0) {
    $post_announce_last = $post_announce . " " . $numberofdraft . " " . $post_last;
  }




  $break = '<br><br><br><br>';
}

// register account
if ($_SESSION['user_type'] == 2) {

  $single_break = '<br> ';
  $break = '<br><br><br><br>';
}

//contact tracer account
if ($_SESSION['user_type'] == 3) {



  $single_break = '<br> ';




  $view_history = '
    <a class="btn btn-success btn-sm" id="view_history" href="view_individual_history.php?&entity_no=' . $get_individual_entity . '">
    <i class="fa fa-suitcase"></i>
  </a>';


  $break = '<br><br><br><br>';
}




// CHO account
if ($_SESSION['user_type'] == 4) {

  // masterlist of covid-19
  $label_covid_case =
    '  
   <label id="label1" style="font-size:18px; ">
         &nbsp;
         <i class="nav-icon fas fa-briefcase-medical icons "></i>
         &nbsp;
         COVID-19 CASES
   </label>';




  $list_close_contact = '
      <li class="nav-item">
        <a href="list_close_contact" class="nav-link sidebar-link">
          &nbsp;
          <i class="nav-icon fas fa-id-card-alt icons"></i>
          <p> Close Contacts </p>
        </a>
      </li>';




  $list_positive_case =
    '<li class="nav-item">
       <a href="list_sources_infection" class="nav-link sidebar-link">
         &nbsp;
         <i class="nav-icon fas fa-check-square icons"></i>

         <p> Confirmed Case </p>
       </a>
   </li> ';
  //end of masterlist of tracer 


  // vaccination masterlist
  $label_vaccination =
    '  
  <label id="label1" style="font-size:18px; ">
      &nbsp;
      <i class="nav-icon fas fa-briefcase-medical icons "></i>
      &nbsp;
       VACCINATION
   </label>';





  $list_vaccine = '<li class="nav-item">
   <a href="list_vaccine_profile" class="nav-link sidebar-link">
     &nbsp;
     <i class="nav-icon fas fa-syringe icons"></i>
     <p> Registration </p>
   </a>
 </li> ';

  $list_assessment = '<li class="nav-item">
 <a href="list_assessment" class="nav-link sidebar-link">
   &nbsp;
   <i class="nav-icon fas fa-hands-helping icons"></i>

   <p> Assessment </p>
 </a>
</li> ';

  // end of masterlist vaccination





  // start of vaccine report
  $list_vaccine_report = '<li class="nav-item">
  <a href="../plugins/jasperreport/populationreport.php?"" class="nav-link sidebar-link">
    &nbsp;
    <i class="nav-icon fas fa-syringe icons"></i>
    <p> Eligible Population </p>
  </a>
  </li> ';

  $list_vaccine_report_no = '<li class="nav-item">
  <a href="../plugins/jasperreport/populationreport_no.php?"" class="nav-link sidebar-link">
    &nbsp;
    <i class="nav-icon fas fa-syringe icons"></i>
    <p> All Population </p>
  </a>
  </li> ';
  // end of report

  $single_break = '<br> ';

  $break = '<br><br><br><br>';
}
