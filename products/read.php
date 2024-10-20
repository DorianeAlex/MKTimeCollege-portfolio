<!DOCTYPE html>
<!-- HTML code to create a navigation that will link the different pages of CRUD -->
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" 
   content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>CRUD Practice!</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" 
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
crossorigin="anonymous">

  </head>
  <body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="admin_dashboard.php">CRUD MKTime</a>
  <button class="navbar-toggler" type="button" 
data-toggle="collapse" 
data-target="#navbarNav" 
aria-controls="navbarNav" 
aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="create.php">Create <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="read.php">Read</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="update.php">Update</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="delete.php">Delete</a>
      </li>
    </ul>
  </div>
</nav> 

<?php

# Open database connection.
	require ( '../connect_db.php' );
	
	# Retrieve items from 'products' database table.
	$q = "SELECT * FROM products" ;
	$r = mysqli_query( $link, $q ) ;
	if ( mysqli_num_rows( $r ) > 0 )

    echo '<div class="album py-5 bg-body-tertiary">';
    echo '<div class="container">';
    echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';


    while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC )){
echo '
  <div class="col-md-3 d-flex justify-content-center">
    <div class="card" style="width: 18rem;">
	    <img src='. $row['item_img'].' class="card-img-top" alt="Watch">
	    <div class="card-body">
	        <h5 class="card-title text-center">' . $row['item_name'] .'</h5>
	        <p class="card-text">'. $row['item_desc'] . '</p>
        </div>
	    <ul class="list-group list-group-flush">
	        <li class="list-group-item"><p class="text-center">&pound' . $row['item_price'] . '</p></li>
	        <li class="list-group-item btn btn-dark"><a class="btn btn-dark btn-lg btn-block" href="update.php?id='.$row['item_id'].'">
	        Update</a></li>
	        <li class="list-group-item"><a class="btn btn-dark" href="delete.php?item_id='.$row['item_id'].'">
	        Delete Item</a></li>
	    </ul>
	</div>
</div>';
  }

      # Close the row and container divs.
      echo '</div>';  # Close row
      echo '</div>';  # Close container
      echo '</div>';  # Close album

  # Close database connection.
	mysqli_close( $link) ; 


// # Or display message.
// else { echo '<p>There are currently no items in the table to display.</p>' ; }

?>