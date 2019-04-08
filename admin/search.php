<?php
session_start();
error_reporting(-1);
ini_set('display_errors', 'On');
if($_SESSION['uRole'] == "admin"){
}else{
	header("location: ../user/login.php");
}
include "db.php";


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
	<link rel="stylesheet" type="text/css" href="../user/css/searchBox.css">
	<style type="text/css">
		.mdc-layout-grid{
			padding-left: 0px;
		}

		#spanHeading{
			font-weight: bolder;
		}
	</style>
</head>

<body>

	<?php include "header.php"; ?>
	
	<div class="mdc-drawer-scrim"></div>
	<div class="mdc-drawer-app-content">
		<?php include "navbar.php";  ?>

		<?php
		$queryLength = strlen($_GET['query']);
		$min_length = 3;

		if($queryLength >= $min_length){
			$searchName = $_GET['query'];
			?>
			<main class="main-content" id="main-content" style="margin-top: 50px;">
				<div class="mdc-top-app-bar--fixed-adjust">
					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell--span-4">
								<h3>Results for: "<?php echo $searchName;?>"</h3>
							</div>
						</div>
					</div>
					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<?php
							$check=mysqli_query($con,"SELECT * FROM users WHERE CONCAT(uFirstName,uLastName) LIKE '%$searchName%'")  or die(mysqli_error($con));

							if(mysqli_num_rows($check) > 0){
								$counter = 0;
								while($row = mysqli_fetch_array($check)){
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
										<div class="mdc-card demo-card" style="margin-bottom: 30px!important">
											<div class="mdc-card__primary-action demo-card__primary-action contentCard" tabindex="0" >
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
													// if($isBlocked == 1){
													// 	echo "<a href='allUsers.php?change_to_unblock=$uId'><button class='mdc-button mdc-card__action mdc-card__action--button unblockButton'>Unblock</button></a>";
													// }else{
													// 	echo "<a href='allUsers.php?change_to_block=$uId'><button class='mdc-button mdc-card__action mdc-card__action--button blockButton'>Block</button></a>";
													// }
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
							}else{
								?>
								<div class="mdc-layout-grid">
									<div class="mdc-layout-grid__inner">
										<div class="mdc-layout-grid__cell--span-12">
											<h2>No Results!</h2>
										</div>
									</div>
								</div>
								<?php
							}
						}else{
							echo "<script>alert('Write atleast 3 characters to search!')</script>";
							echo "<script>window.location.href = 'dashboard.php'</script>";
						}
						?>
					</div>
				</div>
			</div>
		</main>
	</div>

	<script type="text/javascript" src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>

	<script type="text/javascript">

		document.addEventListener('play', function(e){
			var audios = document.getElementsByTagName('audio');
			for(var i = 0, len = audios.length; i < len;i++){
				if(audios[i] != e.target){
					audios[i].pause();
				}
			}
		}, true);

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