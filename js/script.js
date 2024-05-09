
function togglePasswordVisibility() {
  const passwordInput = document.getElementById('password');
  passwordInput.type = (passwordInput.type === 'password') ? 'text' : 'password';
  const eye = document.getElementById('eye');
  if (passwordInput.type === 'password') {
    eye.innerHTML = `<i class="bi bi-eye-fill"></i>`;
}
  else {
    eye.innerHTML = `<i class="bi bi-eye-slash-fill"></i>`;
} 
}
function togglePasswordVisibility2() {
    const passwordInput2 = document.getElementById('password2');
    passwordInput2.type = (passwordInput2.type === 'password') ? 'text' : 'password';
    const eye = document.getElementById('eye2');
    if (passwordInput2.type === 'password') {
        eye.innerHTML = `<i class="bi bi-eye-fill"></i>`;
    }
    else {
        eye.innerHTML = `<i class="bi bi-eye-slash-fill"></i>`;
    } 
    }
function togglePasswordVisibility1() {
    const passwordInput1 = document.getElementById('password1');
    passwordInput1.type = (passwordInput1.type === 'password') ? 'text' : 'password';
    const eye = document.getElementById('eye1');
    if (passwordInput1.type === 'password') {
        eye.innerHTML = `<i class="bi bi-eye-fill"></i>`;
    }
    else {
        eye.innerHTML = `<i class="bi bi-eye-slash-fill"></i>`;
    } 
    }
// let nom = document.getElementById('nom');
// window.onload = function() {
//     nom.focus();
// }


let devise = document.getElementById('devise');
console.log(devise.value);


