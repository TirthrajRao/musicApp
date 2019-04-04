<?php
session_start();
error_reporting(-1);
ini_set('display_errors', 'On');
if($_SESSION['uRole'] == "user"){
}
?>

<?php
if(isset($_GET['editSong'])){
	$the_song_id = $_GET['editSong'];
}

include "db.php";
$query = "SELECT * FROM songs WHERE sId=$the_song_id";
$select_songs= mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($select_songs)){
	$sId = $row['sId'];
	$uId = $row['uId'];
	$sSong = $row['sSong'];
	$sTitle = $row['sTitle'];
	$sArtist = $row['sArtist'];
	$sImage = $row['sImage'];
	$sSource = $row['sSource'];
	$sDescription = $row['sDescription'];
	$sDuration = $row['sDuration'];
}


if(isset($_POST['submit'])){


	$songImage = $_FILES['sImage']['name'];
	$sTitle = $_POST['sTitle'];
	$sArtist = $_POST['sArtist'];
	$sDescription = $_POST['sDescription'];
	$sSource = $_POST['sSource'];
	$sDuration = $_POST['sDuration'];
	$uId = $_SESSION['uId'];

	if($_FILES['addSong']['type']=='audio/mpeg' || $_FILES['addSong']['type']=='audio/mpeg3' || $_FILES['addSong']['type']=='audio/x-mpeg3' || $_FILES['addSong']['type']=='audio/mp3' || $_FILES['addSong']['type']=='audio/x-wav' || $_FILES['addSong']['type']=='audio/wav')
	{ 
		$new_file_name=$_FILES['addSong']['name'];
		$target_path = "../admin/songs/".$new_file_name;
		if(move_uploaded_file($_FILES['addSong']['tmp_name'], $target_path)) {
		}
	}else  {
		$_FILES['addSong']['name'] = $sSong;
		$new_file_name=$_FILES['addSong']['name'];
		$target_path = $new_file_name;
		if(move_uploaded_file($_FILES['addSong']['tmp_name'], $target_path)) {
		}
	}

	$extsAllowed = array( 'jpg', 'jpeg', 'png', 'gif');
	$extUpload = strtolower( substr( strrchr($_FILES['sImage']['name'], '.') ,1) ) ;
	
	if (in_array($extUpload, $extsAllowed) ) { 

		$name1 = "../admin/songImages/{$_FILES['sImage']['name']}";
		$result = move_uploaded_file($_FILES['sImage']['tmp_name'], $name1);

		mysqli_query($con,"UPDATE songs SET sSong='$target_path', sTitle='$sTitle', sArtist='$sArtist', sImage='$name1', sSource='$sSource', sDescription='$sDescription', sDuration='$sDuration' WHERE sId='$the_song_id' ") or die(mysqli_error($con));
		echo "<script>alert('Song updated Successfully!')

		</script>";

		header("Location: mySongs.php");
	}else{

		$name1 = "$sImage";
		$result = move_uploaded_file($sImage, $name1);

		mysqli_query($con,"UPDATE songs SET sSong='$target_path', sTitle='$sTitle', sArtist='$sArtist', sImage='$name1', sSource='$sSource', sDescription='$sDescription', sDuration='$sDuration' WHERE sId='$the_song_id' ") or die(mysqli_error($con));
		echo "<script>alert('Song updated Successfully!')

		</script>";

		header("Location: mySongs.php");
	}
	
}

?>

<?php
if(isset($_GET['deleteSong'])){
	$the_song_id = $_GET['deleteSong'];

	$query = "DELETE FROM songs WHERE sId = {$the_song_id}";
	$delete_query = mysqli_query($con, $query) or die("Delete Error!" . mysqli_error($con));
	header("Location: mySongs.php");
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
				<a class="mdc-list-item" href="mySongs.php">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">drafts</i>
					<span class="mdc-list-item__text">My Songs</span>
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
						<div class="mdc-layout-grid__cell--span-12" align="center">
							<h1>Edit Song</h1>
						</div>
					</div>	
				</div>
				<form method="POST" enctype="multipart/form-data">

					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell--span-12" align="center">
								<audio controls style="padding-right: 5px;">
									<source id="audioSTARTMP3" src="../admin/<?php echo $sSong; ?>" type="audio/mpeg">
									</audio><br>
								</div>	
							</div>
						</div>

						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-12" align="center">
									<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
										<label>Choose Song:</label>
										<input type="file" value="<?php echo $sSong; ?>" name="addSong" size="40" class="mdc-text-field__input" aria-label="Label" placeholder="Song Image" accept="audio/*;capture=microphone">
									</div>
								</div>	
							</div>
						</div>



						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-12" align="center">
									<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
										<input type="text" value="<?php echo $sTitle; ?>" name="sTitle" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Title">
										<div class="mdc-notched-outline">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>	
							</div>
						</div>

						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-12" align="center">
									<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
										<input type="text" value="<?php echo $sArtist; ?>" name="sArtist" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Artist">
										<div class="mdc-notched-outline">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>	
							</div>
						</div>

						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-12" align="center">
									<img src="../admin/<?php echo $sImage; ?>" height="100px" width="100px" style="border-radius: 50%">
									Add Image:
									<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
										<input type="file" name="sImage" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Image" accept="image/*;capture=camera">
									</div>
								</div>	
							</div>
						</div>

						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-12" align="center">
									<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
										<input type="text" value="<?php echo $sDescription; ?>" name="sDescription" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Description">
										<div class="mdc-notched-outline">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>

								<div class="mdc-layout-grid__cell--span-12" align="center">
									<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
										<input type="text" value="<?php echo $sSource; ?>" name="sSource" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Source">
										<div class="mdc-notched-outline">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>

								<div class="mdc-layout-grid__cell--span-12" align="center">
									<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
										<input type="text" name="sDuration" value="<?php echo $sDuration; ?>" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Duration">
										<div class="mdc-notched-outline">
											<div class="mdc-notched-outline__leading"></div>
											<div class="mdc-notched-outline__trailing"></div>
										</div>
									</div>
								</div>	
							</div>
						</div>

						<div class="mdc-layout-grid">
							<div class="mdc-layout-grid__inner">
								<div class="mdc-layout-grid__cell--span-12" align="center">
									<button type="submit" class="mdc-button mdc-button--raised" name="submit">
										<span class="mdc-button__label">Edit Song</span>
									</button>
								</div>	
							</div>
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