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

if(isset($_POST['submit'])){
	$comment = $_POST['comment'];
	$userId = $_SESSION['uId'];
	echo $userId;
	$the_song_id = $_GET['songId'];

	mysqli_query($con,"INSERT INTO `comments`(`comment`, `sId`,`uId`) VALUES ('$comment','$the_song_id','$userId')") or die(mysqli_error($con));
	echo "<script>alert('Commented Successfully!')
	</script>";
	echo "<script>window.location.href = 'viewSong.php?songId=$the_song_id"; echo "';
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
						<div class="mdc-layout-grid__cell--span-4"></div>
						<?php
						include "getAudioDuration.php";
						if(isset($_GET['songId'])){
							$the_song_id = $_GET['songId'];



							$query = "SELECT * FROM songs WHERE sId = $the_song_id";
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

								$mp3file = new MP3File($sSong);
								$duration1 = $mp3file->getDurationEstimate();
								$duration2 = $mp3file->getDuration();

								?>

								<div class="mdc-layout-grid__cell--span-4">
									<div class="mdc-card demo-card" >
										<div class="mdc-card__primary-action demo-card__primary-action contentCard" tabindex="0">
											<div class="mdc-card__media mdc-card__media--8-3 demo-card__media userProfilePic">
												
												<img src="<?php echo $sImage; ?>" width="150px" height="150px">
											</div>
											<div class="demo-card__primary">
												<h2 class="demo-card__title mdc-typography mdc-typography--headline6"><?php echo $sTitle . " " . "by " . $sArtist ;?></h2>
												<h3 class="demo-card__subtitle mdc-typography mdc-typography--subtitle2"><span id="spanHeading">Source:</span><?php echo $sSource; ?></h3>
												<h3 class="demo-card__subtitle mdc-typography mdc-typography--subtitle2"><span id="spanHeading">Description:</span> <?php echo $sDescription; ?></h3>

												<?php 
												$query = "SELECT * FROM catSongs WHERE sId = $sId";
												$select_song_category= mysqli_query($con,$query);
												$checkrows=mysqli_num_rows($select_song_category);

												if($checkrows == 0){
													?>

													<h3 class="demo-card__subtitle mdc-typography mdc-typography--subtitle2"><span id="spanHeading">Category:</span> None</h3>
													<?php
												}else{
													while($row = mysqli_fetch_assoc($select_song_category)){
														$cId = $row['cId'];

														$query = "SELECT * FROM category WHERE cId = $cId";
														$select_song_category_name= mysqli_query($con,$query);
														while($row = mysqli_fetch_assoc($select_song_category_name)){
															$cName = $row['cName'];
															?>

															<h3 class="demo-card__subtitle mdc-typography mdc-typography--subtitle2"><span id="spanHeading">Category:</span> <?php echo $cName; ?></h3>
															<h3 class="demo-card__subtitle mdc-typography mdc-typography--subtitle2"><span id="spanHeading">Duration:</span> <?php echo MP3File::formatTime($duration2)."\n"; ; ?></h3>
															

															<?php
														}
													}
												}
											}
										}
										?>
									</div>
								</div>
								<div class="mdc-card__actions">
									<div class="mdc-card__action-buttons actionBlock">
										<audio src="<?php echo $sSong; ?>"></audio>
										<audio controls style="padding-right: 5px;">
											<source id="audioSTARTMP3" src="<?php echo $sSong; ?>" type="audio/mpeg">
											</audio>

										</div>
									</div>
									<form method="POST">
										<div class="mdc-layout-grid" align="center">
											<div class="mdc-layout-grid__inner">
												<div class="mdc-layout-grid__cell--span-8">
													<div class="mdc-text-field 	mdc-text-field--outlined mdc-text-field--no-label confirmPassword" style="margin-left: 10px;">
														<input type="text" name="comment" size="100%" class="mdc-text-field__input" aria-label="Label" placeholder="Add Comment">
														<div class="mdc-notched-outline">
															<div class="mdc-notched-outline__leading"></div>
															<div class="mdc-notched-outline__trailing"></div>
														</div>
													</div>
												</div>
												<div class="mdc-layout-grid__cell--span-4">
													<button type="submit" class="mdc-button mdc-button--raised" name="submit" style="margin:8px">
														<span class="mdc-button__label">Add</span>
													</button>
												</div>
											</div>
										</div>
									</form>
									<?php
									$the_song_id = $_GET['songId'];

									$query = "SELECT * FROM comments WHERE sId = $the_song_id";
									$select_comments= mysqli_query($con,$query);
									while($row = mysqli_fetch_assoc($select_comments)){
										$sId = $row['sId'];
										$sId = $row['uId'];
										$comment = $row['comment'];
										$userId = $_SESSION['uId'];

										$query = "SELECT * FROM users WHERE uId = $userId";
										$select_user= mysqli_query($con,$query);
										while($row = mysqli_fetch_assoc($select_user)){
											$uFirstName = $row['uFirstName'];
											$uProfilePic = $row['uProfilePic'];

											?>
											<div class="mdc-layout-grid" style="margin:0 15px; padding-bottom: 0; ">
												<div class="mdc-layout-grid__inner">
													<div class="mdc-layout-grid__cell--span-1">
														<img src="../user/<?php echo $uProfilePic; ?>" width="30px" height="30px" style="border-radius: 50% ">
													</div>
													<div class="mdc-layout-grid__cell--span-3" align="center">
														<p style="color: red; margin-top: 7px;"><?php echo $uFirstName;  ?>:</p>
													</div>

													<div class="mdc-layout-grid__cell--span-8" style="margin-top: 7px">
														<?php echo $comment; ?>
													</div>
												</div>
											</div>
											<?php 
										}
									}
									?>

								</div>
							</div>
							<div class="mdc-layout-grid__cell--span-4"></div>
						</div>
					</div>
				</div>
				<center style="background-color: red;">
				</center>
				<!-- modal category end ************** -->
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