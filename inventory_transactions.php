<!--
	REFERENCES
	https://www.tutorialrepublic.com/codelab.php?topic=bootstrap&file=crud-data-table-for-database-with-modal-form
	https://www.tutorialrepublic.com/php-tutorial/php-mysql-crud-application.php
	https://stackoverflow.com/questions/32172519/how-do-i-pass-the-id-of-a-row-from-my-database-to-a-modal-dialog
	https://www.sourcecodester.com/php/11629/phpmysqli-crud-operation-bootstrapmodal.html
	https://www.plus2net.com/php_tutorial/chart-line-database.php
-->

<?php
include_once ('header.php');
include_once ('connect.php');
?>

<!DOCTYPE html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<html>
<head>
	<title>RAEST Web App</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
	body {
		margin: 0;
		font-family: Arial, Helvetica, sans-serif;
	}

	table, th, td, tr {
		border: 1px solid black;
		text-align: center;
	}
	table {
		width: 100%;
	}
	h2 {
		text-align: center;
	}
	th {
		valign: center;
		font-size: 18px;
	}
</style>
</head>
<body>

<h1 align="center">Inventory</h1>


<div class="container" align="center">
<a href="inventory_items.php" class="button">Items</a>
<a href="inventory_transactions.php" class="button">Transactions</a>
</div>

<div class="container">
	<a href="#create" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i></a>
	<br>
	<br>
	<table>
	<th>User</th>
	<th>Item Type</th>
	<th>Transaction Type</th>
	<th>Date</th>
	<th>Action</th>
	
	<?php
	$sql = "SELECT trans_id, user_name, item_type, trans_type, trans_date FROM transactions JOIN user ON transactions.user_id = user.user_id ORDER BY trans_date DESC";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			?>
			<tr>
			    <td><?php echo $row["user_name"]?></td>
			    <td><?php echo mb_convert_case($row["item_type"], MB_CASE_TITLE)?></td>
			    <td><?php echo mb_convert_case($row["trans_type"], MB_CASE_TITLE)?></td>
			    <td><?php echo $row["trans_date"]?></td>
			    <td>
			        <a href="#update<?php echo $row['trans_id']; ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
			        <a href="#delete<?php echo $row['trans_id']; ?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                    <?php include('actions.php'); ?>
                </td>
			</tr>
			<?php
			}
		}
	else {
		?>
		<tr><td align="center" colspan="5">0 results</td></tr>
		<?php
	}

	?>
</table>
</div>

	<!-- Add Modal HTML -->
	<div id="create" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="create.php">
					<div class="modal-header">						
						<h4 class="modal-title">Add Transaction</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label for="user">User</label>
							  <select id="user" class="form-control" required name="user_id">
							    <option value="1">Jógvan</option>
							    <option value="2">Sveinur</option>
							  </select>
						</div>
						<div class="form-group">
							<label>Item Type</label>
							<input type="text" class="form-control" required name="item_type">
						</div>
						<div class="form-group">
							<label for="type">Transaction Type</label>
							  <select id="type" class="form-control" required name="transaction_type">
							    <option value="Deposit">Deposit</option>
							    <option value="Withdraw">Withdraw</option>
							  </select>
						</div>
						<div class="form-group">
							<label>Datetime</label>
							<input type="datetime-local" class="form-control" required name="transaction_date">
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>
