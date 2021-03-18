


<?php
include('../config/db_config.php');
if (isset($_POST['description'])) {
    $description =   $_POST['description'];
    $barangay1 =   $_POST['barangay1'];


    $get_all_category_sql = " SELECT * from tbl_vaccine where Category = '". $description . "' and Barangay = '". $barangay1 . "' ";

    $get_all_category_data = $con->prepare($get_all_category_sql);
    $get_all_category_data->execute();


 
        while ($list_category = $get_all_category_data->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td >";
            echo $list_category['entity_no'];
            echo "</td>";
            echo "<td>";
            echo $list_category['datecreate'];
            echo "</td>";
            echo "<td >";
            echo $list_category['Lastname'] . ','.' '. $list_category['Firstname'] .' '.$list_category['Middlename'];
            echo "</td>";

            echo "<td>";
            echo $list_category['Barangay'];
            echo "</td>";
            echo "</tr>";

    }
}

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

