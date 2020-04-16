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
		<h3>Read User</h3>
		<form class="form-horizontal" method="POST" action="<?= site_url('User/Create') ?>">
			<div class="form-group">
				<label class="control-label col-sm-2">ID</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="ID" value="<?= @$user[0]['id'] ?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Nama</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="fullname" value="<?= @$user[0]['fullname'] ?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">No. Hp</label>
				<div class="col-sm-10">
					<input type="text" pattern="\d*" value="<?= @$user[0]['phone_number'] ?>" class="form-control" name="phone_number" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Email</label>
				<div class="col-sm-10">
					<input type="email" value="<?= @$user[0]['email'] ?>" class="form-control" name="email" readonly>
				</div>
			</div>
			<?php $no = 1;
			foreach ($user_address as $row) {
				echo '<div class="form-group">';
				echo '<label class="control-label col-sm-2">Alamat ' . $no . '</label>';
				echo '<div class="col-sm-10">';
				echo '<input type="text" value="' . $row['address'] . '" class="form-control" readonly maxlength="150jfgss" name="address" required>';
				echo '<a href=""></a></div>';
				echo '</div>';
				$no = $no + 1;
			} ?>

			<div class="form-group">
				<label class="control-label col-sm-2"></label>
				<div class="col-sm-10">
					<a href="<?= site_url('User/Delete?id=') . '' . $user[0]['id'] ?>" class="btn btn-danger">Delete</a>
					<a href="<?= site_url('User/Update?id=') . '' . $user[0]['id'] ?>" class="btn btn-info">Edit</a>
					<a href="<?= site_url('User/Index') ?>" class="btn btn-default">Back</a>
				</div>
			</div>
		</form>
	</div>

</body>

</html>