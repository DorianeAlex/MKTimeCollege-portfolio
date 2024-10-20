<?php 
include ( 'includes/nav.php' ) ; 

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('connect_db.php');

  # Initialize an error array.
   $errors = array();

  # Check for a first name.
   if ( empty( $_POST[ 'first_name' ] ) )
   { $errors[] = 'Enter your first name.' ; }
   else
   { $fn = mysqli_real_escape_string( $link, trim( $_POST[ 'first_name' ] ) ) ; }

  # Check for a last name.
  if ( empty( $_POST[ 'last_name' ] ) )
  { $errors[] = 'Enter your last name.' ; }
  else
  { $ln = mysqli_real_escape_string( $link, trim( $_POST[ 'last_name' ] ) ) ; }

  # Check for an email.
  if ( empty( $_POST[ 'email' ] ) )
  { $errors[] = 'Enter your email.' ; }
  else
  { $e = mysqli_real_escape_string( $link, trim( $_POST[ 'email' ] ) ) ; }

  # Check for an address.
  if ( empty( $_POST[ 'address' ] ) )
  { $errors[] = 'Enter your address.' ; }
  else
  { $a = mysqli_real_escape_string( $link, trim( $_POST[ 'address' ] ) ) ; }

  # Check for a postcode.
  if ( empty( $_POST[ 'postcode' ] ) )
  { $errors[] = 'Enter your postcode.' ; }
  else
  { $pc = mysqli_real_escape_string( $link, trim( $_POST[ 'postcode' ] ) ) ; }

  # Check for a country.
  if ( empty( $_POST[ 'country' ] ) )
  { $errors[] = 'Enter your country.' ; }
  else
  { $c = mysqli_real_escape_string( $link, trim( $_POST[ 'country' ] ) ) ; }

  # Check for a password and matching input passwords.
  if ( !empty($_POST[ 'pass1' ] ) )
  {
    if ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] )
    { $errors[] = 'Passwords do not match.' ; }
    else
    { $p = mysqli_real_escape_string( $link, trim( $_POST[ 'pass1' ] ) ) ; }
  }
  else { $errors[] = 'Enter your password.' ; }

  # Check if email address already registered.
  if ( empty( $errors ) )
  {
    $q = "SELECT user_id FROM users WHERE email='$e'" ;
    $r = @mysqli_query ( $link, $q ) ;
    if ( mysqli_num_rows( $r ) != 0 ) 
  $errors[] = 
  'Email address already registered. 
  <a class="alert-link" href="login.php">Sign In Now</a>' ;
  }

  # On success register user inserting into 'users' database table.
  if ( empty( $errors ) ) 
  {
    $q = "INSERT INTO users (first_name, last_name, email, address, postcode, country, password, reg_date) 
	VALUES ('$fn', '$ln', '$e', '$a', '$pc', '$c', '$p', NOW() )";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    { echo '
     <p>You are now registered.</p>
	  <a class="alert-link" href="login.php">Login</a>'; }
	  
  # Close database connection.
    mysqli_close($link); 
    exit();
  }

  # Or report errors.
  else 
  {
    echo '<h4 class="alert-heading" id="err_msg">The following error(s) occurred:</h4>' ;
    foreach ( $errors as $msg )
    { echo " - $msg<br>" ; }
    echo '<p>or please try again.</p></div>';
    # Close database connection.
    mysqli_close( $link );
  }  
}
?>


  <main class="form-signin w-100 m-auto" style="max-width: 800px;">
    <div class="col-md-8 col-lg-9">
    <h1 class="mb-3">New account</h1>
      <form class="needs-validation" novalidate="" method="POST" action="register.php">
        <div class="row g-3">

          <div class="col-sm-6">
          <label for="inputfirst_name">First Name</label>
          <input type="text" 
          name="first_name" 
          class="form-control"
          required 
          placeholder="* First Name " 
          value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
          </div>

          <div class="col-sm-6">
          <label for="inputlast_name">Last Name</label>
	        <input type="text" 
	        name="last_name" 
	        class="form-control" 
	        required 
	        placeholder="* Last Name" 
	        value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
          </div>

          <div class="col-12">
          <label for="inputemail">Email</label>
	        <input type="email" 
	        name="email" 
	        class="form-control" 
	        required 
	        placeholder="* email@example.com" 
	        value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
          </div>


          <div class="col-12">
          <label for="address" class="form-label">Address</label>
          <input type="text" 
          class="form-control" 
          id="address" 
          name="address" 
          placeholder="* 1234 Main St" 
          required=""
          value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>">
          </div>

          <div class="col-md-5">
          <label for="country" class="form-label">Country</label>
          <select class="form-select" id="country" name="country" required="">
            <option value="">Choose...</option>
            <option>United Kingdom</option>
            <option>France</option>
            <option>USA</option>
          </select
          value="<?php if (isset($_POST['country'])) echo $_POST['country']; ?>">
          </div>

          <div class="col-md-3">
          <label for="zip" class="form-label">Postcode</label>
          <input type="text" class="form-control" id="postcode" name="postcode" required
          value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode']; ?>">
          </div>
        </div>

          <div class="col-md-5">
          <label for="inputpass1">Create New Password</label>
		<input type="password"
		       name="pass1" 
		       class="form-control" 
		       required 
		       placeholder="* Create New Password" 
		       value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>">
          </div>

          <div class="col-md-5">
          <label for="inputpass2">Confirm Password</label>
		<input type="password" 
		       name="pass2" 
		       class="form-control" 
		       required 
		       placeholder="* Confirm Password" 
		       value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>">
          </div>

        <hr class="my-4">
        <div class="form-check">
        <input type="checkbox" class="form-check-input" id="same-address">
        <label class="form-check-label" for="same-address">I want to receive the newsletters</label>
        </div>

        <hr class="my-4">
          <button class="w-100 btn btn-dark btn-lg" type="submit">Confirm</button>
      </form>
    </div>
  </main>

  <?php include ('includes/footer.php'); ?>
