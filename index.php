<?php 
# starting the session
session_start() ;

include ('includes/nav.php');?>

  <div class="container mt-5">
    <div class="row featurette">
      <div class="col-md-7">
        <h1 class="featurette-heading fw-bold lh-1">Designed for luxury
          <br><span class="text-body-secondary">Brought to you using the finest products</span></h1>
        <p class="lead">The MK Time collection offers a wide range of prestigious, high-precision timepieces, from Professional to Classic models to suit any wrist.</p>
        <div class="d-flex gap-2 lead fw-normal">
          <a class="icon-link link-dark" href="./dashboard.php">
            Explore
            <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
          </a>
          <a class="icon-link link-dark" href="./service.php">
            Service
            <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
          </a>
        </div>
      </div>
      <div class="col-md-5">
        <img src="./images/watch.jpg" class="featurette-image img-fluid mx-auto border rounded-3 shadow-lg mb-4" alt="watch" width="500" height="500">
      </div>
    </div>
</div>


  <?php include 'includes/footer.php'; ?>