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
	<link rel="stylesheet" type="text/css" href="../user/css/searchBox.css">
</head>

<body>

	<?php include "header.php"; ?>
	
	<div class="mdc-drawer-scrim"></div>
	<div class="mdc-drawer-app-content">
		<?php include "navbar.php";  ?>
		<main class="main-content" id="main-content">
			<div class="mdc-top-app-bar--fixed-adjust">
				<div class="mdc-layout-grid">
					<div class="mdc-layout-grid__inner">
						<div class="mdc-layout-grid__cell--span-3">
							<h2>All Users:</h2>
						</div>
					</div>
				</div>
				<div class="mdc-layout-grid userGrid">
					<div class="mdc-layout-grid__inner">
						<?php
						include "db.php";
						$p =4;
						$coun=mysqli_query($con,"select count(*) as cou from users");
						$coun_row=mysqli_fetch_array($coun);
						$tot=$coun_row['cou'];
	//echo $tot;
						$page=ceil($tot/$p);	
	//echo $page;


						if(isset($_GET['k']))
						{
							$page_coun=$_GET['k'];
						}
						else
						{
							$page_coun=1;
						}

						$k=($page_coun-1)*$p;


						$query = "SELECT * FROM users ORDER BY uId DESC  LIMIT $k,$p";
						$select_users= mysqli_query($con,$query) or die(mysql_error($con));
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
				<center style="background-color: red;">
					<?php
					for($i=1;$i<=$page;$i++)
					{
						echo '<a href="allUsers.php?k='.$i.'" style="margin-right:5px;color:white">'.$i.'</a>';
					}
					?>
				</center>
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