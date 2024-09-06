
<?php

    session_start();

    // if users is not login, redirect to login page
    if (!isset($_SESSION['login'])){
      // https://www.php.net/manual/en/function.header.php
      header("Location: login.php");
    }

    date_default_timezone_set('America/Halifax');

    // get sql credentials
    include_once 'serverlogin.php';

    // create mysqli connection object
    $mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_database, $db_port);

    // check if mysqli connection fails
    if ($mysqli->connect_error) {
        die("Connection Failed! " . mysqli_connect_error());
    }

    /*
        Reads form data using POST
        Inserts new event into the Events Table of the whats_happening database
        Uses prepared statements
    */
    function insertEvent(){

      global $mysqli;
    
      // insert into events table
      $insert = "
      INSERT INTO events
          (EventTypeID, GroupID, EventDate, SubmitDate, EventTitle, EventImage, EventDesc) 
      VALUES
          (?, ?, ?, ?, ?, ?, ?)
      ";

      // insert statement is prepared
      $statement = $mysqli->prepare($insert);
      // parameters are bound
      $statement->bind_param("iisssss", $eventTypeID, $groupID, $eventDate, $submitDate, $eventTitle, $eventImage, $eventDesc);

      // gets the groupID of the group submitted
      $groupID = $_SESSION['GroupID'];

      // gets the eventTypeID of the group submitted
      $query = "
      SELECT EventTypeID
          FROM eventtype
          WHERE EventType = '$_POST[type]'
      ";

      $result = $mysqli->query($query);

      $row = $result->fetch_assoc();

      $eventTypeID = $row['EventTypeID'];

      $eventDate = "$_POST[date] $_POST[time]";

      $eventDate = date_create($eventDate);

      $eventDate = date_format($eventDate, "Y-m-d H:i:s");
      
      $submitDate = date("Y-m-d H:i:s");

      $eventTitle = $_POST['title'];

      $eventImage = "files/images/events/$_POST[image]";

      $eventDesc = $_POST['description'];

      // execute insert statement
      $statement->execute();
      // execute insert statement
      $statement->close();

    }

    /*
      Displays name of the currently logged in group
    */
    function displayGroupName(){

      global $mysqli;

      $groupID = $_SESSION['GroupID'];

      // get group name using groupID
      $query = "
      SELECT GroupName
        FROM groups
        WHERE GroupID = $groupID
      ";

      $result = $mysqli->query($query);
      $row = $result->fetch_assoc();

      // print group name
      echo "<p class='text-center'><b>$row[GroupName]</b></p>";

    }

    // insert event when page is submitted
    if (isset($_POST['submit'])){
      insertEvent();
    }    

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- Changed title from ZenBlog to What's Happening -->
  <title>What's Happening</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS Files -->
  <link href="assets/css/variables.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: ZenBlog
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <!-- Changed header from ZenBlog to What's Happening -->
        <h1>What's Happening</h1>
      </a>


      <!-- 
        Navbar Changes:
          A1: Changed navbar titles and linked them to appropriate page 
          A2: Added Post Event to the navbar
          A2: Added event filtering based on event type
          A4: Replaced login with dropdown
          A4: Added Logout to the login dropdown
      -->
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li class="dropdown"><a href="events.php"><span>Events</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="events.php">All Events</a></li>
              <li><a href="events.php?type=Music">Music</a></li>
              <li><a href="events.php?type=Art%2bCulture">Art + Culture</a></li>
              <li><a href="events.php?type=Sports">Sports</a></li>
              <li><a href="events.php?type=Food">Food</a></li>
              <li><a href="events.php?type=Fund Raiser">Fund Raiser</a></li>
            </ul>
          </li>
          <li><a href="groups.php">Comunity Groups</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="post.php">Post Event</a></li>
          <li class="dropdown"><a href="login.php"><span>Login</span><i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="login.php">Login</a></li>
              <li><a href="login.php?logout=true">Logout</a></li>
            </ul>
          </li>
        </ul>
      </nav><!-- .navbar -->

      <div class="position-relative">
        <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
        <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
        <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header><!-- End Header -->

  <!-- 
    A2: Changed title from Contact to Post New Event
    A2: Replaced textboxes from login to Post New Event related textboxes
    A2: changed submit button name from "Login" to "Submit"
  -->
  <main id="main">

    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <h1 class="page-title">Post New Event</h1>
          </div>
        </div>

        <?php displayGroupName(); ?>

        <div class="form mt-5">

          <form action="post.php" method="post" role="form" class="php-email-form">
            
            <div class="form-group">
              <input type="text" class="form-control" name="title" id="title" placeholder="Your Event Title" required>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="date" id="date" placeholder="Your Event Data [Format: year-month-day]" required>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="time" id="time" placeholder="Your Event Time [Format: 00:00 AM/PM]" required>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="type" id="type" placeholder="Your Event Type" required>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="image" id="image" placeholder="Image Name" required>
            </div>
            
            <div class="form-group">
              <textarea class="form-control" name="description" rows="5" placeholder="The Event Description" required></textarea>
            </div>
        
            <div class="text-center">
              <button type="submit" name="submit" class="btn btn-dark">
                Submit
              </button>
            </div>

          </form>
        </div><!-- End Contact Form -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <!-- 
    Footer Changes:
      A1: Changed "About ZenLog" to "About What's Happening"
      A1: Updated navigation links to keep consistent with the navbar
      A1: Replaced categories section with events section
      A1: Removed the recent post section
      A2: Learn more now directs to about.php
      A2: Added event filtering based on event type
  -->
  <footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">

        <div class="row g-5">
          <div class="col-lg-4">
            <h3 class="footer-heading">About What's Happening</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae officiis qui aliquid blanditiis omnis quae. Explicabo?</p>
            <p><a href="about.php" class="footer-link-more">Learn More</a></p>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Navigation</h3>
            <ul class="footer-links list-unstyled">
              <li><a href="index.php"><i class="bi bi-chevron-right"></i> Home</a></li>
              <li><a href="events.php"><i class="bi bi-chevron-right"></i> Events</a></li>
              <li><a href="groups.php"><i class="bi bi-chevron-right"></i> Community Groups</a></li>
              <li><a href="about.php"><i class="bi bi-chevron-right"></i> About</a></li>
              <li><a href="post.php"><i class="bi bi-chevron-right"></i> Post Event</a></li>
              <li><a href="login.php"><i class="bi bi-chevron-right"></i> Login</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Events</h3>
            <ul class="footer-links list-unstyled">
              <li><a href="events.php"><i class="bi bi-chevron-right"></i> All Events</a></li>
              <li><a href="events.php?type=Music"><i class="bi bi-chevron-right"></i> Music</a></li>
              <li><a href="events.php?type=Art%2bCulture"><i class="bi bi-chevron-right"></i> Art + Culture</a></li>
              <li><a href="events.php?type=Sports"><i class="bi bi-chevron-right"></i> Sports</a></li>
              <li><a href="events.php?type=Food"><i class="bi bi-chevron-right"></i> Food</a></li>
              <li><a href="events.php?type=Fund Raiser"><i class="bi bi-chevron-right"></i> Fund Raiser</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="footer-legal">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Copyright <strong><span>ZenBlog</span></strong>. All Rights Reserved
            </div>

            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>

          </div>

          <div class="col-md-6">
            <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div> 

        </div>

      </div>
    </div>

  </footer>  
  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>