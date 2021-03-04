 <?php
session_start();

if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$phonenumber = $_SESSION['phone'];


?> 



<html>
<head>
    <title>Phone Number Authentication with Firebase Web</title>
</head>
<body>
<h1>Enter number to create account</h1>
<form>
    <input type="text" id="number" value="<?php echo $phonenumber; ?>">
    <div id="recaptcha-container"></div>
    <button type="button" onclick="phoneAuth();">SendCode</button>
</form><br>




<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
    apiKey: "AIzaSyBcAmZpS6tbd5vvIlXly-60wFr2PgEVZCw",
    authDomain: "vamos-mobile-scc2020.firebaseapp.com",
    projectId: "vamos-mobile-scc2020",
    storageBucket: "vamos-mobile-scc2020.appspot.com",
    messagingSenderId: "450868149198",
    appId: "1:450868149198:web:2188b50906f617bb00499f"
  };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
</script>
<script src="NumberAuthentication.js" type="text/javascript"></script>
</body>
</html>