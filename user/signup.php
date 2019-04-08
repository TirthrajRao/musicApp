<?php
require "db.php";
error_reporting(-1);
ini_set('display_errors', 'On');
if(isset($_POST['submit'])){
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$displayname = $_POST['displayname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];

	$extsAllowed = array( 'jpg', 'jpeg', 'png', 'gif' );
	$extUpload = strtolower( substr( strrchr($_FILES['profilePic']['name'], '.') ,1) ) ;
	
	if (in_array($extUpload, $extsAllowed) ) { 

		$name = "userImages/{$_FILES['profilePic']['name']}";
		$result = move_uploaded_file($_FILES['profilePic']['tmp_name'], $name);
	}

	$check=mysqli_query($con,"SELECT * FROM users WHERE uEmail='$email'");
	$checkrows=mysqli_num_rows($check);
	if ($password != $confirmPassword){
		echo "<script>alert('Password and Confirm Password were not same, Pls Register again!')</script>";
	}else if ($checkrows > 0) {
		echo "<script>alert('User already exists, pls login!')</script>";
	}else{
		mysqli_query($con,"INSERT INTO `users`(`uFirstName`, `uLastName`, `uDisplayName`, `uEmail`, `uPassword`, `uProfilePic`,`token`) VALUES ('$firstname','$lastname','displayname','$email','$password','$name','')") or die(mysqli_error());
		echo "<script>alert('Registered Successfully!')
		
		</script>";
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<div class="mdc-layout-grid">
		<div class="mdc-layout-grid__inner">
			<div class="mdc-layout-grid__cell--span-1"></div>
			<div class="mdc-layout-grid__cell--span-10" align="center">
				<div class="mdc-card loginCard" align="center">
					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell--span-4"></div>
							<div class="mdc-layout-grid__cell--span-4" align="center"><h1>SignUp</h1></div>
							<div class="mdc-layout-grid__cell--span-4"></div>
						</div>
					</div>
					<form method="POST" enctype="multipart/form-data">
						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-1"></div>
								<div class="mdc-layout-grid__cell--span-5">
									<div class="mdc-text-field 	mdc-text-field--outlined mdc-text-field--no-label firstname">
										<input type="text" name="firstname" size="100%" class="mdc-text-field__input" aria-label="Label" placeholder="Enter your Firstname">
										<div class="mdc-notched-outline">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>
								<div class="mdc-layout-grid__cell--span-5">
									<div class="mdc-text-field 	mdc-text-field--outlined mdc-text-field--no-label lastname">
										<input type="text" name="lastname" size="100%" class="mdc-text-field__input" aria-label="Label" placeholder="Enter your Lastname">
										<div class="mdc-notched-outline">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>
								<div class="mdc-layout-grid__cell--span-1"></div>	
							</div>
						</div>

						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-1"></div>
								<div class="mdc-layout-grid__cell--span-10">
									<div class="mdc-text-field 	mdc-text-field--outlined mdc-text-field--no-label displayname">
										<input type="text" name="displayname" size="100%" class="mdc-text-field__input" aria-label="Label" placeholder="Enter your Display Name">
										<div class="mdc-notched-outline">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>
								<div class="mdc-layout-grid__cell--span-1"></div>	
							</div>
						</div>

						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-1"></div>
								<div class="mdc-layout-grid__cell--span-10">
									<div class="mdc-text-field 	mdc-text-field--outlined mdc-text-field--no-label email">
										<input type="email" name="email" size="100%" class="mdc-text-field__input" aria-label="Label" placeholder="Enter your Email">
										<div class="mdc-notched-outline">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>
								<div class="mdc-layout-grid__cell--span-1"></div>	
							</div>
						</div>

						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-1"></div>
								<div class="mdc-layout-grid__cell--span-5">
									<div class="mdc-text-field 	mdc-text-field--outlined mdc-text-field--no-label password">
										<input type="password" name="password" size="100%" class="mdc-text-field__input" aria-label="Label" placeholder="Enter your Password">
										<div class="mdc-notched-outline">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>
								<div class="mdc-layout-grid__cell--span-5">
									<div class="mdc-text-field 	mdc-text-field--outlined mdc-text-field--no-label confirmPassword">
										<input type="password" name="confirmPassword" size="100%" class="mdc-text-field__input" aria-label="Label" placeholder="Confirm Your Password">
										<div class="mdc-notched-outline">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>
								<div class="mdc-layout-grid__cell--span-1"></div>	
							</div>
						</div>

						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-1"></div>
								<div class="mdc-layout-grid__cell--span-5" style="align-items: left">
									<label>Your Profile Photo: </label>
									<input type="file" name="profilePic">
								</div>
								<div class="mdc-layout-grid__cell--span-1"></div>	
							</div>
						</div>

						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-1">

								</div>
								<div class="mdc-layout-grid__cell--span-1 mdc-layout-grid__cell--align-left">
									<button type="submit" class="mdc-button mdc-button--raised" name="submit">
										<span class="mdc-button__label">SignUp</span>
									</button>
								</div>
								<div class="mdc-layout-grid__cell--span-5">
									<a href="login.php" class="signupLink">Already Registered?Login Here</a>
								</div>
								<div class="mdc-layout-grid__cell--span-1">
								</div>	
							</div>
						</div>
					</form>

				</div>

			</div>
			<div class="mdc-layout-grid__cell--span-1"></div>
		</div>
	</div>
	<script type="text/javascript" src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
	<script type="text/javascript">

		mdc.textField.MDCTextField.attachTo(document.querySelector('.firstname'));
		mdc.textField.MDCTextField.attachTo(document.querySelector('.lastname'));
		mdc.textField.MDCTextField.attachTo(document.querySelector('.displayname'));
		mdc.textField.MDCTextField.attachTo(document.querySelector('.email'));
		mdc.textField.MDCTextField.attachTo(document.querySelector('.password'));
		mdc.textField.MDCTextField.attachTo(document.querySelector('.confirmPassword'));
		mdc.textField.MDCTextField.attachTo(document.querySelector('.password'));
	</script>
</body>
</html>