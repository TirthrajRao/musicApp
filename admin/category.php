<?php
session_start();
if($_SESSION['uRole'] == "admin"){
}
else {
	header("location: ../user/login.php");
}
?>

<?php
require "db.php";
error_reporting(-1);
ini_set('display_errors', 'On');
if(isset($_POST['submit'])){
	$cName = $_POST['cName'];
	$cDescription = $_POST['cDescription'];
	
	$extsAllowed = array( 'jpg', 'jpeg', 'png', 'gif' );
	$extUpload = strtolower( substr( strrchr($_FILES['cImage']['name'], '.') ,1) ) ;
	
	if (in_array($extUpload, $extsAllowed) ) { 

		$name = "categoryImages/{$_FILES['cImage']['name']}";
		$result = move_uploaded_file($_FILES['cImage']['tmp_name'], $name);

		mysqli_query($con,"INSERT INTO category(cName, cDescription, cImage) VALUES ('$cName', '$cDescription','$name')") or die(mysqli_error($con));
		echo "<script>alert('Category added Successfully!')

		</script>";
	}
}

if(isset($_GET['deleteCategory'])){
	$the_category_id = $_GET['deleteCategory'];

	$query = "DELETE FROM category WHERE cId = {$the_category_id}";
	$delete_query = mysqli_query($con, $query) or die("Delete Error!" . mysqli_error($con));
	header("Location: category.php");
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
			padding-top: 0;
		}
	</style>
</head>
<body>


	
	<?php include "header.php"; ?>
	
	<div class="mdc-drawer-scrim"></div>
	<div class="mdc-drawer-app-content">
		<?php include "navbar.php";  ?>
		<main class="main-content" id="main-content">
			<div class="mdc-top-app-bar--fixed-adjust">
				<div class="mdc-layout-grid">
					<div class="mdc-layout-grid__inner">
						<div class="mdc-layout-grid__cell--span-12">
							<button class="mdc-button mdc-button--raised" onCLick="dialog.open()"  style="margin-top: 30px; background-color: black">
								<span class="mdc-button__label">Add Category</span>
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
			<div class="mdc-layout-grid">
				<div class="mdc-layout-grid__inner">
					<div class="mdc-layout-grid__cell--span-12">
						<h2>All Categories</h2>
					</div>
				</div>
			</div>
			<div class="mdc-layout-grid">
				<div class="mdc-layout-grid__inner">
					<?php
					$p =9;
					$coun=mysqli_query($con,"select count(*) as cou from category");
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


					$query = "SELECT * FROM category LIMIT $k,$p";
					$select_categories= mysqli_query($con,$query);
					while($row = mysqli_fetch_assoc($select_categories)){
						$cId = $row['cId'];
						$cName = $row['cName'];
						$cDescription = $row['cDescription'];
						$cImage = $row['cImage'];	
						?>

						<div class="mdc-layout-grid__cell--span-4">
							<div class="mdc-card demo-card">
								<div class="mdc-card__primary-action demo-card__primary-action contentCard" tabindex="0">
									<div class="mdc-card__media mdc-card__media--8-3 demo-card__media userProfilePic">
										<?php
										echo "<a href='category.php?deleteCategory=$cId' onClick=\"javascript: return confirm('Are you sure you want to delete?');\"><button class='mdc-button mdc-card__action mdc-card__action--button blockButton ' style='background-color:red!important;'>Delete</button></a>";
										?>
										<img src="<?php echo $cImage; ?>" width="150px" height="150px" style="border-radius: 50%">
									</div>
									<div class="demo-card__primary">
										<h2 class="demo-card__title mdc-typography mdc-typography--headline6">
											<?php echo $cName ;?>

										</h2>
									</div>
									<div class="demo-card__secondary mdc-typography mdc-typography--body2">
										<span style="font-weight: bolder;">Description:</span> <?php echo $cDescription; ?>
									</div>
								</div>
								<div class="mdc-card__actions" pull="right">
									<?php
									echo "<a href='viewDetailsCategory.php?categoryDetail=$cId'><button class='mdc-button mdc-card__action mdc-card__action--button' style='background-color: #fb535b;color:white;margin-right:5px;'>View Details</button></a>";
									?>
									<?php
									echo "<a href='editCategory.php?editCategory=$cId' style='text-decoration: none'><button class='mdc-button mdc-card__action mdc-card__action--button' style='background-color: black;color:white'>Edit</button></a>";
									?>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<center style="background-color: red;">
				<?php
				for($i=1;$i<=$page;$i++)
				{
					echo '<a href="category.php?k='.$i.'" style="margin-right:5px;color:white">'.$i.'</a>';
				}
				?>
			</center>
		</div>
	</main>
	<script type="text/javascript" src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>

	<script type="text/javascript">
		const dialog = new mdc.dialog.MDCDialog(document.querySelector('.mdc-dialog'));

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