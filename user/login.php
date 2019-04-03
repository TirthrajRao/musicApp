<?php
require "db.php";

if(isset($_POST["submit"]))  
{  
	if(empty($_POST["email"]))  
	{  
		echo '<script>alert("Email is required!")</script>';  
	}elseif(empty($_POST["password"])){  
		echo '<script>alert("Password is required!")</script>';  
	}  
	else  
	{  
		
		$email = mysqli_real_escape_string($con, $_POST["email"]);  
		$password = mysqli_real_escape_string($con, $_POST["password"]); 



		$query = "SELECT * FROM users WHERE uEmail = '$email' AND uPassword = '$password'";  
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result) > 0)  
		{     
			$_SESSION['uEmail'] = $email;
			header("location:index.php");  
		}  
		else  
		{  
			echo '<script>alert("Wrong User Details")</script>';  
		}  
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
			<div class="mdc-layout-grid__cell--span-3"></div>
			<div class="mdc-layout-grid__cell--span-6" align="center">
				<div class="mdc-card loginCard" align="center">
					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell--span-4"></div>
							<div class="mdc-layout-grid__cell--span-4" align="center"><h1>Login</h1></div>
							<div class="mdc-layout-grid__cell--span-4"></div>
						</div>
					</div>
					<form method="POST">
						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-3"></div>
								<div class="mdc-layout-grid__cell--span-6" align="center">
									<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
										<input type="text" name="email" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Enter your Email">
										<div class="mdc-notched-outline">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>
								<div class="mdc-layout-grid__cell--span-3"></div>	
							</div>
						</div>

						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-3"></div>
								<div class="mdc-layout-grid__cell--span-6" align="center">
									<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label password">
										<input type="password" name="password" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Enter your Password">
										<div class="mdc-notched-outline">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>
								<div class="mdc-layout-grid__cell--span-3"></div>	
							</div>
						</div>
						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-3">

								</div>
								<div class="mdc-layout-grid__cell--span-2" >
									<button type="submit" name="submit" class="mdc-button mdc-button--raised">
										<span class="mdc-button__label">Login</span>
									</button>
								</div>
								<div class="mdc-layout-grid__cell--span-5">
									<a href="signup.php" class="signupLink">New? Register here</a>
								</div>	
							</div>
						</div>
					</form>
				</div>

			</div>
			<div class="mdc-layout-grid__cell--span-4"></div>
		</div>
	</div>





	<script type="text/javascript" src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
	<script type="text/javascript">

		mdc.textField.MDCTextField.attachTo(document.querySelector('.email'));
		mdc.textField.MDCTextField.attachTo(document.querySelector('.password'));
	</script>
</body>
</html>