<?php

// session_start();
// $user_id = $_SESSION['id'];

    //  echo "<pre>";
    //  print_r($_GET);
    //  echo "</pre>";

    header('Content-Type: application/json; charset=utf-8');

    //if($_SERVER["REQUEST_METHOD"] == "POST"){
        require 'db-config.php';
        showAllPost();
    // }else{
    //     echo "Oops! We're sorry! You do not have access to this option!";
    // }


function showAllPost(){
        global $con;
        global $appUrl;

        $listOfPosts = array();

//fetch user from database
$get_announcement_sql = "SELECT * FROM tbl_announcement ORDER BY id DESC";
$get_data = $con->prepare($get_announcement_sql);
$get_data->execute();
while ($result = $get_data->fetch(PDO::FETCH_ASSOC)) {

    $listOfPosts[$result['id']] = [
        'id'        => $result['id'],
        'title'     => str_replace([':', '\\', '/', '*',','],"",$result['title']),
        'author'    => $result['author'],
        'postDate'  => $result['postdate'],
        'image'     => $result['image'],
        'content'   =>  $$result['content'],
        'updatedOn' => $result['updated_on'],
        'status'    => $result['status'],
        'tag'       =>  $result['tag']
        
    ];
}

//     $userInfo = [
//         'userInfo' => array(
//                 'UserID' => $userID
//         )
//   ];

      


        $data = [];
		foreach ($listOfPosts as $info) {
           
            // $info = array(
            
              
            //       'id'               => $id,
            //       'title'            => $title,
            //       'author'           => $author,
            //       'postDate'         => $postdate,
            //       'image'            => $image,
            //       'content'          => $content,
            //       'updatedOn'        => $update_on,
            //       'status'           => $status,
            //       'tag'              => $tag
                
               // );
        $data[] = $info;
		 }
         echo json_encode(array('newsfeed'=>$data));
         //echo $data;
   echo count($listOfPosts);
        }

?>



