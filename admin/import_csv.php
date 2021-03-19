<?php  
$connect = mysqli_connect("localhost", "root", "", "sccdrrmo");
if(isset($_POST["submit"]))
{
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   while($data = fgetcsv($handle))
   {
                $csv_idno = mysqli_real_escape_string($connect, $data[0]);  
                $csv_entity_no= mysqli_real_escape_string($connect, $data[1]);
                $csv_datecreate = mysqli_real_escape_string($connect, $data[2]);
                $csv_time_reg = mysqli_real_escape_string($connect, $data[3]);
                $csv_Category = mysqli_real_escape_string($connect, $data[4]);
                $csv_CategoryID= mysqli_real_escape_string($connect, $data[5]);
                $csv_CategoryIDnumber= mysqli_real_escape_string($connect, $data[6]);
                $csv_PhilHealthID = mysqli_real_escape_string($connect, $data[7]);
                $csv_HealthWorker= mysqli_real_escape_string($connect, $data[8]);
                $csv_Indigent= mysqli_real_escape_string($connect, $data[9]);
                $csv_PWD_ID = mysqli_real_escape_string($connect, $data[10]);
                $csv_Lastname= mysqli_real_escape_string($connect, $data[11]);
                $csv_Firstname = mysqli_real_escape_string($connect, $data[12]);
                $csv_Middlename = mysqli_real_escape_string($connect, $data[13]);
                $csv_Suffix = mysqli_real_escape_string($connect, $data[15]);
                $csv_Contact_no = mysqli_real_escape_string($connect, $data[16]);
                $csv_Full_address = mysqli_real_escape_string($connect, $data[17]);
                $csv_Region = mysqli_real_escape_string($connect, $data[18]);
                $csv_w_comorbidities = mysqli_real_escape_string($connect, $data[19]);
                $csv_Comorbidity = mysqli_real_escape_string($connect, $data[20]);
                $csv_patient_diagnosed = mysqli_real_escape_string($connect, $data[21]);
                $csv_covid_history = mysqli_real_escape_string($connect, $data[22]);
                $csv_covid_date = mysqli_real_escape_string($connect, $data[23]);
                $csv_covid_classification = mysqli_real_escape_string($connect, $data[24]);
                $csv_consent = mysqli_real_escape_string($connect, $data[25]);



                $query = "INSERT into tbl_vaccine SET
                entity_no = '$csv_entity_no',
                datecreate = '$csv_date_create',
                Category = '$csv_category',
                CategoryID = '$csv_category_id',
                IDNumber = '$csv_IDNumber',
                PhilHealthID = ' $csv_philhealthId',
                Civil_status = '  $csv_civil_status',
                Suffix = ' $csv_suffix',
                Sex = ' $sex',
                Employed = '$csv_employed',
                Profession = ' $csv_profession',
                Direct_covid = ' $csv_direct_covid',
                Employer_name = '  $csv_employer_name',
                Employer_LGU = '  $csv_employer_lgu',
                Employer_address = ' $csv_employer_address',
                Employer_contact_no = ' $csv_employer_cnumber',
                Preg_status = ' $csv_preg_status',
                W_allergy = ' $csv_philhealthId',
                Allergy = ' $csv_allergy',
                W_comorbidities = ' $csv_w_comorbidities',
                Comorbidity = ' $csv_Comorbidity',
                patient_diagnosed = ' $csv_patient_diagnosed',
                covid_history = ' $csv_covid_history',
                covid_date = ' $csv_covid_date',
                covid_classification = ' $csv_covid_classification',
                consent = ' $csv_consent'
                ";
                mysqli_query($connect, $query);
   }
   fclose($handle);
   
  }
  $alert_msg .= ' 
  <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="fa fa-check"></i>
          <strong> Success ! </strong> Data Inserted.
  </div>    
';
 }
}
?>  