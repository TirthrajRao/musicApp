<?php
session_start();
error_reporting(-1);
ini_set('display_errors', 'On');
if($_SESSION['uRole'] == "admin"){
}else{
	header("location: ../user/login.php");
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
	<link rel="stylesheet" href="./css/style.css">
</head>

<body>

	<aside class="mdc-drawer mdc-drawer--modal">
		<div class="mdc-drawer__content">
			<nav class="mdc-list">
				<a class="mdc-list-item mdc-list-item--activated" href="dashboard.php" aria-selected="true">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">inbox</i>
					<span class="mdc-list-item__text">Dashboard</span>
				</a>
				<a class="mdc-list-item" href="allUsers.php">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">send</i>
					<span class="mdc-list-item__text">All Users</span>
				</a>
				<a class="mdc-list-item" href="addSong.php">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">drafts</i>
					<span class="mdc-list-item__text">Add Songs</span>
				</a>
				<a class="mdc-list-item" href="allSongs.php">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">send</i>
					<span class="mdc-list-item__text">All Songs</span>
				</a>
				<a class="mdc-list-item" href="logout.php">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">drafts</i>
					<span class="mdc-list-item__text">Log Out</span>
				</a>
			</nav>
		</div>
	</aside>
	<div class="mdc-drawer-scrim"></div>
	<div class="mdc-drawer-app-content">
		<header class="mdc-top-app-bar app-bar" id="app-bar">
			<div class="mdc-top-app-bar__row">
				<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
					<a href="#" class="demo-menu material-icons mdc-top-app-bar__navigation-icon">menu</a>
					<span class="mdc-top-app-bar__title">Signal Play</span>
				</section>
			</div>
		</header>
		<main class="main-content" id="main-content">
			<div class="mdc-top-app-bar--fixed-adjust">
				<div class="mdc-layout-grid userGrid">
					<div class="mdc-layout-grid__inner">
						<?php
						include "db.php";
						$query = "SELECT * FROM users";
						$select_users= mysqli_query($con,$query);
						while($row = mysqli_fetch_assoc($select_users)){
							$uId = $row['uId'];
							$uFirstName = $row['uFirstName'];
							$uLastName = $row['uLastName'];
							$uDisplayName = $row['uDisplayName'];
							$uEmail = $row['uEmail'];
							$uProfilePic = $row['uProfilePic'];
							$uDateOfReg = $row['uDateOfReg'];
							$isBlocked = $row['isBlocked'];
							?>
							<div class="mdc-layout-grid__cell--span-3">
								<div class="mdc-card demo-card">
									<div class="mdc-card__primary-action demo-card__primary-action contentCard" tabindex="0">
										<div class="mdc-card__media mdc-card__media--8-3 demo-card__media userProfilePic">
											<img src="../user/<?php echo $uProfilePic; ?>" width="150px" height="150px">
										</div>
										<div class="demo-card__primary">
											<h2 class="demo-card__title mdc-typography mdc-typography--headline6"><?php echo $uFirstName . " " . $uLastName ;?></h2>
											<h3 class="demo-card__subtitle mdc-typography mdc-typography--subtitle2">Registered on <?php echo date($uDateOfReg); ?></h3>
										</div>
										<div class="demo-card__secondary mdc-typography mdc-typography--body2">
											Email: <?php echo $uEmail; ?>
										</div>
									</div>
									<div class="mdc-card__actions">
										<div class="mdc-card__action-buttons actionBlock">
											<?php 
											if($isBlocked == 1){
												echo "<a href='allUsers.php?change_to_unblock=$uId'><button class='mdc-button mdc-card__action mdc-card__action--button unblockButton'>Unblock</button></a>";
											}else{
												echo "<a href='allUsers.php?change_to_block=$uId'><button class='mdc-button mdc-card__action mdc-card__action--button blockButton'>Block</button></a>";
											}
											?>
											<?php
											echo "<a href='viewDetailUser.php?viewDetails=$uId'>";
											?>
											<button class='mdc-button mdc-card__action mdc-card__action--button blockButton' style="margin-left: 10px;background-color: black!important;">View Details</button>
											<?php
											echo "</a>";
											?>
										</div>
									</div>
								</div>
							</div>	
							<?php
						}
						?>
					</div>
					<?php

					if(isset($_GET['change_to_unblock'])){
						$the_user_id = $_GET['change_to_unblock'];

						$query = "UPDATE users SET isBlocked = 0 WHERE uId = $the_user_id";
						$change_to_unblock = mysqli_query($con, $query) or die("Error!" . mysqli_error($con));
						echo "<script>window.location = 'allUsers.php'</script>";
					}
					?>

					<?php

					if(isset($_GET['change_to_block'])){
						$the_user_id = $_GET['change_to_block'];

						$query = "UPDATE users SET isBlocked = 1 WHERE uId = $the_user_id";
						$change_to_unblock = mysqli_query($con, $query) or die("Error!" . mysqli_error($con));
						echo "<script>window.location = 'allUsers.php'</script>";
					}
					?>
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