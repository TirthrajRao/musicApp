<?php
session_start();
if($_SESSION['uEmail']){
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
				dashboard.
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