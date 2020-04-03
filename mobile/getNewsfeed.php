<?php

include ('db-config.php');
// session_start();
// $user_id = $_SESSION['id'];

    //  echo "<pre>";
    //  print_r($_GET);
    //  echo "</pre>";


//fetch user from database
$get_user_sql = "SELECT * FROM tbl_announcement ORDER BY id DESC";
$user_data = $con->prepare($get_user_sql);
$user_data->execute();
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {

    $id = $result['id'];
    $title= $result['title'];
    $author = $result['author'];
    $postdate = $result['postdate'];
    $image = $result['image'];
    $content = $result['content'];
    $update_on = $result['updated_on'];
    $status = $result['status'];
    $tag = $result['tag'];
}

//     $userInfo = [
//         'userInfo' => array(
//                 'UserID' => $userID
//         )
//   ];

    $userInfo = array(
        'newsfeed' => array (
             array(
                 'id'               => $id,
                 'title'            => $title,
                 'author'           => $author,
                 'postDate'         => $postdate,
                 'image'            => $image,
                 'content'          => $content,
                 'updatedOn'        => $update_on,
                 'status'           => $status,
                 'tag'              => $tag

                   )
                            )
            );
            
    echo json_encode($userInfo);

?>



