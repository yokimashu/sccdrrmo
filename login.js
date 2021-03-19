// // FirebaseUI config.
// // var uiConfig = {
// //     signInSuccessUrl: 'index.html',
// //     signInOptions: [
// //       // Leave the lines as is for the providers you want to offer your users.
// //             //firebase.auth.GoogleAuthProvider.PROVIDER_ID,
// //             //firebase.auth.FacebookAuthProvider.PROVIDER_ID,
// //             //firebase.auth.TwitterAuthProvider.PROVIDER_ID,
// //             //firebase.auth.GithubAuthProvider.PROVIDER_ID,
// //             // firebase.auth.EmailAuthProvider.PROVIDER_ID,
// //             firebase.auth.PhoneAuthProvider.PROVIDER_ID
// //     ],
// //     // Terms of service url.
// //     tosUrl: 'index.html'
// //   };
  
// var uiConfig = {
//     signInOptions: [
//       {
//         provider: firebase.auth.PhoneAuthProvider.PROVIDER_ID,
//         recaptchaParameters: {
//           type: 'image', // 'audio'
//           size: 'normal', // 'invisible' or 'compact'
//           badge: 'bottomleft' //' bottomright' or 'inline' applies to invisible.
//         },
//         // defaultCountry: 'GB', // Set default country to the United Kingdom (+44).
//         // // For prefilling the national number, set defaultNationNumber.
//         // // This will only be observed if only phone Auth provider is used since
//         // // for multiple providers, the NASCAR screen will always render first
//         // // with a 'sign in with phone number' button.
//         // defaultNationalNumber: '1234567890',
//         // You can also pass the full phone number string instead of the
//         // 'defaultCountry' and 'defaultNationalNumber'. However, in this case,
//         // the first country ID that matches the country code will be used to
//         // populate the country selector. So for countries that share the same
//         // country code, the selected country may not be the expected one.
//         // In that case, pass the 'defaultCountry' instead to ensure the exact
//         // country is selected. The 'defaultCountry' and 'defaultNationaNumber'
//         // will always have higher priority than 'loginHint' which will be ignored
//         // in their favor. In this case, the default country will be 'GB' even
//         // though 'loginHint' specified the country code as '+1'.
//         // loginHint: '+11234567890'
//       }
//     ]
// }
//   // Initialize the FirebaseUI Widget using Firebase.
//   var ui = new firebaseui.auth.AuthUI(firebase.auth());
//   // The start method will wait until the DOM is loaded.
//   ui.start('#firebaseui-auth-container', uiConfig);

const phoneNumber = '09506887776';
const appVerifier = window.recaptchaVerifier;
firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
    .then((confirmationResult) => {
      // SMS sent. Prompt user to type the code from the message, then sign the
      // user in with confirmationResult.confirm(code).
      window.confirmationResult = confirmationResult;
      // ...
    }).catch((error) => {
      // Error; SMS not sent
      // ...
    });
