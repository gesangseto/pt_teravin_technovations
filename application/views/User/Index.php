<!DOCTYPE html>
<html lang="en">

<head>
	<title>Test PT.Teravin Technovations</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="<?= base_url('datatables/datatables/css/jquery.dataTables.min.css') ?>" rel="stylesheet">
	<script src="<?= base_url('datatables/jquery/jquery-2.2.3.min.js') ?>"></script>
	<script src="<?= base_url('datatables/datatables/js/jquery.dataTables.min.js') ?>"></script>
	<!-- SWAL Fire -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

	<div class="jumbotron text-center">
		<h1>Test PT.Teravin Technovations</h1>
	</div>

	<div class="container">
		<h3>List User</h3>
		<div class="row">
			<?php
			if (isset($status['statusCode'])) {
				if (@$status['statusCode'] == 00) {
					echo '<div class="alert alert-success alert-dismissible">';
					echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
					echo '<center><strong>' . @$status['message'] . '</strong>.</center>';
					echo '</div>';
				} else {
					echo '<div class="alert alert-danger alert-dismissible">';
					echo '<center><strong>' . $status['message'] . '</strong>.</center>';
					echo '</div>';
				}
			} else {
			?>
				<div class="col-sm-2">
				</div>
				<div class="col-sm-8">
					<table id="table" class="display table table-hover" cellspacing="0" border="1" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>No. Hp</th>
								<th>Email</th>
								<!-- <th>Alamat</th> -->
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
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
<script type="text/javascript">
	var table;
	$(document).ready(function() {
		table = $('#table').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?= site_url('User/get_user') ?>",
				"type": "POST"
			},
			"columnDefs": [{
				"targets": [0],
				"orderable": false,
			}, ],

		});

	});
</script>
<script>
	function hapus(uid) {
		swal({
				title: "Are you sure delete this user?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					window.location.href = "<?= site_url('User/Delete?id='); ?>" + uid;
				} else {
					swal("User is safe!");
				}
			});
	}
</script>