<?php
session_start();
if($_SESSION['uRole'] == "user"){
}
else {
	header("location: login.php");
}
?>
<?php
include "db.php";
if(isset($_GET['fav_uId']) &&  isset($_GET['fav_pId'])){
	$fav_uId =  $_GET['fav_uId'];
	$fav_pId =  $_GET['fav_pId'];

	mysqli_query($con,"INSERT INTO favUnfav(uId,pId) VALUES ('$fav_uId','$fav_pId')") or die(mysqli_error($con));
	echo "<script>alert('Added to favourite!')
	</script>";
	echo "<script>window.location.href = 'index.php';
	</script>";
}

if(isset($_GET['unfav_uId']) &&  isset($_GET['unfav_pId'])){
	$unfav_uId =  $_GET['unfav_uId'];
	$unfav_pId =  $_GET['unfav_pId'];

	$query = "DELETE FROM favUnfav WHERE uId = {$unfav_uId} AND pId = {$unfav_pId}";
	$delete_query = mysqli_query($con, $query) or die("Delete Error!" . mysqli_error($con));
	echo "<script>alert('Successfully removed from favourite!')
	</script>";
	echo "<script>window.location.href = 'index.php';
	</script>";
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
	<style type="text/css" href="css/table.css"></style>
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
							<h2>Playlists:</h2>	
						</div>
					</div>
				</div>
				<div class="mdc-layout-grid">
					<div class="mdc-layout-grid__inner">
						<?php
						$uId = $_SESSION['uId'];
						$playlist=mysqli_query($con,"SELECT * FROM playlist")  or die(mysqli_error($con));

						if(mysqli_num_rows($playlist) > 0){
							$counter = 0;
							while($resP = mysqli_fetch_array($playlist)){
								$pId = $resP['pId'];
								$pDescription = $resP['pDescription'];
								$pName = $resP['pName'];
								$upId = $resP['uId'];
								$getUserP=mysqli_query($con,"SELECT * FROM users WHERE uId = $upId")  or die(mysqli_error($con));
								$counter++;
								if(mysqli_num_rows($getUserP) > 0){

									while($resPu = mysqli_fetch_array($getUserP)){
										$uFirstName = $resPu['uFirstName'];
										$uLastName = $resPu['uLastName'];
										?>
										<div class="mdc-layout-grid__cell--span-4">
											<div class="mdc-card demo-card">
												<div class="mdc-card__primary-action demo-card__primary-action contentCard" tabindex="0">
													<div class="mdc-card__media mdc-card__media--8-3 demo-card__media userProfilePic" style="margin-left: 10px">
														(<?php echo $counter; ?>) <?php echo $uFirstName . " " . $uLastName ?><br><br>									
													</div>
													<div class="demo-card__secondary mdc-typography mdc-typography--body2" style="margin-left: 10px">
														<span style="font-weight: bolder;">Name: </span><?php echo $pName ;?>
													</div>
												</div>
												<div class="mdc-card__actions" pull="right">
													<?php
													echo "<a href='viewDetailsPlaylist.php?playlistDetail=$pId' style='text-decoration: none'><button class='mdc-button mdc-card__action mdc-card__action--button' style='background-color: #fb535b;color:white;margin-right:5px;'>Play <?php ?></button></a>";

													
													if($upId == $_SESSION['uId']){
														echo "<a href='editPlaylist.php?editPlaylist=$pId' style='text-decoration: none'><button class='mdc-button mdc-card__action mdc-card__action--button' style='background-color: black;color:white;margin-right:5px'>Edit</button></a>";

														echo "<a href='playlist.php?deletePlaylist=$pId' style='text-decoration: none' onClick=\"javascript: return confirm('Are you sure you want to delete?');\"><button class='mdc-button mdc-card__action mdc-card__action--button blockButton ' style='background-color:red!important;color:white'>Delete</button></a>";
													}

													$query = "SELECT * FROM favUnfav WHERE uId=$uId AND pId=$pId";
													$select_song_category= mysqli_query($con,$query);
													$checkrows=mysqli_num_rows($select_song_category);

													if($checkrows == 0){
														echo "<a href='index.php?fav_uId=$uId&fav_pId=$pId' style='margin-left:10px'><i class='material-icons'>
														favorite_border
														</i></a>";
													}else{
														echo "<a href='index.php?unfav_uId=$uId&unfav_pId=$pId' style='margin-left:10px'><i class='material-icons'>
														favorite
														</i></a>";
													}
													?>
												</div>
											</div>
										</div>
										<?php
									}
								}
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