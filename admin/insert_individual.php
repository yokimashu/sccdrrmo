<?php



//include('import_pdf.php');

$alert_msg = '';
$alert_msg1 = '';

if (isset($_POST['insert_individual'])) {

    //insert to tbl_individual
    $entity_no = $_POST['entity_no'];
    $date_register = $_POST['date_register'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $contact_no = $_POST['contact_no'];
    $email_address = $_POST['email_address'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $birthdate = $_POST['birthdate'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $photo = $_POST['myFiles'];
    
    //insert to tbl_entity 
    $username = $_POST['username'];
    $password = $_POST['password'];
    $status = $_POST['status'];

    $insert_individual_sql = "INSERT INTO tbl_individual SET 

    entity_no        = :entity_no,
    date_register    = :date_register,
    firstname        = :firstname,
    middlename       = :middlename,
    lastname         = :lastname,
    age              = :age,
    gender           = :gender,
    contact_no       = :contact_no,
    email_address    = :email_address,
    photo            = :photo,
    barangay         = :barangay,
    birthdate        = :birthdate,
    street           = :street,
    city             = :city,
    province         = :province";

    $individual_data = $con->prepare($insert_individual_sql);
    $individual_data->execute([

    ':entity_no'         => $entity_no,
    ':date_register'     => $date_register,
    ':firstname'         => $firstname,
    ':middlename'        => $middlename,
    ':lastname'          => $lastname,
    ':age'               => $age,
    ':gender'            => $gender,
    ':contact_no'        => $contact_no,
    ':email_address'     => $email_address,
    ':photo'          => $photo,
    ':barangay'          => $barangay,
    ':birthdate'         => $birthdate,
    ':street'            => $street,
    ':city'              => $city,
    ':province'          => $province
]);






    $alert_msg .= ' 
    <div class="new-alert new-alert-success alert-dismissible">
        <i class="icon fa fa-success"></i>
        Data Inserted
    </div>  
      ';
      echo print_r($firstname);
      header("location: list_individual.php");
}
