let vrf = document.getElementById('vrf');
let password = document.getElementById('password1');
// When the user clicks on the password field, vrf if the password contains major and minor letters, numbers and special characters
// password.onfocus = function() {
//   vrf.style.display = 'block';
//   password.style.margin = '0 0 0px 0';
// }
// When the user clicks outside of the password field, hide the message box
password.onblur = function() {
  vrf.style.display = 'none';
  password.style.margin = '0 0 24px 0';
}
// When the user starts to type something inside the password field
password.onkeyup = function() {
    vrf.style.display = 'block';
    password.style.margin = '0 0 0px 0';
    vrf.style.margin = '0 0 8px 0';
  // Validate major and minor letters
    let lowerCaseLetters = /[a-z]/g;
    let upperCaseLetters = /[A-Z]/g;
    let numbers = /[0-9]/g;
    let special = /[^a-zA-Z0-9]/g;
    if(password.value.match(lowerCaseLetters)) {
      if(password.length < 8) {
        vrf.innerHTML = 'Password must be at least 8 characters long';
      } else if(password.value.match(upperCaseLetters)) {
        if(password.value.match(numbers)) {
          if(password.value.match(special)) {
            vrf.innerHTML = 'Password is strong';
            vrf.style.color = '#28a745';
          } else {
            vrf.innerHTML = 'Password must contain at least one special character';
          }
        } else {
          vrf.innerHTML = 'Password must contain at least one number';
        }
      } else {
        vrf.innerHTML = 'Password must contain at least one major letter';
      }
    }
}
