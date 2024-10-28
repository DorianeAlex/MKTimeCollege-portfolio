<?php 
# starting the session
session_start() ;

include ('includes/nav.php');

# check for order conditions
if ( isset( $_GET['total'] ) && ( $_GET['total'] > 0 ) && (!empty($_SESSION['cart']) ) ){

    # open database connection
    require ('connect_db.php');

    # store order in database
    $q = "INSERT INTO orders ( user_id, total, order_date ) VALUES (". $_SESSION['user_id'].",".$_GET['total'].", NOW() ) ";
    $r = mysqli_query ($link, $q);

    #retrieve order id
    $order_id = mysqli_insert_id($link) ;

    #retrieve cart items
    $q = "SELECT * FROM products WHERE item_id IN (";
    foreach ($_SESSION['cart'] as $id => $value) { $q .= $id . ','; }
    $q = substr( $q, 0, -1 ) . ') ORDER BY item_id ASC';
    $r = mysqli_query ($link, $q);

    # store order content
    #loop iterates over each product retrieved from the database and inserts each item into the order_contents table
    while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
{
  $query = "INSERT INTO order_contents ( order_id, item_id, quantity, price )
  VALUES ( $order_id, 
         ".$row['item_id'].",
         ".$_SESSION['cart'][$row['item_id']]['quantity'].",
         ".$_SESSION['cart'][$row['item_id']]['price'].")" ;
    $result = mysqli_query($link,$query);
}

    # close database link
    mysqli_close($link);

    # display order confirmation
    echo "<div class=\"container\">
			<div class=\"alert alert-secondary\" role=\"alert\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
				</button>
				<p>Thanks for your order. Your Order Number Is #".$order_id."</p>
			</div>
		</div>";

    # clear cart
    # clears the shopping cart session after the order has been processed.
    $_SESSION['cart'] = NULL ;

    # message cart is empty
} else { echo ' 
    <div class="container p-5 text-center">
    <h2 class="fw-bold">Your cart is empty</h2>  
    </div>' ;
}


include ('includes/footer.php');
?>

