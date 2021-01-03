<?php
include_once ('header.php');
include_once ('connect.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>RAEST Web App</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>

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

<!-- Container for nav buttons -->
<div class="container" align="center">
	<a href="inventory_items.php" class="button">Items</a>
	<a href="inventory_transactions.php" class="button">Transactions</a>
</div>

<!-- Container for items tables -->
<div class="container">
	<br>
	<div class="row">
		<!-- Create table first user (user_id = 1) -->
		<div class="col">
			<table>
				<h3 align="center">Jógvan</h3>
				<th>Item</th>
				<th width="20%">Amount</th>

				<?php

				// SQL Statement + Query
				$sql = "SELECT DISTINCT item_type FROM transactions WHERE user_id = 1";
				$result = $conn->query($sql);
				
				// Check if table is not empty
				if ($result->num_rows > 0) {
					
					// Output data of each row
					while($row = $result->fetch_assoc()) {
						
						// Initialize variable with first distinct 'item_type'
						$item_type = $row['item_type'];

						// Count rows for transaction_type 'Deposit' and 'Withdraw'
						$rowCountDeposit = mysqli_num_rows($conn->query("SELECT * FROM transactions WHERE user_id = 1 AND (trans_type = 'deposit' OR trans_type = 'Deposit') AND item_type = '$item_type'"));
						$rowCountWithdraw = mysqli_num_rows($conn->query("SELECT * FROM transactions WHERE user_id = 1 AND (trans_type = 'withdraw' OR trans_type = 'Withdraw') AND item_type = '$item_type'"));

						// Print item_type and amount into table
						echo "<tr>";
						echo "<td>", $item_type, "</td>";
						echo "<td>", $rowCountDeposit - $rowCountWithdraw, "</td>";
						echo "</tr>";
						}
				}
				else {
					// Print "0 results"
					echo "<tr><td align='center' colspan='2'>0 results</td></tr>";
				}

				?>
			</table>
		</div>
		
		<!-- Create table second user (user_id = 2) -->
		<div class="col">
			<table>
				<h3 align="center">Sveinur</h3>
				<th>Item</th>
				<th width="20%">Amount</th>

				<?php
				
				// SQL Statement + Query
				$sql = "SELECT DISTINCT item_type FROM transactions WHERE user_id = 2";
				$result = $conn->query($sql);
				
				// Check if table is not empty
				if ($result->num_rows > 0) {
					
					// Output data of each row
					while($row = $result->fetch_assoc()) {

						// Initialize variable with first distinct 'item_type'
						$item_type = $row['item_type'];

						// Count rows for transaction_type 'Deposit' and 'Withdraw'
						$rowCountDeposit = mysqli_num_rows($conn->query("SELECT * FROM transactions WHERE user_id = 2 AND (trans_type = 'deposit' OR trans_type = 'Deposit') AND item_type = '$item_type'"));
						$rowCountWithdraw = mysqli_num_rows($conn->query("SELECT * FROM transactions WHERE user_id = 2 AND (trans_type = 'withdraw' OR trans_type = 'Withdraw') AND item_type = '$item_type'"));

						// Print item_type and amount into table
						echo "<tr>";
						echo "<td>", $item_type, "</td>";
						echo "<td>", $rowCountDeposit - $rowCountWithdraw, "</td>";
						echo "</tr>";
					}
				}
				
				else {
					// Print "0 results"
					echo "<tr><td align='center' colspan='2'>0 results</td></tr>";
				}

				$conn->close();
				?>
			</table>
		</div>		
	</div>
</div>
</body>
</html>
