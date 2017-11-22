<?php
	session_start();
	$page_title = "Admin Dashboard";
	
	include('include/functions.php');
	include('include/dashboard_header.php');

	include('include/db.php');


	checkLogin();


?>
<div class="wrapper">
		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>Title</th>
						<th>Author</th>
						<th>Price</th>
						<th>Category</th>
						<th>image</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$view = viewProducts($conn);
						echo $view;
					?>
				</tbody>
			</table>
		</div>

		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">2</a>
		</div>
	</div>


<?php

	include('include/footer.php');

?>