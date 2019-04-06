<?php
session_start();
error_reporting(-1);
ini_set('display_errors', 'On');
if($_SESSION['uRole'] == "user"){
}
?>

<?php
if(isset($_GET['editProfile'])){
	$the_user_id = $_GET['editProfile'];
}

include "db.php";
$query = "SELECT * FROM users WHERE uId = '$the_user_id'";
$select_user= mysqli_query($con,$query);
$rowcount=mysqli_num_rows($select_user);
if ($rowcount != 0) {
	while($row = mysqli_fetch_assoc($select_user)){
		$uId = $row['uId'];
		$uFirstName = $row['uFirstName'];
		$uLastName = $row['uLastName'];
		$uDisplayName = $row['uDisplayName'];
		$uEmail = $row['uEmail'];
		$uProfilePic = $row['uProfilePic'];
		$uDateOfReg = $row['uDateOfReg'];
		$isBlocked = $row['isBlocked'];

	}
}


if(isset($_POST['submit'])){
	$uId=$_SESSION['uId'];

	$uProfilePic1 = $_FILES['uProfilePic']['name'];
	$uFirstName = $_POST['uFirstName'];
	$uLastName = $_POST['uLastName'];
	$uDisplayName = $_POST['uDisplayName'];
	$uEmail = $_POST['uEmail'];

	$extsAllowed = array( 'jpg', 'jpeg', 'png', 'gif');
	$extUpload = strtolower( substr( strrchr($_FILES['uProfilePic']['name'], '.') ,1) ) ;

	if (in_array($extUpload, $extsAllowed) ) { 

		$name1 = "{$_FILES['uProfilePic']['name']}";
		$result = move_uploaded_file($_FILES['uProfilePic']['tmp_name'], $name1);

		mysqli_query($con,"UPDATE users SET uProfilePic='$name1', uFirstName='$uFirstName', uLastName='$uLastName', uEmail='$uEmail', uDisplayName='$uDisplayName' WHERE uId='$uid' ") or die(mysqli_error($con));
		echo "<script>alert('Song updated Successfully!')

		</script>";
		header("Location: myProfile.php");
	}else{

		$name1 = "$uProfilePic";
		$result = move_uploaded_file($uProfilePic, $name1);

		mysqli_query($con,"UPDATE users SET uProfilePic='$name1', uFirstName='$uFirstName', uLastName='$uLastName', uEmail='$uEmail', uDisplayName='$uDisplayName' WHERE uId='$uId' ") or die(mysqli_error($con));
		echo "<script>alert('Song updated Successfully!')

		</script>";
		header("Location: myProfile.php");
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
						<div class="mdc-layout-grid__cell--span-12" align="center">
							<h1>Edit Song</h1>
						</div>
					</div>	
				</div>
				<form method="POST" enctype="multipart/form-data">

					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell--span-12" align="center">
								<img src="<?php echo $uProfilePic; ?>" height="100px" width="100px" style="border-radius: 50%">
								Change Profile Pic:
								<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
									<input type="file" name="uProfilePic" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="User Image" accept="image/*;capture=camera">
								</div>
							</div>	
						</div>
					</div>

					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell--span-12" align="center">
								<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
									<input type="text" value="<?php echo $uFirstName; ?>" name="uFirstName" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Title">
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
									<input type="text" value="<?php echo $uLastName; ?>" name="uLastName" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Title">
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
									<input type="text" value="<?php echo $uEmail; ?>" name="uEmail" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Title">
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
									<input type="text" value="<?php echo $uDisplayName; ?>" name="uDisplayName" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Title">
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
								<button type="submit" name="submit" class="mdc-button mdc-dialog__button mdc-dialog__button--default" data-mdc-dialog-action="yes" style="background-color: blue; color: white">
									<span class="mdc-button__label">Update</span>
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