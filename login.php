<?php 
include ( 'includes/nav.php' ) ;

# Display any error messages if present.
if ( isset( $errors ) && !empty( $errors ) )
{
 echo '<p id="err_msg">Oops! There was a problem:<br>' ;
 foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
 echo 'Please try again or <a href="register.php">Register</a></p>' ;
}
?>

<!-- display body section for the form -->
<main class="form-signin w-100 m-auto" style="max-width: 330px;">

<form action="login_action.php" method="post">
    <div class="mb-3">
      <h1>Existing account</h1>
      <p>Login using your credentials below.</p>
      <label for="inputemail">Email</label>
      <input type="text" 
		  name="email" 
		  class="form-control" 
		  required 
		  placeholder="* Enter Email"> 
    </div>

    <div class="mb-3">
    <label for="inputemail">Password</label>
    <input type="password" 
		  name="pass"  
	    class="form-control" 
		  required 
	    placeholder="* Enter Password">
    </div>

  <button type="submit" value="Login" class="btn btn-dark">Login</button>
  </form>
</main>

    
<?php include 'includes/footer.php' ?>