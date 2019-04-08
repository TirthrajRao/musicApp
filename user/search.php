<?php
session_start();
if($_SESSION['uRole'] == "user"){
}
else {
	header("location: login.php");
}

$heading = $_GET['query'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<style type="text/css" href="css/table.css"></style>
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
							<h3>Playlists with hashtags: "<?php echo $heading;?>":</h3>
						</div>
					</div>
				</div>
				<div class="mdc-layout-grid">
					<div class="mdc-layout-grid__inner">
						<?php
						include "db.php";
						$goodUrl = str_replace('#', '', $_GET['query']);
						$query = "#" . $goodUrl; 
						$min_length = 3;

						if(strlen($query) >= $min_length){


							$check=mysqli_query($con,"SELECT * FROM playlist WHERE pDescription LIKE '%$query%'")  or die(mysqli_error($con));

							if(mysqli_num_rows($check) > 0){
								$counter = 0;
								while($results = mysqli_fetch_array($check)){
									$uId = $_SESSION['uId'];
									$pId = $results['pId'];
									$pDescription = $results['pDescription'];
									$upId = $results['uId'];
									$pName = $results['pName'];
									$counter++;
									?>

									<div class="mdc-layout-grid__cell--span-4">
										<div class="mdc-card demo-card">
											<div class="mdc-card__primary-action demo-card__primary-action contentCard" tabindex="0" >
												<div class="mdc-card__media mdc-card__media--8-3 demo-card__media userProfilePic" style="margin-left: 10px">
													Playlist <?php echo $counter; ?><br><br>									
												</div>
												<div class="demo-card__secondary mdc-typography mdc-typography--body2" style="margin-left: 10px">
													<span style="font-weight: bolder;">Name: </span><?php echo $pName ;?><br>
													<span style="font-weight: bolder;"> Description:</span> <?php echo $pDescription; ?>
												</div>
											</div>
											<div class="mdc-card__actions" pull="right">
												<?php
												echo "<a href='viewDetailsPlaylist.php?playlistDetail=$pId' style='text-decoration: none'><button class='mdc-button mdc-card__action mdc-card__action--button' style='background-color: #fb535b;color:white;margin-right:5px;'>Play <?php ?></button></a>";

												if ($upId == $uId) {

													echo "<a href='editPlaylist.php?editPlaylist=$pId' style='text-decoration: none'><button class='mdc-button mdc-card__action mdc-card__action--button' style='background-color: black;color:white;margin-right:5px'>Edit</button></a>";
													echo "<a href='playlist.php?deletePlaylist=$pId' onClick=\"javascript: return confirm('Are you sure you want to delete?');\" style='text-decoration: none'><button class='mdc-button mdc-card__action mdc-card__action--button blockButton ' style='background-color:red!important;color:white'>Delete</button></a>";
												}
												?>
											</div>
										</div>
									</div>
									<?php
								}

							}
							else{ 
								echo "No results";
							}

						}
						else{
							echo '<script>alert("Minimum length must be ' . $min_length .'")</script>';  
							echo "<script>window.location.href = 'index.php'</script>";
						}
						?>
					</div>
				</div>
			</div>
		</main>
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