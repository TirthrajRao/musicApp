<?php
session_start();
if($_SESSION['uRole'] == "user"	){
}
else {
	header("location: login.php");
}
?>
<?php
require "db.php";
error_reporting(-1);
ini_set('display_errors', 'On');

if(isset($_GET['editPlaylist'])){
	$the_playlist_id = $_GET['editPlaylist'];
}

$query = "SELECT * FROM playlist WHERE pId=$the_playlist_id";
$select_playlist= mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($select_playlist)){
	$pName = $row['pName'];
	$pDescription = $row['pDescription'];
}


if(isset($_POST['submit'])){

	$pName = $_POST['pName'];
	$pDescription = $_POST['pDescription'];



	mysqli_query($con,"UPDATE playlist SET pName='$pName', pDescription='$pDescription' WHERE pId='$the_playlist_id' ") or die(mysqli_error($con));
	echo "<script>alert('Song updated Successfully!')

	</script>";

	header("Location: playlist.php");

	
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

</head>
<body>


	<aside class="mdc-drawer mdc-drawer--modal">
		<div class="mdc-drawer__content">
			<nav class="mdc-list">
				<a class="mdc-list-item mdc-list-item--activated" href="index.php" aria-selected="true">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">inbox</i>
					<span class="mdc-list-item__text">Home</span>
				</a>
				<a class="mdc-list-item" href="addSong.php">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">send</i>
					<span class="mdc-list-item__text">Add Songs</span>
				</a>
				<a class="mdc-list-item" href="playlist.php">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">drafts</i>
					<span class="mdc-list-item__text">My Playlist</span>
				</a>
				<a class="mdc-list-item" href="mySongs.php">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">drafts</i>
					<span class="mdc-list-item__text">My Songs</span>
				</a>
				<a class="mdc-list-item" href="myProfile.php">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">drafts</i>
					<span class="mdc-list-item__text">Profile</span>
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
		<header class="mdc-top-app-bar app-bar" style="background-color: #0b0b0b" id="app-bar">
			<div class="mdc-top-app-bar__row">
				<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
					<a href="#" class="demo-menu material-icons mdc-top-app-bar__navigation-icon">menu</a>
					<span class="mdc-top-app-bar__title">Welcome <?php echo $_SESSION['uEmail']; ?></span>
				</section>
			</div>
		</header>
		<main class="main-content" id="main-content" align="center">
			<div class="mdc-top-app-bar--fixed-adjust">
				<div class="mdc-layout-grid">
					<div class="mdc-layout-grid__inner">
						<div class="mdc-layout-grid__cell--span-12" align="center">
							<h1>Edit Song</h1>
						</div>
					</div>	
				</div>
				<form method="POST" enctype="multipart/form-data">




					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell--span-12" align="center">
								<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
									<input type="text" value="<?php echo $pName; ?>" name="pName" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Name">
									<div class="mdc-notched-outline">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</div>
							</div>

							<div class="mdc-layout-grid__cell--span-12" align="center">
								<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
									<input type="text" value="<?php echo $pDescription; ?>" name="pDescription" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Description">
									<div class="mdc-notched-outline">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</div>
							</div>

							<div class="mdc-layout-grid__cell--span-12">
								<button type="submit" class="mdc-button mdc-button--raised" name="submit">
									<span class="mdc-button__label">Edit Playlist</span>
								</button>
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