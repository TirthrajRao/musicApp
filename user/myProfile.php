<?php
session_start();
if($_SESSION['uRole'] == "user"	){
}
else {
	header("location: login.php");
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
						<div class="mdc-layout-grid__cell--span-4">
						</div>
						<?php
						include "db.php";
						$uId = $_SESSION['uId'];
						$query = "SELECT * FROM users WHERE uId = '$uId'";
						$select_user= mysqli_query($con,$query);
						$rowcount=mysqli_num_rows($select_user);
						if ($rowcount != 0) {
							while($row = mysqli_fetch_assoc($select_user)){
								$uId = $row['uId'];
								$uFirstName = $row['uFirstName'];
								$uLastName = $row['uLastName'];
								$uDisplayName = $row['uDisplayName'];
								$uEmail = $row['uEmail'];
								$uProfilePic = $row['uProfilePic'];
								$uDateOfReg = $row['uDateOfReg'];
								$isBlocked = $row['isBlocked'];

								?>

								<div class="mdc-layout-grid__cell--span-4" align="center">
									<div class="mdc-card demo-card">
										<div class="mdc-card__primary-action demo-card__primary-action contentCard" tabindex="0">
											<div class="mdc-card__media mdc-card__media--8-3 demo-card__media userProfilePic">

												<img src="<?php echo $uProfilePic; ?>" width="150px" height="150px">
											</div>
											<div class="demo-card__primary">
												<h2 class="demo-card__title mdc-typography mdc-typography--headline6"><?php echo $uFirstName . " " . $uLastName ;?></h2>
												
											</div>
											<div class="demo-card__secondary mdc-typography mdc-typography--body2">
												<p><span style="font-weight: bolder;">Display Name:</span><?php echo $uDisplayName; ?></p>
												<p><span style="font-weight: bolder;">Email:</span> <?php echo $uEmail; ?></p>
											</div>
										</div>
										<div class="mdc-card__actions">
											<div class="mdc-layout-grid">
												<div class="mdc-layout-grid__inner">
													<div class="mdc-layout-grid__cell--span-12">

														<?php
														echo "<a href='editProfile.php?editProfile=$uId'><button class='mdc-button mdc-card__action mdc-card__action--button blockButton'>Edit</button></a>";

														echo "<a href='resetPassword.php?resetPass=$uId'><button class='mdc-button mdc-card__action mdc-card__action--button blockButton' style='margin-left:10px; background-color:red!important'>Reset Password</button></a>";

														?>
													</div>
												</div>
											</div>
										</div	>
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
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