<?php

include 'nav_admin.php';

# Open database connection.
require ( '../connect_db.php' ) ;

if (isset($_GET['item_id'])) {
    $id = $_GET['item_id'];
}

$sql = "DELETE FROM products WHERE item_id='$id'";
if ($link->query($sql) === TRUE) {
    header("Location: read.php");
} else {
    echo "Error deleting record: " . $link->error;
}

# Close database connection.
mysqli_close( $link );

?>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
crossorigin="anonymous"></script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" 
crossorigin="anonymous"></script>
  </body>
</html>