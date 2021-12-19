<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>User Registration</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js' async defer ></script>
<script type="text/javascript">
    var BASE_URL = "<?php echo base_url();?>";
</script>

<style>
body {
	color: #fff;
	background: #63738a;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	height: 40px;
	box-shadow: none;
	color: #969fa4;
}
.form-control:focus {
	border-color: #5cb85c;
}
.form-control, .btn {        
	border-radius: 3px;
}
.signup-form {
	width: 600px;
	margin: 0 auto;
	padding: 30px 0;
  	font-size: 15px;
}
.signup-form h2 {
	color: #fff;
	margin: 0 0 15px;
	position: relative;
	text-align: center;
}
.signup-form h2:before, .signup-form h2:after {
	content: "";
	height: 2px;
	width: 30%;
	background: #d4d4d4;
	position: absolute;
	top: 50%;
	z-index: 2;
}	
.signup-form h2:before {
	left: 0;
}
.signup-form h2:after {
	right: 0;
}
.signup-form .hint-text {
	color: #fff;
	margin-bottom: 30px;
	text-align: center;
}
.signup-form form {
	color: #999;
	border-radius: 3px;
	margin-bottom: 15px;
	background: #f2f3f7;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form input[type="checkbox"] {
	margin-top: 3px;
}
.signup-form .btn {        
	font-size: 16px;
	font-weight: bold;		
	min-width: 140px;
	outline: none !important;
}
.signup-form .row div:first-child {
	padding-right: 10px;
}
.signup-form .row div:last-child {
	padding-left: 10px;
}    	
.signup-form a {
	color: #fff;
	text-decoration: underline;
}
.signup-form a:hover {
	text-decoration: none;
}
.signup-form form a {
	color: #5cb85c;
	text-decoration: none;
}	
.signup-form form a:hover {
	text-decoration: underline;
}  

        .displayBadge{
            margin-top: 15%; 
            display: none; 
            text-align :center;
        }

</style>
</head>
<body>
<div class="signup-form">
		<h2>Register</h2>
<!-- 		<p class="hint-text">Create your account. It's free and only takes a minute.</p> -->

        <div class="form-group">

		<form >
			<div class="row">
				<label class="col-md-4 control-label">User Name *</label>
		        <div class="col-md-6">
		            <input type="text" class="form-control" id="user_name" name="user_name" required placeholder="Enter User Name" maxlength="255"/>
		            <span id="error_user_name" class="error_span text-danger has_error mrt5 fs11"></span>
		        </div>
		        <span></span>
			</div>


			<div class="row"></div>

			<div class="row">
				<label class="col-md-4 control-label">Email Id *</label>
		        <div class="col-md-6">
		            <input type="text" class="form-control" id="emailid" name="emailid" required placeholder="Enter Emailid" maxlength="255"/>
		            <span id="error_email" class="error_span text-danger has_error mrt5 fs11"></span>
		        </div>
		        <span></span>
			</div>

			<div class="row"></div>

			<div class="row">
				<label class="col-md-4 control-label">Password *</label>
		        <div class="col-md-6">
		            <input type="password" class="form-control" id="password" name="password" required placeholder="Password" maxlength="255"/>
		            
		            <span id="error_password" class="error_span text-danger has_error mrt5 fs11"></span>
		        </div>
		        	<span  class="col-md-2" id="StrengthDisp"  class="badge displayBadge">Weak</span>
		        
			</div>

			<div class="row"></div>

			<div class="row">
				<label class="col-md-4 control-label">Confirm Password *</label>
		        <div class="col-md-6">
		            <input type="password" class="form-control" id="cpassword" name="cpassword" required placeholder="Confirm Password" maxlength="255"/>
		            <span id="error_cpassword" class="error_span text-danger has_error mrt5 fs11"></span>
		        </div>
		        <span></span>
			</div>      
    </form>
    <form id="frmContact"  method="post"  novalidate="novalidate">
   		<div  class="g-recaptcha" data-sitekey="GOOGLE RECAPTCH CLIENT SECRET HERE"></div>

		<div class="row">
			<div class="col-md-12">
				<input type="text" class="btn btn-success btn-lg btn-block" value="Submit" id="save_button" onclick="submit_form()" readonly />
			</div>
		</div>

	</form>

</div>
</body>
</html>
<script type="text/javascript">



    $(document).ready(function(){
    	$("#StrengthDisp").css("display", "none");
    });

	function submit_form(){

		if(validate_user_name()){
			if(validate_password()){
				if(validate_email_size()){
					if(validate_password()){
						if(verify_recaptcha()){
							if(verify_email()){
								InsertUser();
							}
						}
					}
				}
			}
		}

	}

	function verify_recaptcha(){
		var error = false;
		$.ajax({
		url:  BASE_URL + '/register/verify_captcha',
		type: 'POST',
		async: false,
		data: { 'token': $("#frmContact")[0][0]['value']},
		success: function (result) {
			var jsonResult = JSON.parse(result); 
			if(jsonResult.status == 200){
				console.log("re-captcha success");
				error = true;
			}
			else{
				window.alert("re-captcha failed please refresh and try again");
			}
		}
		});
		return error;
	}

	function verify_email(){
		var error = false;
		$.ajax({
		url:  BASE_URL + '/register/verify_email',
		type: 'POST',
		data: { 'email': $("#emailid").val()},
		async: false,
		success: function (result) {
			var jsonResult = JSON.parse(result); 
			if(jsonResult.message == "deliverable"){
				console.log("Valid Emailid");
				error = true;
			}
			else{
				$("#error_email").html("Email not valid");
        		$("#emailid").addClass('error_box');
			}
		}
		});
		return error;
	}


    let timeout;
    let password = document.getElementById('password')
    let strengthBadge = document.getElementById('StrengthDisp')
    
    let strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})')
    let mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))')
    
    function StrengthChecker(PasswordParameter){
        if(strongPassword.test(PasswordParameter)) {
            strengthBadge.style.backgroundColor = "green"
            strengthBadge.textContent = 'Strong'
        } else if(mediumPassword.test(PasswordParameter)){
            strengthBadge.style.backgroundColor = 'blue'
            strengthBadge.textContent = 'Medium'
        } else{
            strengthBadge.style.backgroundColor = 'red'
            strengthBadge.textContent = 'Weak'
        }
    }

    password.addEventListener("input", () => {

        strengthBadge.style.display= 'block'
        clearTimeout(timeout);
        timeout = setTimeout(() => StrengthChecker(password.value), 500);
        if(password.value.length !== 0){
            strengthBadge.style.display != 'block'
        } else{
            strengthBadge.style.display = 'none'
        }
    });

    function validate_user_name(){
		$("#user_name").val($.trim($("#user_name").val()));
		$("#user_name").removeClass('error_box');
    	if ($('#user_name').val().length == 0) {
        	$("#error_offer_name").html("required");
        	$("#offer_name").addClass('error_box');
        	// error_flag = true;
        	return false;
    	}
		else if ($('#user_name').val().length > 255) {
        	$("#error_user_name").html("max 255 characters");
        	$("#user_name").addClass('error_box');
        	// error_flag = true;
        	return false;
    	}
    	return true;
	}


    function validate_email_size(){
		$("#emailid").val($.trim($("#emailid").val()));
		$("#emailid").removeClass('error_box');
    	if ($('#emailid').val().length == 0) {
        	$("#error_email").html("required");
        	$("#emailid").addClass('error_box');
        	// error_flag = true;
        	return false;
    	}
    	return true;
	}

	function validate_password() {
		$("#password").val($.trim($("#password").val()));
		$("#password").removeClass('error_box');
		if ($('#password').val().length == 0) {
        	$("#error_email").html("required");
        	$("#emailid").addClass('error_box');
        	// error_flag = true;
        	return false;
    	}

    	$("#cpassword").removeClass('error_box');
    	if($('#password').val() != $('#cpassword').val()){
    		$("#error_cpassword").html("passwords don't match");
        	$("#error_cpassword").addClass('error_box');
        	// error_flag = true;
        	return false;
    	}
    	return true;
	}

	function InsertUser(){
		var data = {};
		data.user_name = $('#user_name').val();
		data.email_id = $('#emailid').val();
		data.password = $('#password').val();
		console.log(data);
		var ajax_url = BASE_URL + '/register/insert_user';
		$.ajax({
        url: ajax_url,
        type: 'POST',
        data: data,
        // async : false,
        success: function(result) {
        	if(result == true){
        		
        	}
        }
    });
	}

</script>