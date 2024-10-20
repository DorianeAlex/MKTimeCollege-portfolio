<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MK Time E-Commerce</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand"> <img src="images/Designer.png" alt="brand icon" height="50"> MK Time</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav justify-content-end">
            <li class="nav-item bi d-block mx-auto mb-1" width="24" height="24">
              <a class="nav-link active" aria-current="page" href="./index.php">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./dashboard.php">YOUR ACCOUNT</a>
            </li>
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="./collections.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">THE COLLECTION</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./ladiescollection.php">FOR HER</a></li>
                <li><a class="dropdown-item" href="./catalogue.php">FOR HIM</a></li>
              </ul>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="./service.php">SERVICING AND REPAIRS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">OUR WORLD</a>
            </li>
          </ul>
        </div>
        <div class="px-3 py-2 mb-3">
          <div class="container d-flex flex-wrap justify-content-center text-end">
          <a href="./login.php" class="btn btn-light text-dark me-2" role="button">Login</a>
          <?php
# Check if the user is logged in (i.e., session user_id is set).
if (isset($_SESSION['user_id'])) {
    # If logged in, display the Logout button.
    echo '<a href="logout.php" class="btn btn-danger">Logout</a>';
}
?>
          <a href="./register.php" class="btn btn-dark" role="button">Register</a>
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-bag" viewBox="0 0 16 16">
          <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
          </svg>
          </div>
        </div>
      </div>
    </nav>
</header>