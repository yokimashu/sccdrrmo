
<?php
$number = '';
$text = '';

if(isset($_POST['send'])){
    $number=$_POST['personnum'];
    $text=$_POST['message'];
$url="https://api.wavecell.com/sms/v1/{sccdrrmo_4yYFF_hq}/single";
$message = urlencode($text);// urlencode your message
$curl = curl_init();
curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=Iet4cfN6xmod1KxU0QnyBqg8Ezrzz9KH4cUhqOM&phone=$number&senderid=sccdrrmo.mobile@gmail.com&message=$message");// post data
// query parameter values must be given without squarebrackets.
 // Optional Authentication:
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
if(curl_exec($curl)){
   $alert_msg.= ' 
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="icon fa fa-check"></i>You have successfully updated the user.
</div>     
'; 
} else {
$alert_msg.= ' 
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="icon fa fa-check"></i>You have successfully failed the user.
</div>     
';
}
}
?>