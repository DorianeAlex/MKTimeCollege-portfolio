<?php 
# starting the session
session_start() ;

include ('includes/nav.php');

# getting the product id from the URL
if ( isset( $_GET['id'] ) ) $id = $_GET['id'];

# open database connection
require ('connect_db.php');

# querying product information from the database
$q = "SELECT * FROM products WHERE item_id = $id";
$r = mysqli_query( $link, $q );

# handling query result
// product details are fetched and stored in $row
if ( mysqli_num_rows( $r ) == 1 ) 
{
    $row = mysqli_fetch_array( $r, MYSQLI_ASSOC );

# managing the cart
# Check if cart already contains one of this product id.
if ( isset( $_SESSION['cart'][$id] ) )
{ 
  # Add one more of this product if already in the cart and increment the quantity
  $_SESSION['cart'][$id]['quantity']++; 
  echo '
  <div class="container">
          <div class="alert alert-secondary" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <p>Another '.$row["item_name"].' has been added to your cart</p>
              <a href="dashboard.php">Continue Shopping</a> | <a href="cart.php">View Your Cart</a>
          </div>
      </div>';
} 
else
{
  # Or add one of this product to the cart with a quantity of one and the price from the database
  $_SESSION['cart'][$id]= array ( 'quantity' => 1, 'price' => $row['item_price'] ) ;
  echo '<div class="container">
          <div class="alert alert-secondary" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <p>Your '.$row["item_name"].' has been added to your cart</p>
          <a href="dashboard.php">Continue Shopping</a> | <a href="cart.php">View Your Cart</a>
          </div>
      </div>' ;
}
}


# close the database connection
mysqli_close( $link) ; 


?>