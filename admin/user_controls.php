<?php 
 $incident_report  = '';
 $registration_list ='';
 //sidebar buttons
if ($_SESSION['user_type'] == 1) {
    $registration_list =  '<a href="list_users" class="nav-link">
                        <i class="fa fa-minus nav-icon"></i>
                        <p>Users</p>
                        </a>';

    $incident_report ='<a href="list_incident" class="nav-link ">
            <i class="nav-icon fa fa-book"></i>
            <p>
        INCIDENT REPORT 
        </p>
        </a>';

// individual form 
$view_history = '<a class="btn btn-success btn-sm view_history" id = "view_history" >
<i class="fa fa-suitcase"></i></a>';
}
?>