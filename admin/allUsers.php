<?php
session_start();
if($_SESSION['uEmail']){
}
else {
	header("location: login.php");
}
?>

<?php
if($_GET["isBlocked"] && $_GET["uId"] ){

	
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
	<link rel="stylesheet" href="./css/table.css">
</head>

<body>
	<aside class="mdc-drawer mdc-drawer--dismissible">
		<div class="mdc-drawer__header">
			<h3 class="mdc-drawer__title">Mail</h3>
			<h6 class="mdc-drawer__subtitle">email@material.io</h6>
		</div>
		<div class="mdc-drawer__content">
			<div class="mdc-list">
				<a class="mdc-list-item mdc-list-item--activated" href="allUsers.php" aria-selected="true">
					<i class="material-icons mdc-list-item__graphic" aria-hidden="true">inbox</i>
					<span class="mdc-list-item__text">View All Users</span>
				</a>
			</div>
		</div>
	</aside>

	<div class="mdc-drawer-app-content">
		<header class="mdc-top-app-bar app-bar" id="app-bar">
			<div class="mdc-top-app-bar__row">
				<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
					<a href="#" class="demo-menu material-icons mdc-top-app-bar__navigation-icon">menu</a>
					<span class="mdc-top-app-bar__title">Admin Panel</span>
				</section>
			</div>
		</header>

		<main class="main-content" id="main-content">
			<div class="mdc-top-app-bar--fixed-adjust">
				<table>
					<caption style="text-align: left;">Registered Users</caption>
					<thead>
						<tr>

							<th>Sr. No.</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Display Name</th>
							<th>Block</th>
							<th>Email</th>
							<th>Profile Photo</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include("db.php");
						$query = "SELECT * FROM users";  
						$result = mysqli_query($con, $query);
						if ($result->num_rows > 0) {
							$counter=1;
							while($row = $result->fetch_assoc()) {
								?>

								<tr>
									<td><?php echo $counter; ?></td>
									<td><?php echo $row["uFirstName"]; ?></td>
									<td><?php echo $row["uLastName"]; ?></td>
									<td><?php echo $row["uDisplayName"]; ?></td>
									<td><a href="allUsers.php?isBlocked=<?php echo $row["isBlocked"];?>&amp;uId=<?php echo $row["uId"];?>"><?php echo $row["isBlocked"]; ?></a></td>

									
									<td><?php echo $row["uEmail"]; ?></td>
									<td><?php echo $row["uProfilePic"]; ?></td>
								</tr>
								<?php
								$counter++;
							}
						} else {
							echo "0 results";
						}
						?>
					</tbody>
				</table>
			</div>
		</main>
	</div>
	<script type="text/javascript" src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>

	<script type="text/javascript">
		mdc.autoInit();

		var drawer = new mdc.drawer.MDCDrawer(document.querySelector('.mdc-drawer'));
		const topAppBar = mdc.topAppBar.MDCTopAppBar.attachTo(document.getElementById('app-bar'));
		topAppBar.setScrollTarget(document.getElementById('main-content'));
		topAppBar.listen('MDCTopAppBar:nav', () => {
			drawer.open = !drawer.open;
		});
	</script>
</body>
</html>