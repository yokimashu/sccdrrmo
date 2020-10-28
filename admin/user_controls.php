<?php



$incident_report  = '';
$registration_list = '';
$get_individual_entity = '';

//sidebar buttons
if ($_SESSION['user_type'] == 1) {
    $registration_list =  '<a href="list_users" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>   USERS</p>
                        </a>';

    $incident_report = '<a href="list_incident" class="nav-link ">
    &nbsp; &nbsp; &nbsp;<i class="fa fa-share fa-flip-vertical "></i>

            <p> &nbsp;
        Incident Report
        </p>
        </a>';





    // individual form  
    $view_history = '<a class="btn btn-success btn-sm" id = "view_history" href="view_individual_history.php?&entity_no=' . $get_individual_entity . '">
                                <i class="fa fa-suitcase"></i></a>';
}
