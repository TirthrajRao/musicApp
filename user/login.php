	<?php
	require "db.php";
	include ('forgotPassFun.php');

	session_start();
	error_reporting(-1);
	ini_set('display_errors', 'On');
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

			$check=mysqli_query($con,"SELECT * FROM users WHERE uEmail = '$email' AND uPassword = '$password'")  or die(mysqli_error($con));
			while($row = mysqli_fetch_array($check)){

				$user_role = $row['role'];
				$uId = $row['uId'];
				$status = $row['isBlocked'];
				
			}
			if($user_role=="user" && $status==0){
				$_SESSION['uRole'] = "user";
				$_SESSION['uEmail'] = $email;
				$_SESSION['uId'] = $uId;
				header("location:index.php"); 
			} else if ($user_role=="admin" && $status==0) {
				$_SESSION['uRole'] = "admin";
				$_SESSION['uEmail'] = $email;
				$_SESSION['uId'] = $uId;
				header("location:../admin/dashboard.php");
			}else if($status == 1){
				echo '<script>alert("Your account has been suspended by admin!")</script>';
			} 
			else  
			{  
				echo '<script>alert("Wrong User Details")</script>';  
			}  
		}  
	}  

	if(isset($_POST["reset"])){
		$email = $_POST['email'];

		$user_check = mysqli_query($con,"SELECT * FROM users WHERE uEmail = '$email'") or die(mysql_error($con));
		$countUser = mysqli_num_rows($user_check);
		$userDetail = mysqli_fetch_array($user_check);
		$email_data = $userDetail['uEmail'];

		if($email == $email_data){
			$userID = UserID($email);
			$token = generateRandomString();
			
			$query = mysqli_query($con, "UPDATE users SET token='$token' WHERE uId ='$userID'");
			if($query)
			{
				$send_mail = send_mail($email, $token);


				if($send_mail === 'success')
				{
					echo "<script>alert('A mail with recovery instruction has sent to your email.')</script>";
				}else{
					echo "<script>alert('There is something wrong')</script>";
				}



			}else
			{
				echo "<script>alert('There is something wrong')</script>";
				
			}
		}else{
			echo '<script>alert("Email not found!")</script>';  
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
										<a  class="signupLink" style="cursor: pointer;color: red" onCLick="dialog.open()">Forgot Password?Click here</a><br>

										

										<a href="signup.php" class="signupLink">New? Register here!</a>
									</div>	
								</div>
							</div>
						</form>
					</div>

				</div>
				<div class="mdc-layout-grid__cell--span-4"></div>
			</div>
		</div>


		<div class="mdc-dialog"
		role="alertdialog"
		aria-modal="true"
		aria-labelledby="my-dialog-title"
		aria-describedby="my-dialog-content">
		<div class="mdc-dialog__container">
			<form method="POST" enctype="multipart/form-data">
				<div class="mdc-dialog__surface">
					<h2 class="mdc-dialog__title" id="my-dialog-title">Reset Password
					</h2>
					<div class="mdc-dialog__content" id="my-dialog-content">
						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-12">
									<div class="mdc-layout-grid">
										<div class="mdc-layout-grid__inner">
											<div class="mdc-layout-grid__cell--span-12">
												<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
													<input type="email" name="email" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Enter your email">
													<div class="mdc-notched-outline">
														<div class="mdc-notched-outline__leading"></div>
														<div class="mdc-notched-outline__trailing"></div>
													</div>
												</div>
											</div>	
										</div>
									</div>
								</div>	
							</div>
						</div>
					</div>
					<footer class="mdc-dialog__actions">
						<button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="no">
							<span class="mdc-button__label">Cancel</span>
						</button>
						<button type="submit" name="reset" class="mdc-button mdc-dialog__button mdc-dialog__button--default" data-mdc-dialog-action="yes">
							<span class="mdc-button__label">Reset</span>
						</button>
					</footer>
				</div>
			</form>
		</div>
		<div class="mdc-dialog__scrim">

		</div>
	</div>


	<script type="text/javascript" src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
	<script type="text/javascript">
		const dialog = new mdc.dialog.MDCDialog(document.querySelector('.mdc-dialog'));
		mdc.textField.MDCTextField.attachTo(document.querySelector('.email'));
		mdc.textField.MDCTextField.attachTo(document.querySelector('.password'));
	</script>
</body>
</html>