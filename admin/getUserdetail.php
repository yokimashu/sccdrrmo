<?php

include ('../config/db_config.php');

	if(isset($_POST['userId'])){
		$id = $_POST['userId'];
		$username = '';
		$firstname = '';
		$middlename = '';
		$lastname = '';
		$photo ='';
		$email = '';
		$birthdate = '';
		$gender = '';
		$address = '';
		$mobileno = '';
		$account_type = '';
		$convert_account_type ='';

	
		$user_list = "SELECT * FROM tbl_users WHERE id = :id";
		$get_all_item_data = $con->prepare($user_list);
		$get_all_item_data->execute([':id' => $id]);  
		 while ($result = $get_all_item_data->fetch(PDO::FETCH_ASSOC)) {
		$username = $result['username'];	
		$firstname =$result['firstname'];
		$middlename =$result['middlename'];
		$lastname =$result['lastname'];
		$photo = $result ['photo'];
		$email = $result['email'];
		$birthdate = $result['birthdate'];
		$gender = $result['gender'];
		$address = $result['address'];
		$mobileno = $result['mobileno'];
		$account_type = $result['account_type'];

		$birthdate2 =date('m-d-Y', strtotime($birthdate));	
		if  ($account_type == 1){
			$convert_account_type = "Administrator";
		} else if ($account_type == 2)
		 {
			$convert_account_type = "User";
		} else {
			$convert_account_type = "Mobile";
		}


	}
	$data = array(
	
		'id' 		=> 	 $id,
		'username'	=>	 $username,
		'firstname'	=>	 $firstname,
		'middlename'=>	 $middlename,
		'lastname'	=>	 $lastname,
		'photo'		=>	 $photo,
		'email'		=>	 $email,
		'birthdate'	=>	 $birthdate2,
		'gender'	=>	 $gender,
		'address'	=>	 $address,
		'mobileno'	=>	 $mobileno,
		'account_type'=> $convert_account_type,

		'message' 	=> 'success'
	);
	echo json_encode($data);
}

?>