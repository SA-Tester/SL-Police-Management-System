var passwordInput = document.getElementById('exampleInputPassword1');
var toggleButton = document.getElementById('toggleVisibility');
var eyeIcon = document.getElementById('eyeIcon');

toggleButton.addEventListener('click',function(){
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
      } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
      }

})