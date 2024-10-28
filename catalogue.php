<?php

include ('includes/nav.php');

# Open database connection.
	require ( 'connect_db.php' );
	
	# Retrieve items from 'products' database table.
	$q = "SELECT * FROM products" ;
	$r = mysqli_query( $link, $q ) ;
	if ( mysqli_num_rows( $r ) > 0 );

        echo '<div class="album py-5 bg-body-tertiary">';
        echo '<div class="container">';
        echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';

    while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC )) {
        echo '
        <div class="col">
            <div class="card shadow-sm">
	            <img src='. $row['item_img'].' alt="watch" class="bd-placeholder-img card-img-top" width="100%" height="225">
	            <div class="card-body">
	                <h5 class="card-title text-center">' . $row['item_name'] .'</h5>
	                <p class="card-text">'. $row['item_desc'] . '</p>
                </div>    
	            <ul class="list-group list-group-flush">
	                <li class="list-group-item"><p class="text-center">&pound' . $row['item_price'] . '</p></li>
	            </ul>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="added.php?id='.$row['item_id'].'" type="button" class="btn btn-sm btn-outline-secondary">Add to basket</a>
                    </div>
                </div>
            </div>            
        </div>';
}

    # Close the row and container divs.
    echo '</div>';  # Close row
    echo '</div>';  # Close container
    echo '</div>';  # Close album

# Close database connection.
	mysqli_close( $link) ; 

# If no items are found, display a message.
else {   
    echo '<p>There are currently no items in the table to display.</p>';
}

include ('includes/footer.php');	
?>

# Display the product details in a neat layout
        echo '<div class="row mb-4 d-flex justify-content-between align-items-center">';
        
        # Product image placeholder (you can add an actual image if available)
        echo '<div class="col-md-2 col-lg-2 col-xl-2">';
        echo '<img src="path_to_image_placeholder.jpg" class="img-fluid rounded-3" alt="product image">';
        echo '</div>';

        # Product name
        echo '<div class="col-md-3 col-lg-3 col-xl-3">';
        echo '<h4>' . $row['item_name'] . '</h4>';
        echo '</div>';

        # Quantity input
        echo '<div class="col-md-3 col-lg-2 col-xl-2 d-flex">';
        echo '<label for="quantity-' . $row['item_id'] . '">Quantity:</label>';
        echo '<input type="text" 
                   id="quantity-' . $row['item_id'] . '" 
                   size="3" 
                   name="qty[' . $row['item_id'] . ']" 
                   value="' . $_SESSION['cart'][$row['item_id']]['quantity'] . '" 
                   class="form-control form-control-sm">';
        echo '</div>';

        # Price per item
        echo '<div class="col-md-3 col-lg-2 col-xl-2">';
        echo '<p>@ &pound;' . number_format($row['item_price'], 2) . '</p>';
        echo '</div>';

        # Subtotal
        echo '<div class="col-md-3 col-lg-2 col-xl-2">';
        echo '<p>Subtotal: &pound;' . number_format($subtotal, 2) . '</p>';
        echo '</div>';

        echo '</div>'; # End of product row
    }

    echo '</div>'; # End of container

    # Close the database connection
    mysqli_close($link);

    # Display the total and action buttons
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-12">';
    echo '<h4>Total: &pound;' . number_format($total, 2) . '</h4>';
    echo '</div>';
    echo '<div class="col-12">';
    echo '<input type="submit" name="submit" class="btn btn-light btn-block" value="Update My Cart">';
    echo '</div>';
    echo '<div class="col-12 mt-2">';
    echo '<a href="checkout.php?total=' . $total . '" class="btn btn-light btn-block">Checkout Now</a>';
    echo '</div>';
    echo '</div>'; # End of row
    echo '</div>'; # End of container

    echo '</form>';
} else {
    # Display message if the cart is empty
    echo '<div class="container">';
    echo '<p>Your cart is currently empty.</p>';
    echo '</div>';
}