<?php
session_start();
error_reporting(-1);
ini_set('display_errors', 'On');
if($_SESSION['uRole'] == "admin"){
}else{
	header("location: ../user/login.php");
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
	echo "<script>window.location.href = 'allPlaylist.php';
	</script>";
}

if(isset($_GET['unfav_uId']) &&  isset($_GET['unfav_pId'])){
	$unfav_uId =  $_GET['unfav_uId'];
	$unfav_pId =  $_GET['unfav_pId'];

	$query = "DELETE FROM favUnfav WHERE uId = {$unfav_uId} AND pId = {$unfav_pId}";
	$delete_query = mysqli_query($con, $query) or die("Delete Error!" . mysqli_error($con));
	echo "<script>alert('Successfully removed from favourite!')
	</script>";
	echo "<script>window.location.href = 'allPlaylist.php';
	</script>";
}

if(isset($_POST['submit'])){
	$pName = $_POST['pName'];
	$pDescription = $_POST['pDescription'];
	$uId = $_SESSION['uId'];
	

	mysqli_query($con,"INSERT INTO playlist(uId, pName, pDescription) VALUES ('$uId', '$pName','$pDescription')") or die(mysqli_error($con));
	echo "<script>Swal.fire('Hello world!')</script>";
	echo "<script>alert('Playlist created Successfully!')
	</script>";
	echo "<script>window.location.href = 'allPlaylist.php';
	</script>";
}
if(isset($_GET['deletePlaylist'])){
	$the_playlist_id = $_GET['deletePlaylist'];

	$query1 = "DELETE FROM favUnfav WHERE pId = {$the_playlist_id}";
	$delete_query1 = mysqli_query($con, $query1) or die("Delete Error!" . mysqli_error($con));

	$query1 = "DELETE FROM playlistSong WHERE pId = {$the_playlist_id}";
	$delete_query1 = mysqli_query($con, $query1) or die("Delete Error!" . mysqli_error($con));

	$query2 = "DELETE FROM playlist WHERE pId = {$the_playlist_id}";
	$delete_query2 = mysqli_query($con, $query2) or die("Delete Error!" . mysqli_error($con));
	header("Location: allPlaylist.php");

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
		<main class="main-content" id="main-content" style="margin-top: 50px;">
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

			<h1>My Playlist</h1>
			<?php
			$the_user_id =$_SESSION['uId'];
			$p1 =9;
			$coun=mysqli_query($con,"select count(*) as cou from playlist");
			$coun_row=mysqli_fetch_array($coun);
			$tot=$coun_row['cou'];
	//echo $tot;
			$page=ceil($tot/$p1);	
	//echo $page;


			if(isset($_GET['k1']))
			{
				$page_coun=$_GET['k1'];
			}
			else
			{
				$page_coun=1;
			}

			$k1=($page_coun-1)*$p1;

			$query = "SELECT * FROM playlist WHERE uId=$the_user_id LIMIT $k1,$p1";
			$select_playlist= mysqli_query($con,$query);
			$totalPlaylist = mysqli_num_rows($select_playlist);
			if($totalPlaylist == 0){
				echo "<h3>No Playlist!</h3>";
			}else{
				?>
				<div class="mdc-layout-grid">
					<div class="mdc-layout-grid__inner">
						<?php


						while($row = mysqli_fetch_assoc($select_playlist)){
							$pId = $row['pId'];
							$uId = $row['uId'];
							$pName = $row['pName'];
							$pDescription = $row['pDescription'];

							$query1 = "SELECT * FROM users WHERE uId = $uId";
							$select_user= mysqli_query($con,$query1);
							while($row1 = mysqli_fetch_assoc($select_user)){
								$uFirstName = $row1['uFirstName'];
								$uLastName = $row1['uLastName'];

								?>

								<div class="mdc-layout-grid__cell--span-4">
									<div class="mdc-card demo-card">
										<div class="mdc-card__primary-action demo-card__primary-action contentCard" tabindex="0">
											<div class="mdc-card__media mdc-card__media--8-3 demo-card__media userProfilePic" style="margin-left: 10px">
												<?php echo $uFirstName . " " . $uLastName ?><br><br>									
											</div>
											<div class="demo-card__secondary mdc-typography mdc-typography--body2" style="margin-left: 10px">
												<span style="font-weight: bolder;">Name: </span><?php echo $pName ;?>
											</div>
										</div>
										<div class="mdc-card__actions" pull="right">
											<?php
											echo "<a href='viewDetailPlaylist.php?playlistDetail=$pId' style='text-decoration: none'><button class='mdc-button mdc-card__action mdc-card__action--button' style='background-color: #fb535b;color:white;margin-right:5px;'>Play <?php ?></button></a>";

											echo "<a href='allPlaylist.php?deletePlaylist=$pId' onClick=\"javascript: return confirm('Are you sure you want to delete?');\"><button class='mdc-button mdc-card__action mdc-card__action--button blockButton ' style='background-color:red!important;'>Delete</button></a>";

											$query = "SELECT * FROM favUnfav WHERE uId=$uId AND pId=$pId";
											$select_song_category= mysqli_query($con,$query);
											$checkrows=mysqli_num_rows($select_song_category);

											if($checkrows == 0){
												echo "<a href='allPlaylist.php?fav_uId=$uId&fav_pId=$pId' style='margin-left:10px'><i class='material-icons'>
												favorite_border
												</i></a>";
											}else{
												echo "<a href='allPlaylist.php?unfav_uId=$uId&unfav_pId=$pId' style='margin-left:10px'><i class='material-icons'>
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
					?>	
				</div>
			</div>
			<center style="background-color: red;">
				<?php
				for($i=1;$i<=$page;$i++)
				{
					echo '<a href="allPlaylist.php?k='.$i.'" style="margin-right:5px;color:white">'.$i.'</a>';
				}
				?>
			</center>

			<h1>All Playlist</h1>
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

					$query = "SELECT * FROM playlist LIMIT $k,$p";
					$select_playlist= mysqli_query($con,$query);
					while($row = mysqli_fetch_assoc($select_playlist)){
						$pId = $row['pId'];
						$uId = $row['uId'];
						$pName = $row['pName'];
						$pDescription = $row['pDescription'];

						$query1 = "SELECT * FROM users WHERE uId = $uId";
						$select_user= mysqli_query($con,$query1);
						while($row1 = mysqli_fetch_assoc($select_user)){
							$uFirstName = $row1['uFirstName'];
							$uLastName = $row1['uLastName'];

							?>

							<div class="mdc-layout-grid__cell--span-4">
								<div class="mdc-card demo-card">
									<div class="mdc-card__primary-action demo-card__primary-action contentCard" tabindex="0">
										<div class="mdc-card__media mdc-card__media--8-3 demo-card__media userProfilePic" style="margin-left: 10px">
											<?php echo $uFirstName . " " . $uLastName ?><br><br>									
										</div>
										<div class="demo-card__secondary mdc-typography mdc-typography--body2" style="margin-left: 10px">
											<span style="font-weight: bolder;">Name: </span><?php echo $pName ;?>
										</div>
									</div>
									<div class="mdc-card__actions" pull="right">
										<?php
										echo "<a href='viewDetailPlaylist.php?playlistDetail=$pId' style='text-decoration: none'><button class='mdc-button mdc-card__action mdc-card__action--button' style='background-color: #fb535b;color:white;margin-right:5px;'>Play <?php ?></button></a>";

										$query = "SELECT * FROM favUnfav WHERE uId=$uId AND pId=$pId";
										$select_song_category= mysqli_query($con,$query);
										$checkrows=mysqli_num_rows($select_song_category);

										if($checkrows == 0){
											echo "<a href='allPlaylist.php?fav_uId=$uId&fav_pId=$pId' style='margin-left:10px'><i class='material-icons'>
											favorite_border
											</i></a>";
										}else{
											echo "<a href='allPlaylist.php?unfav_uId=$uId&unfav_pId=$pId' style='margin-left:10px'><i class='material-icons'>
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
					?>	
				</div>
			</div>
			<center style="background-color: red;">
				<?php
				for($i=1;$i<=$page;$i++)
				{
					echo '<a href="allPlaylist.php?k='.$i.'" style="margin-right:5px;color:white">'.$i.'</a>';
				}
				?>
			</center>




			<!-- modal category ************** -->

			<div class="mdc-dialog"
			role="alertdialog"
			aria-modal="true"
			aria-labelledby="my-dialog-title"
			aria-describedby="my-dialog-content">
			<div class="mdc-dialog__container">
				<form method="POST" enctype="multipart/form-data">
					<div class="mdc-dialog__surface">
						<h2 class="mdc-dialog__title" id="my-dialog-title">Add Category
						</h2>
						<div class="mdc-dialog__content" id="my-dialog-content">
							<div class="mdc-layout-grid">
								<div class="mdc-layout-grid__inner">
									<div class="mdc-layout-grid__cell--span-12">
										<div class="mdc-layout-grid">
											<div class="mdc-layout-grid__inner">
												<div class="mdc-layout-grid__cell--span-12">
													<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
														<input type="text" name="cName" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Category Name">
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
														<input type="text" name="cDescription" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Category Description">
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
										<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
											<div class="mdc-layout-grid">
												<div class="mdc-layout-grid__inner">
													<div class="mdc-layout-grid__cell--span-4" style="margin-top: 10px;">
														Add Image: 
													</div>
													<div class="mdc-layout-grid__cell--span-8">
														<input type="file" name="cImage" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Image" accept="image/*;capture=camera" style="padding-left: 0">
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
		<!-- modal category end ************** -->
	</div>

</main>
</div>

<script type="text/javascript" src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>

<script type="text/javascript">
	const dialog = new mdc.dialog.MDCDialog(document.querySelector('.mdc-dialog'));

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