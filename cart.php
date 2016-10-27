<?php

if (isset($_POST['submit'])) {

	foreach ($_POST['quantity'] as $key => $value) {
		if ($value === 0) {
			unset ($_SESSION['cart'][$key]);
		}
		else {
			$_SESSION['cart'][$key]['quantity'] = $value;
		}
	}
}

?>

<h1>Your shopping cart</h1>

<?php 

	if (isset($_SESSION['cart'])) { ?>

		<form method='post' action='?page=cart'>
		<table> 
        <tr> 
            <th>Name</th> 
            <th>Quantity</th> 
            <th>Price</th> 
            <th>Total price</th> 
        </tr> 

        <?php

		$ids = '';
		foreach ($_SESSION['cart'] as $id => $value) {
			$ids .= $id.',';
		}
		$ids = substr ($ids, 0, -1);

		$sql = 'SELECT * FROM products WHERE id_integer IN ('.$ids.') ORDER BY name ASC';
		$result = $conn->query($sql);

			if(!$result) {
				echo 'dupa';
			}

		$totalPrice = 0;
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
			$quantityId = $_SESSION['cart'][$row['id_integer']]['quantity']; ?>

			<tr>
			<td><?php echo $row['name']; ?></td>
			<td><input type='text' name='quantity[<?php echo $row['id_integer'] ?>]' value='<?php echo $quantityId; ?>' /></td>
			<td>$ <?php echo $row['price']; ?></td>
			<td>$ <?php echo $row['price'] * $quantityId ?></td>
			</tr>

			<?php
			$totalPrice += $row['price'] * $quantityId;
		}

		?>
		<tr>
			<td colspan="4">Total price of your order: $ <?php echo $totalPrice; ?></td>
		</tr>

        </table>
        <p>To remove an item, set quantity to 0 and hit 'Update cart'.</p>
        <button type='submit' name='submit'>Update cart</button>
        </form>

	<?php }
	else
	{
		echo '<p>Your cart is empty.</p>';
	}

?>

<p><a href='?=products'>Back to list of products</a></p>