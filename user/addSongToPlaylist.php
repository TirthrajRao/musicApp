<?php
session_start();
if($_SESSION['uRole'] == "user"	){
}
else {
	header("location: login.php");
}
?>

<?php
include "db.php";
if(isset($_GET['addToPlaylist'])){
	$song_id = $_GET['addToPlaylist'];

	$query = "SELECT * FROM songs WHERE sId = $song_id";
	$select_songs= mysqli_query($con,$query);
	while($row = mysqli_fetch_assoc($select_songs)){
		$sTitle = $row['sTitle'];
	}
}
$query = "SELECT * FROM playlistSong WHERE sId = $song_id";
$select_playlist_songs= mysqli_query($con,$query);
$checkrows=mysqli_num_rows($select_playlist_songs);


if(isset($_POST['submit'])){
	$pId = $_POST['playlist'];
	echo $song_id;
	echo $pId;

	if($checkrows ==0){
		mysqli_query($con,"INSERT INTO playlistSong(sId,pId) VALUES ('$song_id', '$pId')") or die(mysqli_error($con));
		echo "<script>alert('Song added to the Playlist!!')
		</script>";
		echo "<script>window.location.href = 'mySongs.php';
		</script>";
	}else{
		mysqli_query($con,"UPDATE playlistSong SET  pId='$pId' WHERE sId=$song_id") or die(mysqli_error($con));
		echo "<script>alert('Song updated Successfully!')
		</script>";
		echo "<script>window.location.href = 'mySongs.php';
		</script>";
	}
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
	<style type="text/css">
		.mdc-layout-grid{
			padding-left: 0px;
		}

		select {

			/* styling */
			background-color: white;
			border: thin solid blue;
			border-radius: 4px;
			display: inline-block;
			font: inherit;
			line-height: 1.5em;
			padding: 0.5em 3.5em 0.5em 1em;

			/* reset */

			margin: 0;      
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			-webkit-appearance: none;
			-moz-appearance: none;
		}


		/* arrows */

		select.classic {
			background-image:
			linear-gradient(45deg, transparent 50%, blue 50%),
			linear-gradient(135deg, blue 50%, transparent 50%),
			linear-gradient(to right, skyblue, skyblue);
			background-position:
			calc(100% - 20px) calc(1em + 2px),
			calc(100% - 15px) calc(1em + 2px),
			100% 0;
			background-size:
			5px 5px,
			5px 5px,
			2.5em 2.5em;
			background-repeat: no-repeat;
		}

		select.classic:focus {
			background-image:
			linear-gradient(45deg, white 50%, transparent 50%),
			linear-gradient(135deg, transparent 50%, white 50%),
			linear-gradient(to right, gray, gray);
			background-position:
			calc(100% - 15px) 1em,
			calc(100% - 20px) 1em,
			100% 0;
			background-size:
			5px 5px,
			5px 5px,
			2.5em 2.5em;
			background-repeat: no-repeat;
			border-color: grey;
			outline: 0;
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
			</div>
		</header>
		<main class="main-content" id="main-content" align="center">
			<div class="mdc-top-app-bar--fixed-adjust">
				<h1>
					Choose Playlist for <?php echo $sTitle; ?>
				</h1>
				<?php
				$uId = $_SESSION['uId'];
				$query = "SELECT * FROM playlist WHERE uId = $uId";
				$select_playlist= mysqli_query($con,$query);
				$totalPlaylist = mysqli_num_rows($select_playlist);
				
				if ($totalPlaylist == 0) {
					echo 'Pls create new playlist! <br><a href="playlist.php"><button type="submit" name="submit" style="margin-top: 10px;" class="mdc-button mdc-button--raised">
							<span class="mdc-button__label" >Create</span>
						</button></a>';
				}else{	
					?>
					<form method="POST">
						<select class="classic" name="playlist" style="width: 300px;">
							<?php

							while($row = mysqli_fetch_assoc($select_playlist)){
								$pId = $row['pId'];
								$pName = $row['pName'];
								?>

								<option  value="<?php echo $pId; ?>"><?php echo $pName; ?></option>
								<?php 
							}
							?>
						</select><br>
						<button type="submit" name="submit" style="margin-top: 10px;" class="mdc-button mdc-button--raised">
							<span class="mdc-button__label" >Add</span>
						</button>
					</form>
					<?php
				}
				?>
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