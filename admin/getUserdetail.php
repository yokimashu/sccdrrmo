<?php

include ('../config/db_config.php');

	if(isset($_POST['userId'])){
		$id = $_POST['userId'];
		$username = '';
		$fullname = '';
		$email = '';
		$birthdate = '';
		$gender = '';
		$address = '';
		$mobileno = '';
		$account_type = '';
		$convert_account_type ='';

		// $sql = "SELECT * FROM tbl_users where id = $id";
		// $query = $con->query($sql);
		// $row = $query->fetch_assoc();
        // echo json_encode($row);
		$user_list = "SELECT * FROM tbl_users WHERE id = :id";
		$get_all_item_data = $con->prepare($user_list);
		$get_all_item_data->execute([':id' => $id]);  
		 while ($result = $get_all_item_data->fetch(PDO::FETCH_ASSOC)) {
		$username = $result['username'];	
		$fullname =$result['fullname'];
		$email = $result['email'];
		$birthdate = $result['birthdate'];
		$gender = $result['gender'];
		$address = $result['address'];
		$mobileno = $result['mobileno'];
		$account_type = $result['account_type'];


		if  ($account_type == 1){
			$convert_account_type = "Administrator";
		} else if ($account_type == 2) {
			$convert_account_type = "User";
		} else {
			$convert_account_type = "Mobile";
		}


	}
	$data = array(
	
		'id' 		=> 	 $id,
		'username'	=>	 $username,
		'fullname'	=>	 $fullname,
		'email'		=>	 $email,
		'birthdate'	=>	 $birthdate,
		'gender'	=>	 $gender,
		'address'	=>	 $address,
		'mobileno'	=>	 $mobileno,
		'account_type'=> $convert_account_type,

		'message' 	=> 'success'
	);
	echo json_encode($data);
}

?>