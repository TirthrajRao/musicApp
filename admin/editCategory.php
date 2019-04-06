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
if(isset($_GET['editCategory'])){
	$the_category_id = $_GET['editCategory'];
}


include "db.php";
$query = "SELECT * FROM category WHERE cId=$the_category_id";
$select_category= mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($select_category)){
	$cName = $row['cName'];
	$cDescription = $row['cDescription'];
	$cImage1= $row['cImage'];
}


if(isset($_POST['submit'])){


	$cImage = $_FILES['cImage']['name'];
	$cName = $_POST['cName'];
	$cDescription = $_POST['cDescription'];

	$extsAllowed = array( 'jpg', 'jpeg', 'png', 'gif');
	$extUpload = strtolower( substr( strrchr($_FILES['cImage']['name'], '.') ,1) ) ;
	
	if (in_array($extUpload, $extsAllowed) ) { 

		$name1 = "categoryImages/{$_FILES['cImage']['name']}";
		$result = move_uploaded_file($_FILES['cImage']['tmp_name'], $name1);

		mysqli_query($con,"UPDATE category SET  cImage='$name1', cName='$cName', cDescription='$cDescription' WHERE cId='$the_category_id' ") or die(mysqli_error($con));
		echo "<script>alert('category updated Successfully!')

		</script>";

		header("Location: category.php");
	}else{

		$name1 = "$cImage1";
		echo $name1;
		$result = move_uploaded_file($cImage, $name1);

		mysqli_query($con,"UPDATE category SET  cImage='$name1', cName='$cName', cDescription='$cDescription' WHERE cId='$the_category_id' ") or die(mysqli_error($con));
		echo "<script>alert('category updated Successfully!')

		</script>";

		header("Location: category.php");
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
	<style type="text/css">
		.mdc-layout-grid{
			padding-left: 0px;
		}
	</style>
</head>

<body>

	<aside class="mdc-drawer mdc-drawer--modal">
		<div class="mdc-drawer__content">
			<nav class="mdc-list">
				<a class="mdc-list-item mdc-list-item--activated" href="dashboard.php" aria-selected="true">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">inbox</i>
					<span class="mdc-list-item__text">Dashboard</span>
				</a>
				<a class="mdc-list-item" href="addSong.php">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">drafts</i>
					<span class="mdc-list-item__text">Add Songs</span>
				</a>
				<a class="mdc-list-item" href="category.php">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">drafts</i>
					<span class="mdc-list-item__text">Category</span>
				</a>
				<a class="mdc-list-item" href="allUsers.php">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">send</i>
					<span class="mdc-list-item__text">All Users</span>
				</a>
				<a class="mdc-list-item" href="allSongs.php">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">drafts</i>
					<span class="mdc-list-item__text">All Songs</span>
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
		<header class="mdc-top-app-bar app-bar" id="app-bar">
			<div class="mdc-top-app-bar__row">
				<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
					<a href="#" class="demo-menu material-icons mdc-top-app-bar__navigation-icon">menu</a>
					<span class="mdc-top-app-bar__title">Signal play</span>
				</section>
			</div>
		</header>
		<main class="main-content" id="main-content" style="margin-top: 50px;">
			<div class="mdc-top-app-bar--fixed-adjust">
				<div class="mdc-layout-grid">
					<div class="mdc-layout-grid__inner">
						<div class="mdc-layout-grid__cell--span-12" align="center">
							<h1>Edit Category</h1>
						</div>
					</div>	
				</div>
				<form method="POST" enctype="multipart/form-data">

					<div class="mdc-layout-grid">
						<div class="mdc-layout-grid__inner">
							<div class="mdc-layout-grid__cell--span-12" align="center">
								<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
									<input type="text" value="<?php echo $cName; ?>" name="cName" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Category Name">
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
									<input type="text" value="<?php echo $cDescription; ?>" name="cDescription" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Category Description">
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
								<img src="<?php echo $cImage1; ?>" height="100px" width="100px" style="border-radius: 50%">
								Add Image:
								<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label email">
									<input type="file" name="cImage" size="30" class="mdc-text-field__input" aria-label="Label" placeholder="Song Image" accept="image/*;capture=camera">
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