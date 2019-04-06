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
if(isset($_POST['submit'])){
	$pName = $_POST['pName'];
	$pDescription = $_POST['pDescription'];
	$uId = $_SESSION['uId'];
	

	mysqli_query($con,"INSERT INTO playlist(uId, pName, pDescription) VALUES ('$uId', '$pName','$pDescription')") or die(mysqli_error($con));
	echo "<script>alert('Playlist added Successfully!')

	</script>";
}
?>

<?php
if(isset($_GET['deletePlaylist'])){
	$the_playlist_id = $_GET['deletePlaylist'];

	$query1 = "DELETE FROM playlistSong WHERE pId = {$the_playlist_id}";
	$delete_query1 = mysqli_query($con, $query1) or die("Delete Error!" . mysqli_error($con));

	$query2 = "DELETE FROM playlist WHERE pId = {$the_playlist_id}";
	$delete_query2 = mysqli_query($con, $query2) or die("Delete Error!" . mysqli_error($con));
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
		<main class="main-content" id="main-content">
			<div class="mdc-top-app-bar--fixed-adjust">
				<div class="mdc-layout-grid">
					<div class="mdc-layout-grid__inner">
						<div class="mdc-layout-grid__cell--span-12">
							<button class="mdc-button mdc-button--raised" onCLick="dialog.open()"  style="margin-top: 30px; background-color: black">
								<span class="mdc-button__label">Add Playlist</span>
							</button>
						</div>
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
							<h2 class="mdc-dialog__title" id="my-dialog-title">Add Playlist
							</h2>
							<div class="mdc-dialog__content" id="my-dialog-content">
								<div class="mdc-layout-grid">
									<div class="mdc-layout-grid__inner">
										<div class="mdc-layout-grid__cell--span-12">
											<div class="mdc-layout-grid">
												<div class="mdc-layout-grid__inner">
													<div class="mdc-layout-grid__cell--span-12">
														<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
															<input type="text" name="pName" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Playlist Name">
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

								<div class="mdc-layout-grid">
									<div class="mdc-layout-grid__inner">
										<div class="mdc-layout-grid__cell--span-12">
											<div class="mdc-layout-grid">
												<div class="mdc-layout-grid__inner">
													<div class="mdc-layout-grid__cell--span-12">
														<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
															<input type="text" name="pDescription" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Description... #happy">
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
								<button type="submit" name="submit" class="mdc-button mdc-dialog__button mdc-dialog__button--default" data-mdc-dialog-action="yes">
									<span class="mdc-button__label">Add</span>
								</button>
							</footer>
						</div>
					</form>
				</div>
				<div class="mdc-dialog__scrim">

				</div>
			</div>
			<div class="mdc-layout-grid">
				<div class="mdc-layout-grid__inner">
					<div class="mdc-layout-grid__cell--span-12">
						<h2>My Playlists</h2>
					</div>
				</div>
			</div>
			<div class="mdc-layout-grid">
				<div class="mdc-layout-grid__inner">
					<?php
					$uId = $_SESSION['uId'];
					$query = "SELECT * FROM playlist WHERE uId=$uId";
					$select_playlist= mysqli_query($con,$query);
					$counter = 0;
					while($row = mysqli_fetch_assoc($select_playlist)){
						$pId = $row['pId'];
						$pName = $row['pName'];
						$pDescription = $row['pDescription'];
						$counter++;	
						?>

						<div class="mdc-layout-grid__cell--span-4">
							<div class="mdc-card demo-card">
								<div class="mdc-card__primary-action demo-card__primary-action contentCard" tabindex="0">
									<div class="mdc-card__media mdc-card__media--8-3 demo-card__media userProfilePic">
										Playlist <?php echo $counter; ?><br><br>									
									</div>
									<div class="demo-card__secondary mdc-typography mdc-typography--body2">
										<span style="font-weight: bolder;">Name: </span><?php echo $pName ;?><br>
										<span style="font-weight: bolder;"> Description:</span> <?php echo $pDescription; ?>
									</div>
								</div>
								<div class="mdc-card__actions" pull="right">
									<?php
									echo "<a href='viewDetailsPlaylist.php?playlistDetail=$pId'><button class='mdc-button mdc-card__action mdc-card__action--button' style='background-color: #fb535b;color:white;margin-right:5px;'>Play <?php ?></button></a>";
									?>
									<?php
									echo "<a href='editPlaylist.php?editPlaylist=$pId' style='text-decoration: none'><button class='mdc-button mdc-card__action mdc-card__action--button' style='background-color: black;color:white;margin-right:5px'>Edit</button></a>";
									?>
									<?php
									echo "<a href='playlist.php?deletePlaylist=$pId' onClick=\"javascript: return confirm('Are you sure you want to delete?');\"><button class='mdc-button mdc-card__action mdc-card__action--button blockButton ' style='background-color:red!important;'>Delete</button></a>";
									?>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>

			<!-- view fav playlist ********************************* -->
			<div class="mdc-layout-grid">
				<div class="mdc-layout-grid__inner">
					<div class="mdc-layout-grid__cell--span-12">
						<h2>Favourite Playlist:</h2>
					</div>
				</div>
			</div>
			<div class="mdc-layout-grid">
				<div class="mdc-layout-grid__inner">
					<?php
					$uId = $_SESSION['uId'];
					$query = "SELECT * FROM favUnfav WHERE uId=$uId";
					$select_playlist_fav= mysqli_query($con,$query);
					$counter = 0;
					while($row = mysqli_fetch_assoc($select_playlist_fav)){
						$pId = $row['pId'];

						$query1 = "SELECT * FROM playlist WHERE pId=$pId";
						$select_playlist1= mysqli_query($con,$query1);
						while($row = mysqli_fetch_assoc($select_playlist1)){
							$pId = $row['pId'];
							$pName = $row['pName'];
							$pDescription = $row['pDescription'];
							$counter++;	
							?>

							<div class="mdc-layout-grid__cell--span-4">
								<div class="mdc-card demo-card">
									<div class="mdc-card__primary-action demo-card__primary-action contentCard" tabindex="0">
										<div class="mdc-card__media mdc-card__media--8-3 demo-card__media userProfilePic">
											Playlist <?php echo $counter; ?><br><br>									
										</div>
										<div class="demo-card__secondary mdc-typography mdc-typography--body2">
											<span style="font-weight: bolder;">Name: </span><?php echo $pName ;?><br>
											<span style="font-weight: bolder;"> Description:</span> <?php echo $pDescription; ?>
										</div>
									</div>
									<div class="mdc-card__actions" pull="right">
										<?php
										echo "<a href='viewDetailsPlaylist.php?playlistDetail=$pId'><button class='mdc-button mdc-card__action mdc-card__action--button' style='background-color: #fb535b;color:white;margin-right:5px;'>Play <?php ?></button></a>";
										?>
									</div>
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
	const dialog = new mdc.dialog.MDCDialog(document.querySelector('.mdc-dialog'));

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