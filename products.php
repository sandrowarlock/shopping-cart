<?php

$message = '';

	if (isset($_GET['action']) AND $_GET['action'] == 'add') {
		
		$id = intval($_GET['id']);

		if (isset($_SESSION['cart'][$id])) {
			$_SESSION['cart'][$id]['quantity']++;
		}
		else {
			$sql_s = 'SELECT * FROM products WHERE id_integer='.$id;
			$result_s = $conn->query($sql_s);

			if(!$result_s) {
				echo 'dupa';
			}

			if ($result_s->num_rows != 0) {
				$row_s = mysqli_fetch_array($result_s, MYSQLI_ASSOC);
					$_SESSION['cart'][$row_s['id_integer']] = array(
						'quantity' => 1,
						'price' => $row_s['price']
						);
			}
			else {
				$message = 'This product\'s id is invalid';
			}
		}
	}

?>

<h1>Product list</h1>
<?php echo '<h2>'.$message.'</h2>'; ?>
<table>
	<tr>
		<th>Name</th>
		<th>Description</th>
		<th>Price</th>
		<th>Action</th>		
	</tr>
	
	<?php
		
		$sql = 'SELECT * FROM products ORDER BY name ASC';
		$result = $conn->query($sql);

		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td>$ <?php echo $row['price']; ?></td>
			<td><a href="?page=products&action=add&id=<?php echo $row['id_integer'] ?>">Add to card</a></td>
		</tr>
		<?php }	?>

	<tr>

	</tr>
</table>