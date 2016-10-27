<?php

	session_start();
	require('connection.php');
	if (isset($_GET['page'])) {
		$pages = array('products', 'cart');

		if(in_array($_GET['page'], $pages)) {
			$page = $_GET['page'];
		}
		else {
			$page = 'products';
		}
	}
	else {
		$page = 'products';
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
  
<html xmlns="http://www.w3.org/1999/xhtml"> 
	<head>

	    <meta http-equiv='Content-Type' content="text/html; charset=utf-8" /> 
	    <link rel="stylesheet" href="css/reset.css" /> 
	    <link rel="stylesheet" href="css/style.css" /> 

		<title>The Shop That Has Everything</title>
	
	</head>
	
	<body>

		<div class="container clearfix"><!-- container -->

			<div class="main"><!-- main -->

				<?php require($page.'.php'); ?>

			</div><!-- /main -->

			<div class="sidebar"><!-- sidebar -->

			<h1>Shopping Cart</h1>

			<?php 

			if (isset($_SESSION['cart'])) {

				$ids = '';
				foreach ($_SESSION['cart'] as $id => $value) {
					$ids.=$id.',';
				}
				$ids = substr ($ids, 0, -1);

				$sql = 'SELECT * FROM products WHERE id_integer IN ('.$ids.') ORDER BY name ASC';
				$result = $conn->query($sql); ?>

				<table>
				<tr>
					<th>Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Total price</th>		
				</tr>

				<?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>

					<tr>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $_SESSION['cart'][$row['id_integer']]['quantity']; ?></td>
						<td>$ <?php echo $row['price']; ?></td>
						<td>$ <?php echo $_SESSION['cart'][$row['id_integer']]['quantity'] * $row['price']; ?></td>
					</tr>

		<?php }	?>

				</table>
				<p><a href='?page=cart'>Manage your cart</a></p>

			<?php }
			else {
				echo '<p>Your cart is empty.</p>';
			}

			?>

			</div><!-- /sidebar -->

		</div><!-- /container -->

	</body>
</hmtl>