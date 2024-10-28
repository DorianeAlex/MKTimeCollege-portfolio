 <?php

include 'nav_admin.php';

# Open database connection.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    # Connect to the database.
    require ('../connect_db.php'); 

    # Initialize an error array.
    $errors = array();

    # Check for an item id (this is required to identify the product).
    if ( empty( $_POST[ 'item_id' ] ) )
    {
        $errors[] = 'Update item ID is required.'; 
    }
    else
    {
        $id = mysqli_real_escape_string( $link, trim( $_POST[ 'item_id' ] ) ); 
    }

    # Prepare to build the dynamic query only for the fields the user wants to update.
    $updateFields = array();  // Array to collect the parts of the update query.

    # Check for an item name (if user wants to update it).
    if ( !empty( $_POST[ 'item_name' ] ) )
    { 
        $n = mysqli_real_escape_string( $link, trim( $_POST[ 'item_name' ] ) ); 
        $updateFields[] = "item_name='$n'";  // Add the item_name to the update fields
    }

    # Check for an item description (if user wants to update it).
    if ( !empty( $_POST[ 'item_desc' ] ) )
    { 
        $d = mysqli_real_escape_string( $link, trim( $_POST[ 'item_desc' ] ) ); 
        $updateFields[] = "item_desc='$d'";  // Add the item_desc to the update fields
    }

    # Check for an item image (if user wants to update it).
    if ( !empty( $_POST[ 'item_img' ] ) )
    { 
        $img = mysqli_real_escape_string( $link, trim( $_POST[ 'item_img' ] ) ); 
        $updateFields[] = "item_img='$img'";  // Add the item_img to the update fields
    }

    # Check for an item price (if user wants to update it).
    if ( !empty( $_POST[ 'item_price' ] ) )
    { 
        $p = mysqli_real_escape_string( $link, trim( $_POST[ 'item_price' ] ) ); 
        $updateFields[] = "item_price='$p'";  // Add the item_price to the update fields
    }

    # If no fields were provided for update, show an error.
    if ( empty( $updateFields ) )
    {
        $errors[] = 'At least one field to update must be provided.';
    }

    # If no errors, proceed with the update.
    if ( empty( $errors ) ) 
    {
        # Build the dynamic update query using the fields provided by the user.
        $q = "UPDATE products SET " . implode(', ', $updateFields) . " WHERE item_id='$id'";

        # Execute the query.
        $r = @mysqli_query( $link, $q );
        
        if ( $r )
        {
            header("Location: read.php");
        }
        else
        {
            echo "Error updating record: " . mysqli_error($link);
        }

        # Close database connection.
        mysqli_close( $link );
    } 
    else
    {
        # Display errors.
        echo '<h3>Error!</h3><p>The following error(s) occurred:<br>';
        foreach ( $errors as $msg )
        {
            echo " - $msg<br>";
        }
        echo '</p>';
    }
}
?>
<h1>Update Item</h1>
<form action="update.php" method="post">
    <label>Item ID (required to find product)</label>
    <input type="text" name="item_id" class="form-control" value="<?php if (isset($_POST['item_id'])) echo $_POST['item_id']; ?>" required><br>
    
    <label>Item Name (leave blank if no change)</label>
    <input type="text" name="item_name" class="form-control" value="<?php if (isset($_POST['item_name'])) echo $_POST['item_name']; ?>"><br>

    <label>Item Description (leave blank if no change)</label>
    <input type="text" name="item_desc" class="form-control" value="<?php if (isset($_POST['item_desc'])) echo $_POST['item_desc']; ?>"><br>

    <label>Item Image URL (leave blank if no change)</label>
    <input type="text" name="item_img" class="form-control" value="<?php if (isset($_POST['item_img'])) echo $_POST['item_img']; ?>"><br>

    <label>Item Price (leave blank if no change)</label>
    <input type="text" name="item_price" class="form-control" value="<?php if (isset($_POST['item_price'])) echo $_POST['item_price']; ?>"><br>

    <input type="submit" class="btn btn-dark" value="Submit">
</form>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
crossorigin="anonymous"></script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" 
crossorigin="anonymous"></script>
  </body>
</html>