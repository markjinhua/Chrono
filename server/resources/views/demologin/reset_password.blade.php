<link rel="stylesheet" type="text/css" href="https://affiliate.coder-bd.com/cdn/assets.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<div class="container" >
  <div class="top"></div>
  <div class="bottom"></div>
  <div class="center">
    <h2>Password Recover</h2>
	
            <div class="error-text" style="background-color:#f003">Please Match The Password</div> <br>
			<input type="email" placeholder="Email"/>
	<div class = "pass" > <input type="password" name="password" placeholder="Enter New Password"autocomplete="current-password" required="" id="id_password">
  <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i></div>
  
  <div class = "pass" > <input type="password" name="password" placeholder="Confirm password"autocomplete="current-password" required="" id="id_password">
  <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i></div>
 


	<input class="form__submit-btn" type="submit" value="Let's Go"/><br>
	
	
	 <script>
const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});

</script>

	