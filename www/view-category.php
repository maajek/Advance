	
<?php
	
	session_start();

	$page_title = "View Category";

	include 'include/functions.php';
	include 'include/dashboard-header.php';
	include 'include/db.php';


?>

	<div class="wrapper">
		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>Category ID</th>
						<th>Category Name</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$data = viewCategory($conn);

					echo $data;

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