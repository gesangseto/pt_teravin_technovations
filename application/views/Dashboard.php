<!DOCTYPE html>
<html lang="en">

<head>
	<title>Test PT.Teravin Technovations</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

	<div class="jumbotron text-center">
		<h1>Test PT.Teravin Technovations</h1>
	</div>

	<div class="container">
		<div class="row">
			<?php
			if ($status['statusCode'] != 00) {
				echo '<div class="alert alert-danger alert-dismissible">';
				echo '<center><strong>' . $status['message'] . '</strong>.</center>';
				echo '</div>';
			} else {
			?>
				<div class="col-sm-2">
				</div>
				<div class="col-sm-8">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Firstname</th>
								<th>Lastname</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>John</td>
								<td>Doe</td>
								<td>john@example.com</td>
							</tr>
							<tr>
								<td>Mary</td>
								<td>Moe</td>
								<td>mary@example.com</td>
							</tr>
							<tr>
								<td>July</td>
								<td>Dooley</td>
								<td>july@example.com</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-sm-2">
				</div>
			<?php } ?>
		</div>

		<div class="row">

			<div class="col-sm-10">
			</div>
			<div class="col-sm-2">
				<a href="<?= site_url('User/Create') ?>" class="btn btn-info">ADD</a>
			</div>

		</div>
	</div>

</body>

</html>