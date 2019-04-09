<?php
session_start();
if($_SESSION['uRole'] == "user"){
}
else {
	header("location: login.php");
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
</style>
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
						<div class="mdc-layout-grid__cell--span-4"></div>
						<?php
						include "db.php";
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

								?>

								<div class="mdc-layout-grid__cell--span-4">
									<div class="mdc-card demo-card" >
										<div class="mdc-card__primary-action demo-card__primary-action contentCard" tabindex="0">
											<div class="mdc-card__media mdc-card__media--8-3 demo-card__media userProfilePic">
												
												<img src="../admin/<?php echo $sImage; ?>" width="150px" height="150px">
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