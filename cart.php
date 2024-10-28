<?php 
# starting the session
session_start() ;

include ('includes/nav.php');

# Check if form has been submitted for update.
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
  # Update changed quantity field values.
  foreach ( $_POST['qty'] as $item_id => $item_qty ) 
  {
    # Ensure values are integers.
    $id = (int) $item_id;
    $qty = (int) $item_qty;

    # Change quantity or delete if zero.
    if ( $qty == 0 ) { unset ($_SESSION['cart'][$id]); 
  } elseif ( $qty > 0 ) { $_SESSION['cart'][$id]['quantity'] = $qty;
  }
}
}

# Initialise grand total variable.
$total = 0; 
// check if the cart is not empty
if (!empty($_SESSION['cart'])) {

# connect to the database
require ('connect_db.php');
# building the SQL querie
$q = "SELECT * FROM products WHERE item_id IN (";
foreach ($_SESSION['cart'] as $id => $value) { $q .= $id . ','; 
}
  $q = substr( $q, 0, -1 ) . ') ORDER BY item_id ASC';

# executing the query
$r = mysqli_query($link, $q);

# displaying the cart
# Display body section with a form and a table.
echo '

<div class="container">
<h4 class="fw-bold py-3">Your Cart</h4>
<form action="cart.php" method="post">';
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
{
  # Calculate sub-totals and grand total.
  $subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] * $_SESSION['cart'][$row['item_id']]['price'];
  $total += $subtotal;

  # Display the rows:

echo "
  <div class= row mb-4 d-flex justify-content-between align-items-center\">
        <div class=\"col-md-3 col-lg-3 col-xl-3\">
          <img src=\"{$row['item_img']}\" class=\"img-fluid rounded-3\" alt=\"watch\">
        </div>

        <div class=\"col-md-3 col-lg-3 col-xl-3\">
        <h6 class=\"mb-0 fw-bold text-black text-center\">{$row['item_name']}</h6>
        </div>

        <div class=\"col-md-1 col-lg-1 col-xl-1 d-flex\">
        <input type=\"number\" class=\"form-control text-center\" min=\"1\" size=\"2\"name=\"qty[{$row['item_id']}]\"value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\" style=\"width: 50px; height: 30px; padding: 2px;\"> 
        </div>

        <div class=\"col-md-2 col-lg-2 col-xl-2\">
        <h6 class=\"text-muted mb-0\">@ {$row['item_price']}</h6>
        </div>

        <div class=\"col-md-3 col-lg-2 col-xl-2\">
        <h6 class=\"mb-0 text-black fw-bold\">&pound ".number_format ($subtotal, 2)."</h6> 
        </div>   
  </div>
<hr class=\"my-3\">
";
 
}


# close the database connection
mysqli_close( $link) ; 

# Display the total.
echo '
        <div class="row">
            <div class="col-md-4 offset-md-8 col-lg-3 offset-lg-9 bg-light p-4 rounded">
                <h4 class="fw-bold mb-4">Summary</h4>
                <h5 class="text-uppercase">Total</h5>
                <h3 class="text-primary fw-bold">&pound;' . number_format($total, 2) . '</h3>
                <hr class="my-4">
                <input type="submit" name="submit" class="btn btn-dark btn-block mb-3" value="Update Cart">
                <a href="checkout.php?total='.$total.'" class="btn btn-primary btn-block mb-3">Checkout Now</a>
            </div>
        </div>
    </form>
  </div>';


  } else {
    # Display a message if the cart is empty
    echo '
    <div class="container">
        <h4 class="text-center mt-5">Your cart is currently empty.</h4>
    </div>';
}


// include ('includes/footer.php');
?>