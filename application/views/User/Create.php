<!DOCTYPE html>
<html lang="en">

<head>
	<title>Test PT.Teravin Technovations</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>

	<div class="jumbotron text-center">
		<h1>Test PT.Teravin Technovations</h1>
	</div>

	<div class="container">
		<h3>Create User</h3>
		<?php
		if (isset($status['statusCode'])) {
			if (@$status['statusCode'] == 00) {
				echo '<div class="alert alert-success alert-dismissible">';
				echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
				echo '<center><strong>' . @$status['message'] . '</strong>.</center>';
				echo '</div>';
			} else {
				echo '<div class="alert alert-danger alert-dismissible">';
				echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
				echo '<center><strong>' . $status['message'] . '</strong>.</center>';
				echo '</div>';
			}
		} ?>
		<form class="form-horizontal" method="POST" action="<?= site_url('User/Create') ?>">
			<div class="row">
				<div class=" form-group">
					<label class="control-label col-sm-2">Nama</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="fullname" value="<?= @$user['fullname'] ?>" maxlength="50" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">No. Hp</label>
					<div class="col-sm-10">
						<input type="text" pattern="\d*" value="<?= @$user['phone_number'] ?>" minlength="10" maxlength="12" class="form-control" name="phone_number" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">Email</label>
					<div class="col-sm-10">
						<input type="email" value="<?= @$user['email'] ?>" class="form-control" maxlength="50" name="email" required>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Alamat</label>
					<div class="col-sm-10">
						<input type="address" value="<?= @$user['address'] ?>" class="form-control" maxlength="50" name="address[]" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2"></label>
					<div class="col-sm-10">
						<div class="input_fields_wrap"></div>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2"></label>
					<div class="col-sm-8"></div>
					<div class="col-sm-2">
						<button class="add_field_button btn btn-default">Tambah Alamat</button>
					</div>
				</div>
				<!-- ALAMAT END -->
				<div class="form-group">
					<label class="control-label col-sm-2"></label>
					<div class="col-sm-10">
						<button type="submit" class="btn btn-default">Create</button>
						<a href="<?= site_url('User/Index') ?>" class="btn btn-default">Back</a>
					</div>
				</div>
			</div>
		</form>
	</div>

</body>

</html>

<script>
	$(document).ready(function() {
		var max_fields = 5; //maximum input boxes allowed
		var wrapper = $(".input_fields_wrap"); //Fields wrapper
		var add_button = $(".add_field_button"); //Add button ID

		var x = 1; //initlal text box count
		$(add_button).click(function(e) { //on add input button click
			e.preventDefault();
			if (x < max_fields) { //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div class="form-control input-group"><input type="address" required value="<?= @$user['address'] ?>" class="form-control" placeholder="Alamat" maxlength="50" name="address[]" required><a href="#" class="btn btn-default remove_field">X</a></div></div>'); //add input box
			}
		});

		$(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
			e.preventDefault();
			$(this).parent('div').remove();
			$(this).parent('div').remove();
			x--;
		})
	});
</script>