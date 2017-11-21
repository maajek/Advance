<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pagetitle; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>

<body>
	<section>
		<div class="mast">
			<h1>T<span>SSB</span></h1>
			<nav>
				<ul class="clearfix">
					<li><a href="add-category.php" <?php curNav('add-category.php'); ?>>Add Category</a></li>
					<li><a href="view-category.php" <?php curNav('view-category.php'); ?>>View Category</a></li>
					<li><a href="add-products.php" <?php curNav('add-products.php'); ?>>Add Products</a></li>
					<li><a href="view-products.php" <?php curNav('view-products.php'); ?>>View Products</a></li>
					<li><a href="logout.php">logout</a></li>
				</ul>
			</nav>
		</div>
	</section>