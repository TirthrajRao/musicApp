<?php
session_start();
error_reporting(-1);
ini_set('display_errors', 'On');
if($_SESSION['uRole'] == "admin"){
}else{
	header("location: ../user/login.php");
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
	<link rel="stylesheet" href="./css/table.css">
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
				<table>
					<caption>Recently Signed Up Users (<a href="allUsers.php" style="color: red;">View All</a>)</caption>
					<thead>
						<tr>
							<th scope="col">Profile Photo</th>
							<th scope="col">Name</th>
							<th scope="col">Display Name</th>
							<th scope="col">Email</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include "db.php";
						$query = "SELECT * FROM users ORDER BY uId DESC LIMIT 5";
						$select_users= mysqli_query($con,$query);
						while($row = mysqli_fetch_assoc($select_users)){
							$uId = $row['uId'];
							$uFirstName = $row['uFirstName'];
							$uLastName = $row['uLastName'];
							$uEmail = $row['uEmail'];
							$uProfilePic = $row['uProfilePic'];
							?>
							<tr>
								<td data-label="Account"><img src="../user/<?php echo $uProfilePic; ?>" height="50" width="50" style="border-radius:50%"></td>
								<td data-label="Due Date"><?php echo $uFirstName; ?></td>
								<td data-label="Amount"><?php echo $uFirstName; ?></td>
								<td data-label="Period"><?php echo $uFirstName; ?></td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>


				<table>
					<caption>Recently Uploaded Songs (<a href="allSongs.php" style="color: red;">View All</a>)</caption>
					<thead>
						<tr>
							<th scope="col">Song Image</th>
							<th scope="col">Title</th>
							<th scope="col">Song</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT * FROM songs ORDER BY sId DESC LIMIT 5";
						$select_songs= mysqli_query($con,$query);
						while($row = mysqli_fetch_assoc($select_songs)){
							$sId = $row['sId'];
							$sTitle = $row['sTitle'];
							$sImage = $row['sImage'];
							$sArtist = $row['sArtist'];
							$sSong = $row['sSong'];
							?>
							<tr>
								<td data-label="Account"><img src="<?php echo $sImage; ?>" height="50" width="50" style="border-radius:50%"></td>
								<td data-label="Due Date"><?php echo $sTitle; ?></td>
								<td data-label="Period"><audio controls style="padding-right: 5px;width: 250px">
									<source id="audioSTARTMP3" src="<?php echo $sSong; ?>" type="audio/mpeg">
									</audio>
								</td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>

				<table>
					<caption>Recently Created Playlist (<a href="allPlaylist.php" style="color: red;">View All</a>)</caption>
					<thead>
						<tr>
							<th scope="col">Playlist Name</th>
							<th scope="col">Creator</th>
							<th scope="col">Playlist Description</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT * FROM playlist ORDER BY pId DESC LIMIT 5";
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
								<tr>
									<td data-label="Account"><?php echo $pName; ?></td>
									<td data-label="Due Date"><?php echo $uFirstName . " " .  $uLastName;?></td>
									<td data-label="Period"><?php echo $pDescription; ?></td>
								</tr>
								<?php
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</main>
	</div>

	<script type="text/javascript" src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>

	<script type="text/javascript">

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