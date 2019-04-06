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

	<style type="text/css">
		input[type="search"] {
			box-sizing: border-box;
		}
		.container {
			width: 400px;
			margin: 50px auto;
		}

		.Search {
			position: relative;
			display: flex;
			font-weight: 300;
			font-size: 40px;
			color: #555;
		}

		.Search-box {
			flex: 1 0 auto;
			margin: 0 12px;
			padding: 8px 20px;
			height: 35px;
			border: 0;
			box-shadow: 0 3px 12px -1px rgba(0, 0, 0, .3);
		}

		.Search-label {
			position: absolute;
			top: 14px;
			right: 30px;
			font-size: 40px;
			transition: all .15s ease-in-out;
		}

	</style>
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
				<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end">
					<div class="container">
						<form action="search.php" method="GET" class="Search">
							<input class="Search-box" type="search" name="query" id="Search-box" autocomplete="off">
							<label class="Search-label" for="Search-box"><i class="fa fa-search"></i></label>
							<button type="submit" name="submit" class="mdc-button mdc-button--raised">
								<span class="mdc-button__label">Search</span>
							</button>
						</form>
					</div>
				</section>
			</div>
		</header>
		<main class="main-content" id="main-content">
			<div class="mdc-top-app-bar--fixed-adjust">

				<div class="mdc-layout-grid">
					<div class="mdc-layout-grid__inner">
						<div class="mdc-layout-grid__cell--span-4">
							<h2>Songs</h2>	
						</div>
					</div>
				</div>
				<div class="mdc-layout-grid">
					<div class="mdc-layout-grid__inner">
						<?php
						$p = 3;
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
						$query = "SELECT * FROM songs LIMIT $k,$p";
						$select_songs= mysqli_query($con,$query);
						$rowcount=mysqli_num_rows($select_songs);
						if ($rowcount != 0) {
							while($row = mysqli_fetch_assoc($select_songs)){
								$sId = $row['sId'];
								$uSId = $row['uId'];
								$sSong = $row['sSong'];
								$sTitle = $row['sTitle'];
								$sArtist = $row['sArtist'];
								$sImage = $row['sImage'];
								$sSource = $row['sSource'];
								$sDescription = $row['sDescription'];
								$sDuration = $row['sDuration'];

								$query1 = "SELECT * FROM users WHERE uId = '$uId'";
								$select_user= mysqli_query($con,$query1);
								$rowcount1=mysqli_num_rows($select_user);
								if ($rowcount1 != 0) {
									while($row1 = mysqli_fetch_assoc($select_user)){
										$uId = $row['uId'];
										$uFirstName = $row1['uFirstName'];
										$uLastName = $row1['uLastName'];

										?>

										<div class="mdc-layout-grid__cell--span-4">
											<div class="mdc-card demo-card">
												<div class="mdc-card__primary-action demo-card__primary-action contentCard" tabindex="0">
													<div class="mdc-card__media mdc-card__media--8-3 demo-card__media userProfilePic">

														<?php
														echo "<a href='addSongToPlaylist.php?addToPlaylist=$sId'><button class='mdc-button mdc-card__action mdc-card__action--button blockButton ' style='background-color:black!important;font-size:10px'>Add to playlist</button></a>";
														?>
														<img src="../admin/<?php echo $sImage; ?>" width="150px" height="150px">
													</div>
													<div class="demo-card__primary">
														<h2 class="demo-card__title mdc-typography mdc-typography--headline6"><?php echo $sTitle . " " . "by " . $sArtist ;?></h2>
														Uploaded by: <?php echo $uFirstName . " " . $uLastName ?>
														<h3 class="demo-card__subtitle mdc-typography mdc-typography--subtitle2">Source:  <?php echo $sSource; ?></h3>
														<?php 
														$query = "SELECT * FROM playlistSong WHERE sId = $sId";
														$select_song_category= mysqli_query($con,$query);
														$checkrows=mysqli_num_rows($select_song_category);

														if($checkrows == 0){
															?>

															<h3 class="demo-card__subtitle mdc-typography mdc-typography--subtitle2"><span id="spanHeading">Playlist:</span> None</h3>
															<?php
														}else{
															while($row = mysqli_fetch_assoc($select_song_category)){
																$pId = $row['pId'];

																$query = "SELECT * FROM playlist WHERE pId = $pId";
																$select_song_category_name= mysqli_query($con,$query);
																while($row = mysqli_fetch_assoc($select_song_category_name)){
																	$pName = $row['pName'];
																	?>

																	<h3 class="demo-card__subtitle mdc-typography mdc-typography--subtitle2"><span id="spanHeading">Playlist:</span> <?php echo $pName; ?></h3>
																	<?php
																}
															}
														}
														?>
													</div>
													<div class="demo-card__secondary mdc-typography mdc-typography--body2">
														Description: <?php echo $sDescription; ?>
													</div>
												</div>
												<div class="mdc-card__actions">
													<div class="mdc-card__action-buttons actionBlock">
														<audio src="<?php echo $sSong; ?>"></audio>
														<audio controls style="padding-right: 5px;">
															<source id="audioSTARTMP3" src="../admin/<?php echo $sSong; ?>" type="audio/mpeg">
															</audio>

														</div>
														<?php
														if($uSId == $_SESSION['uId']){

															echo "<a href='editSong.php?editSong=$sId'><button class='mdc-button mdc-card__action mdc-card__action--button blockButton'>Edit</button></a>";
														}
														?>
													</div>
												</div>
											</div>
											<?php
										}
									}
								}
							}else{

								?>
								<div class="mdc-layout-grid__cell--span-4">
									<h3 style="color: red">No songs found! Pls upload songs.</h3>
								</div>
								<?php
							}
							?>
						</div>
						<center>
							<?php
							for($i=1;$i<=$page;$i++)
							{
								echo '<a href="viewAllSongs.php?k='.$i.'">'.$i.'</a>';
							}
							?>
						</center>
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