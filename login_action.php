<?php

# Access session.
session_start() ;
// # Redirect if not logged in.
// if ( !isset( $_SESSION[ 'user_id' ] ) ) { require_once ( 'login_tools.php' ) ; load() ; }

# form submission check
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )

# database connection
require ( 'connect_db.php' ) ;

# login validation
require ( 'login_tools.php' ) ;

# use the validate function to ckeck login
list ( $check, $data ) = validate ( $link, $_POST[ 'email' ], $_POST[ 'pass' ] ) ;

# handling login success
if ( $check ) {
  # storing the user data in session
  $_SESSION[ 'user_id' ] = $data[ 'user_id' ] ;
  $_SESSION[ 'first_name' ] = $data[ 'first_name' ] ;
  $_SESSION[ 'last_name' ] = $data[ 'last_name' ] ;
  
  # set a cookie to store the user ID, expires in 1 hour
  setcookie("user_id", "12345", time() + 3600, "/"); // Sets a cookie named "user_id" with value "12345" that expires in 1 hour
  
  # Redirect to dashboard after successful login.
  load ( 'dashboard.php' ) ;
}

# handling login failure
else { 
    $errors = $data; 
    # displaying login page again with errors
    include ( 'login.php' ) ;
}

# closing database
mysqli_close( $link ) ;

?>