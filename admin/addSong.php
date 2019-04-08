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
if(isset($_POST['submit']))
{
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
		$target_path = "songs/".$new_file_name;
		if(move_uploaded_file($_FILES['addSong']['tmp_name'], $target_path)) {
		}
	}

	$extsAllowed = array( 'jpg', 'jpeg', 'png', 'gif' );
	$extUpload = strtolower( substr( strrchr($_FILES['sImage']['name'], '.') ,1) ) ;
	
	if (in_array($extUpload, $extsAllowed) ) { 

		$name1 = "songImages/{$_FILES['sImage']['name']}";
		$result = move_uploaded_file($_FILES['sImage']['tmp_name'], $name1);

		mysqli_query($con,"INSERT INTO songs(uId, sSong, sTitle, sArtist, sImage, sSource, sDescription, sDuration) VALUES ('$uId', '$target_path' ,'$sTitle','$sArtist','$name1','$sSource', '$sDescription','$sDuration')") or die(mysqli_error($con));
		echo "<script>alert('Song added Successfully!')

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
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" type="text/css" href="../user/css/searchBox.css">
	<style type="text/css">
		.mdc-layout-grid{
			padding-left: 0px;
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
						<div class="mdc-layout-grid__cell--span-12" align="center">
							<h1>Add Song</h1>
						</div>
					</div>	
				</div>
				<form method="POST" enctype="multipart/form-data">
					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell--span-12" align="center">
								Add Song: 
								<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">

									<input type="file" name="addSong" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Image" accept="audio/*;capture=microphone">
								</div>
							</div>	
						</div>
					</div>

					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell--span-12" align="center">
								<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
									<input type="text" name="sTitle" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Title">
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
									<input type="text" name="sArtist" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Artist">
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
									<input type="text" name="sDescription" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Description">
									<div class="mdc-notched-outline">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</div>
							</div>

							<div class="mdc-layout-grid__cell--span-12" align="center">
								<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
									<input type="text" name="sSource" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Source">
									<div class="mdc-notched-outline">
										<div class="mdc-notched-outline__leading"></div>
										<div class="mdc-notched-outline__trailing"></div>
									</div>
								</div>
							</div>

							<div class="mdc-layout-grid__cell--span-12" align="center">
								<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
									<input type="text" name="sDuration" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Duration">
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
									<span class="mdc-button__label">Add Song</span>
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