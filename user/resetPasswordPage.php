<?php

include ('db.php');
include ('forgotPassFun.php');

$uemail = $_GET['email'];
$token = $_GET['token'];

$userID = UserID($uemail);

$verifytoken = verifytoken($userID, $token);




if(isset($_POST['submit']))
{
	$new_password = $_POST['new_password'];
	$new_password = ($new_password);
	$retype_password = $_POST['retype_password'];
	$retype_password = ($retype_password);
	
	if($new_password == $retype_password)
	{
		$update_password = mysqli_query($con, "UPDATE users SET uPassword = '$new_password', tokenValid=0 WHERE uId = $userID") or die(mysqli_error($con));
		echo "<script>alert('Your password has changed successfully. Please login with your new passowrd.')</script>";
		echo "<script>window.location.href = 'login.php';
		</script>";
		
	}else
	{	
		echo "<script>alert('Password and Confirm Password are not same!')</script>";
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
	<?php 
	if(isset($_GET['email'])){ 
		?>
		<div class="mdc-layout-grid">
			<div class="mdc-layout-grid__inner">
				<div class="mdc-layout-grid__cell--span-3"></div>
				<div class="mdc-layout-grid__cell--span-6" align="center">
					<div class="mdc-card loginCard" align="center">
						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-2"></div>
								<div class="mdc-layout-grid__cell--span-8" align="center"><h1>Reset Your Password</h1></div>
								<div class="mdc-layout-grid__cell--span-2"></div>
							</div>
						</div>
						<form method="POST">
							<div class="mdc-layout-grid">
								<div class="mdc-layout-grid__inner">
									<div class="mdc-layout-grid__cell--span-3"></div>
									<div class="mdc-layout-grid__cell--span-6" align="center">
										<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
											<input type="password" name="new_password" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Enter New Password">
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
											<input type="password" name="retype_password" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Retype Password">
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
											<span class="mdc-button__label">Reset</span>
										</button>
									</div>	
								</div>
							</div>
						</form>
					</div>

				</div>
				<div class="mdc-layout-grid__cell--span-4"></div>
			</div>
		</div>
		<?php 
	}else{
		echo "<script>window.location.href = 'login.php'</script>";
	}
	?>




	<script type="text/javascript" src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
	<script type="text/javascript">
		const dialog = new mdc.dialog.MDCDialog(document.querySelector('.mdc-dialog'));
		mdc.textField.MDCTextField.attachTo(document.querySelector('.email'));
		mdc.textField.MDCTextField.attachTo(document.querySelector('.password'));
	</script>
</body>
</html>
