<?php

# starting the session
session_start() ;

# include navigation menu
include ('includes/nav.php'); 

# Check if user is logged in using session or cookie.
if (!isset($_SESSION['user_id'])) {
    
    # If session is not set, check if the 'user_id' cookie is available.
    if (isset($_COOKIE['user_id'])) {
        
        # If the cookie is available, regenerate the session using the cookie value.
        $_SESSION['user_id'] = $_COOKIE['user_id'];

        # Optionally, fetch user's first and last name from the database using the user_id from the cookie.
        require('connect_db.php');
        $user_id = mysqli_real_escape_string($link, $_COOKIE['user_id']);
        
        # Query to retrieve the first and last name from the database.
        $q = "SELECT first_name, last_name FROM users WHERE user_id='$user_id'";
        $r = mysqli_query($link, $q);

        if (mysqli_num_rows($r) == 1) {
            $row = mysqli_fetch_assoc($r);
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
        }
        # Close the database connection.
        mysqli_close($link);
    } else {
        # If neither session nor cookie is available, redirect to login page.
        require('login_tools.php');
        load('login.php');
        exit();
    }
}

# Display a welcome message.
if (isset($_SESSION['first_name'])) 
{
    echo '<h1> Welcome, ' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . '.</h1>';
}

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
                    <a href="./alphaStar.php" type="button" class="btn btn-sm btn-outline-secondary">View</a>
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