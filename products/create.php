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



<h1>Add Item</h1>
	<form action="create.php" method="post" >
	  <!-- input box for item name  -->
	  <label for="name">Item Name:</label>
	  <input type="text" 
	  id="item_name" 
	  class="form-control" 
	  name="item_name" 
	  required 
	  value="<?php if (isset($_POST['item_name'])) echo $_POST['item_name']; ?> ">
	  
	  <!-- input box for item description -->  
	  <label for="description">Description:</label>
	  <textarea id="item_desc" 
	  class="form-control" 
	  name="item_desc" 
	  required 
	  value="<?php if (isset($_POST['item_desc'])) echo $_POST['item_desc']; ?>">
	  </textarea>
	  
	 <!-- input box for image path -->
	 <label for="image">Image:</label>
	 <input type="text" 
	 id="item_img" 
	 class="form-control" 
	 name="item_img" 
	 required 
	 value="<?php if (isset($_POST['item_img'])) echo $_POST['item_img']; ?>">
	 
	 <!-- input box for item price -->
	 <label for="price">Price:</label>
	 <input 
	 type="number" 
	 id="item_price" 
	 class="form-control" 
	 name="item_price" 
	 min="0" step="0.01" 
	 required 
	 value="<?php if (isset($_POST['item_price'])) echo $_POST['item_price']; ?>"><br>
	  
   
  <!-- input box for collection type  -->
  <label for="name">Collection:</label>
	<input type="text" 
	id="item_collection" 
	class="form-control" 
	name="item_collection" 
	required 
	value="<?php if (isset($_POST['item_collection'])) echo $_POST['item_collection']; ?> ">
	  
   <!-- submit button -->
     <input type="submit" class="btn btn-dark" value="Submit">
	</form>
</div>

<?php
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
	{
	  # Connect to the database.
	  require ('../connect_db.php'); 

  # Initialize an error array.
  $errors = array();

  # Check for item name .
  if ( empty( $_POST[ 'item_name' ] ) )
  { $errors[] = 'Enter the item name.' ; }
  else
  { $n = mysqli_real_escape_string( $link, trim( $_POST[ 'item_name' ] ) ) ; }

  # Check for a item decription.
  if (empty( $_POST[ 'item_desc' ] ) )
  { $errors[] = 'Enter the item decription.' ; }
  else
  { $d = mysqli_real_escape_string( $link, trim( $_POST[ 'item_desc' ] ) ) ; }
  
  # Check for a item image.
  if (empty( $_POST[ 'item_img' ] ) )
  { $errors[] = 'Enter the item image.' ; }
  else
  { $img = mysqli_real_escape_string( $link, trim( $_POST[ 'item_img' ] ) ) ; }
  
  # Check for a item price.
  if (empty( $_POST[ 'item_price' ] ) )
  { $errors[] = 'Enter the item image.' ; }
  else
  { $p = mysqli_real_escape_string( $link, trim( $_POST[ 'item_price' ] ) ) ; }

  # Check for collection type .
  if ( empty( $_POST[ 'item_collection' ] ) )
  { $errors[] = 'Enter the collection type.' ; }
  else
  { $c = mysqli_real_escape_string( $link, trim( $_POST[ 'item_collection' ] ) ) ; }
  
	
   # On success data into my_table on database.
  if ( empty( $errors ) ) 
  {
    $q = "INSERT INTO products (item_name, item_desc, item_img, item_price, item_collection) 
	VALUES ('$n','$d', '$img', '$p', '$c' )";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    { echo '<p>New record created successfully</p>'; }
  
    # Close database connection.
    mysqli_close($link); 

    exit();
  }
   
  # Or report errors.
  else 
  {
    echo '<p>The following error(s) occurred:</p>' ;
    foreach ( $errors as $msg )
    { echo "$msg<br>" ; }
    echo '<p>Please try again.</p></div>';
    # Close database connection.
    mysqli_close( $link );
	
  }  
}
?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
crossorigin="anonymous"></script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" 
crossorigin="anonymous"></script>
  </body>
</html>