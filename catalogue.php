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
                        <a href="./alphaStar.php?" type="button" class="btn btn-sm btn-outline-secondary">View</a>
                        <a href="cart.php" type="button" class="btn btn-sm btn-outline-secondary">Add to basket</a>
                    </div>
                </div>
            </div>            
        </div>';
}

    # Close the row and container divs.
    echo '</div>';  # Close row
    echo '</div>';  # Close container
    echo '</div>';  # Close album

//else {
//     # If no items are found, display a message.
//     echo '<p>There are currently no items in the table to display.</p>';
// }
 
# Close database connection.
	mysqli_close( $link) ; 

include ('includes/footer.php');	
?>