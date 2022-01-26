


<?php
include('../config/db_config.php');
if (isset($_POST['barangay'])) {
    $category1 =   $_POST['category'];
    $barangay1 =   $_POST['barangay'];
    $type =   $_POST['type'];
    // $astrazeneaca =   $_POST['astrazeneca'];


    $get_all_category_sql = " SELECT * from tbl_vaccine r inner join tbl_assessment t on t.entity_no = r.entity_no where Category = '". $category1 . "' and Barangay = '". $barangay1 . "' and VaccineManufacturer = '". $type . "'";

    $get_all_category_data = $con->prepare($get_all_category_sql);
    $get_all_category_data->execute();


 
        while ($list_category = $get_all_category_data->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td >";
            echo $list_category['entity_no'];
            echo "</td>";
            echo "<td>";
            echo $list_category['DateVaccination'];
            echo "</td>";

            echo "<td>";
            echo $list_category['Category'];
            echo "</td>";
            echo "<td >";
            echo $list_category['Lastname'] . ','.' '. $list_category['Firstname'] .' '.$list_category['Middlename'];
            echo "</td>";

            echo "<td>";
            echo $list_category['Barangay'];
            echo "</td>";

            echo "<td>";
            echo $list_category['1stDose'];
            echo "</td>";

            echo "<td>";
            echo $list_category['2ndDose'];
            echo "</td>";

            echo "<td>";
            echo $list_category['sinovac'];
            echo "</td>";
            echo "<td>";
            echo $list_category['astrazeneca'];
            echo "</td>";
            echo "</tr>";

    }
}


// if (isset($_POST['barangay'])) {
//     $category1 =   $_POST['category'];
//     $barangay1 =   $_POST['barangay'];
//     $sinovac =   $_POST['sinovac'];
//     $astrazeneaca =   $_POST['astrazeneca'];


//     $get_all_category_sql = " SELECT * from tbl_vaccine where Category = '". $category1 . "' and Barangay = '". $barangay1 . "' and sinovac = '". $sinovac . "'";

//     $get_all_category_data = $con->prepare($get_all_category_sql);
//     $get_all_category_data->execute();


 
//         while ($list_category = $get_all_category_data->fetch(PDO::FETCH_ASSOC)) {
//             echo "<tr>";
//             echo "<td >";
//             echo $list_category['entity_no'];
//             echo "</td>";
//             echo "<td>";
//             echo $list_category['datecreate'];
//             echo "</td>";

//             echo "<td>";
//             echo $list_category['Category'];
//             echo "</td>";
//             echo "<td >";
//             echo $list_category['Lastname'] . ','.' '. $list_category['Firstname'] .' '.$list_category['Middlename'];
//             echo "</td>";

//             echo "<td>";
//             echo $list_category['Barangay'];
//             echo "</td>";
//             echo "<td>";
//             echo $list_category['sinovac'];
//             echo "</td>";
//             echo "<td>";
//             echo $list_category['astrazeneca'];
//             echo "</td>";
//             echo "</tr>";

//     }
// }

// if(isset($_POST['description']){
//     $description =   $_POST['description'];
//     $barangay =   $_POST['barangay'];


//     $get_all_category_sql = " SELECT * from tbl_vaccine where Category = '". $description . "' and barangay = '". $barangay . "'";

//     $get_all_category_data = $con->prepare($get_all_category_sql);
//     $get_all_category_data->execute();


 
//         while ($list_category = $get_all_category_data->fetch(PDO::FETCH_ASSOC)) {
//             echo "<tr>";
//             echo "<td >";
//             echo $list_category['entity_no'];
//             echo "</td>";
//             echo "<td>";
//             echo $list_category['datecreate'];
//             echo "</td>";
//             echo "<td >";
//             echo $list_category['Lastname'] . ','.' '. $list_category['Firstname'] .' '.$list_category['Middlename'];
//             echo "</td>";
//             echo "<td >";
//             echo $list_category['Barangay'];
//             echo "</td>";
//             echo "</tr>";

//     }
// }

?>

