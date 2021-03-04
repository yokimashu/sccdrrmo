var fireBase = fireBase || firebase;
var hasInit = false;


  // Your web app's Firebase configuration
  var config = {
    apiKey: "AIzaSyBcAmZpS6tbd5vvIlXly-60wFr2PgEVZCw",
    authDomain: "vamos-mobile-scc2020.firebaseapp.com",
    projectId: "vamos-mobile-scc2020",
    storageBucket: "vamos-mobile-scc2020.appspot.com",
    messagingSenderId: "450868149198",
    appId: "1:450868149198:web:2188b50906f617bb00499f"
};
if(!hasInit){
    firebase.initializeApp(config);
    hasInit = true;
}