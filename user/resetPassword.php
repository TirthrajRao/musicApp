<?php
session_start();
error_reporting(-1);
ini_set('display_errors', 'On');
if($_SESSION['uRole'] == "user"){
}
?>

<?php
if(isset($_GET['resetPass'])){
	$the_user_id = $_GET['resetPass'];
}

include "db.php";

if(isset($_POST['submit'])){
	$oldPass = $_POST['oldPass'];
	$newPass = $_POST['newPass'];
	$newPassConf = $_POST['newPassConf'];

	$query = "SELECT * FROM users WHERE uId = '$the_user_id'";
	$select_user= mysqli_query($con,$query);
	$row = mysqli_fetch_assoc($select_user);	
	$uPassword = $row['uPassword'];

	if($oldPass == $uPassword){
		if($newPass == $newPassConf){
			mysqli_query($con,"UPDATE users SET uPassword='$newPass' WHERE uId='$the_user_id' ") or die(mysqli_error($con));
			echo "<script>alert('Password reset successfully!')
			</script>";
			echo "<script>window.location.href = 'myProfile.php';
			</script>";
		}else{
			echo "<script>alert('Password and Confirm password are not same!')</script>";	
		}
	}else{
		echo "<script>alert('Old Password is not correct!')</script>";
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
	<link rel="stylesheet" href="../admin/css/style.css">
	<link rel="stylesheet" type="text/css" href="css/searchBox.css">
</head>
<body>


	<?php
	include "header.php";
	?>

	<div class="mdc-drawer-scrim"></div>
	<div class="mdc-drawer-app-content">
		<?php include "navbar.php"; ?>
		<main class="main-content" id="main-content">
			<div class="mdc-top-app-bar--fixed-adjust">
				<div class="mdc-layout-grid">
					<div class="mdc-layout-grid__inner">
						<div class="mdc-layout-grid__cell--span-12" align="center">
							<h1>Reset Your Password</h1>
						</div>
					</div>	
				</div>
				<form method="POST" enctype="multipart/form-data">

					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell--span-12" align="center">
								<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
									<input type="password"  name="oldPass" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Enter old password">
									<div class="mdc-notched-outline">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</div>
							</div>	
						</div>
					</div>

					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell--span-12" align="center">
								<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
									<input type="password"  name="newPass" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Enter new password">
									<div class="mdc-notched-outline">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</div>
							</div>	
						</div>
					</div>

					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell--span-12" align="center">
								<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
									<input type="password" name="newPassConf" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Confirm your new password">
									<div class="mdc-notched-outline">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</div>
							</div>	
						</div>
					</div>
					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell--span-12" align="center">
								<button type="submit" name="submit" class="mdc-button mdc-dialog__button mdc-dialog__button--default" data-mdc-dialog-action="yes" style="background-color: blue; color: white">
									<span class="mdc-button__label">Update</span>
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</main>
	</div>
	<script type="text/javascript" src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>

	<script type="text/javascript">
		const topAppBar = mdc.topAppBar.MDCTopAppBar.attachTo(document.getElementById('app-bar'))
		const drawer = mdc.drawer.MDCDrawer.attachTo(document.querySelector('.mdc-drawer'))

		const listEl = document.querySelector('.mdc-drawer .mdc-list');
		const mainContentEl = document.querySelector('.main-content');

		topAppBar.setScrollTarget(document.getElementById('main-content'))
		topAppBar.listen('MDCTopAppBar:nav', () => {
			drawer.open = !drawer.open
		})

		listEl.addEventListener('click', (event) => {
			drawer.open = false;
		});

	</script>
</body>
</html>