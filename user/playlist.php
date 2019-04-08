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

	$query1 = "DELETE FROM favUnfav WHERE pId = {$the_playlist_id}";
	$delete_query1 = mysqli_query($con, $query1) or die("Delete Error!" . mysqli_error($con));

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
					$p =9;
					$coun=mysqli_query($con,"select count(*) as cou from songs");
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

					$uId = $_SESSION['uId'];
					$query = "SELECT * FROM playlist WHERE uId=$uId LIMIT $k,$p";
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

			<center style="background-color: red;">
				<?php
				for($i=1;$i<=$page;$i++)
				{
					echo '<a href="playlist.php?k='.$i.'" style="margin-right:5px;color:white">'.$i.'</a>';
				}
				?>
			</center>

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
					$p =9;
					$coun=mysqli_query($con,"select count(*) as cou from playlist");
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


					$uId = $_SESSION['uId'];
					$query = "SELECT * FROM favUnfav WHERE uId=$uId LIMIT $k,$p";
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
			<center style="background-color: red;">
				<?php
				for($i=1;$i<=$page;$i++)
				{
					echo '<a href="playlist.php?k='.$i.'" style="margin-right:5px;color:white">'.$i.'</a>';
				}
				?>
			</center>

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