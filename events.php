<?php

  session_start();

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
   Event data is taken from events table in the whats_happening database
   Events are displayed using a Heredoc
  */
  function displayEvents(){

    global $mysqli;
    
    $filter = 'ALL';
    $whereFilter = '';

    // get event type to be used in filter functionality
    if (isset($_GET["type"])){

      $filter = $_GET["type"];

      // limit query using event type
      $whereFilter = "AND EventType = '$filter'";

    }

    // prints current category filter
    echo "<h3 class='category-title'>Event Category: $filter</h3>";
    
    // if an event is past current date, it won't be displayed
    $currentDate = date("Y-m-d H:i:s");

    // Joins the events table with the eventtype and groups tables to get the EventType and GroupName values
    $query = "
    SELECT EventID, EventImage, EventType, EventDate, EventTitle, GroupName, GroupImage
      FROM events
      INNER JOIN eventtype
      USING (EventTypeID)
      INNER JOIN groups
      USING (GroupID)
      WHERE EventDate >= '$currentDate'
      $whereFilter
      ORDER BY EventDate ASC
    ";

    $result = $mysqli->query($query);

    // prints all events returned by the query
    for ($i = 0; $i < $result->num_rows; $i++){

      $row = $result->fetch_assoc();

      $dateTime = date_create($row["EventDate"]);

      $dateTime = date_format($dateTime, "Y-M-d &#8226; h:i:s A");

      $events = <<<DOC
      <div class="d-md-flex post-entry-2 half">
        <a href="single-post.php?event=$row[EventID]" class="me-4 thumbnail">
          <img src="$row[EventImage]" alt="" class="img-fluid">
        </a>
        <div>
          <div class="post-meta">
            <span class="date">$row[EventType]</span> 
            <span class="mx-1">&#8226;</span> 
            <span>$dateTime</span>
          </div>
          <h3>
            <a href="single-post.php?event=$row[EventID]">
              $row[EventTitle]
            </a>
          </h3>
          <div class="d-flex align-items-center author">
            <div class="photo">
              <img src="$row[GroupImage]" alt="" class="img-fluid" style="aspect-ratio: 1/1">
            </div>
            <div class="name">
              <h3 class="m-0 p-0">$row[GroupName]</h3>
            </div>
          </div>
        </div>
      </div>
      DOC;    

      echo $events;

    }

  }

  /*
    Displays the upcoming events slider column 
  */
  function displayUpcomingColumn(){

    global $mysqli;

    // if an event is past current date, it won't be displayed
    $currentDate = date("Y-m-d H:i:s");

    // Joins the events table with the eventtype and groups tables to get the EventType and GroupName values
    $query = "
    SELECT EventID, EventImage, EventType, EventDate, EventTitle, GroupName
      FROM events
      INNER JOIN eventtype
      USING (EventTypeID)
      INNER JOIN groups
      USING (GroupID)
      WHERE EventDate >= '$currentDate'
      ORDER BY EventDate ASC
    ";

    $result = $mysqli->query($query);

    // prints events on the slider
    for ($i = 0; $i < $result->num_rows; $i++){

      $row = $result->fetch_assoc();

      $dateTime = date_create($row["EventDate"]);

      $dateTime = date_format($dateTime, "Y-M-d");

      $upcoming = <<<DOC
      <div class="post-entry-1 border-bottom">
          <div class="post-meta">
            <span class="date">$row[EventType]</span> 
            <span class="mx-1">&#8226;</span> 
            <span>$dateTime</span>
          </div>
          <h2 class="mb-2"><a href="single-post.php?event=$row[EventID]">$row[EventTitle]</a></h2>
          <span class="author mb-3 d-block">$row[GroupName]</span>
        </div>
      DOC;

      echo $upcoming;

    }

  }

  /*
    Displays the latest added events slider column 
  */
  function displayLatestColumn(){

    global $mysqli;

    // if an event is past current date, it won't be displayed
    $currentDate = date("Y-m-d H:i:s");

    // Joins the events table with the eventtype and groups tables to get the EventType and GroupName values
    $query = "
    SELECT EventID, EventImage, EventType, EventDate, EventTitle, GroupName
      FROM events
      INNER JOIN eventtype
      USING (EventTypeID)
      INNER JOIN groups
      USING (GroupID)
      WHERE EventDate >= '$currentDate'
      ORDER BY SubmitDate DESC
    ";

    $result = $mysqli->query($query);

    // prints events on the slider
    for ($i = 0; $i < $result->num_rows; $i++){

      $row = $result->fetch_assoc();

      $dateTime = date_create($row["EventDate"]);

      $dateTime = date_format($dateTime, "Y-M-d");

      $latest = <<<DOC
      <div class="post-entry-1 border-bottom">
          <div class="post-meta">
            <span class="date">$row[EventType]</span> 
            <span class="mx-1">&#8226;</span> 
            <span>$dateTime</span>
          </div>
          <h2 class="mb-2"><a href="single-post.php?event=$row[EventID]">$row[EventTitle]</a></h2>
          <span class="author mb-3 d-block">$row[GroupName]</span>
        </div>
      DOC;

      echo $latest;

    }

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
    Main Section Changes:
      A1: Chagend heading "Category: Busines" to "Category: Add"
      A1: Removed one column slider from the sidebar
      A1: Changed remaining column sliders to "Upcoming" and "Latest Added"
      A1: Removed the video and image from the sidebar
      A1: Changed "Categories" section to "Events" section
      A1: Updated Tags with the new Event categories
      A2: Event Category now displays the type of event chosen by the user
  -->
  <main id="main">
    <section>
      <div class="container">
        <div class="row">

          <div class="col-md-9" data-aos="fade-up">

            <?php displayEvents(); ?>

          </div>

          <div class="col-md-3">
            <!-- ======= Sidebar ======= -->
            <div class="aside-block">

              <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-upcoming-tab" data-bs-toggle="pill" data-bs-target="#pills-upcoming" type="button" role="tab" aria-controls="pills-upcoming" aria-selected="true">Upcoming</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest" type="button" role="tab" aria-controls="pills-latest" aria-selected="false">Latest Added</button>
                </li>
              </ul>

              <div class="tab-content" id="pills-tabContent">

                <!-- Upcoming -->                
                <div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel" aria-labelledby="pills-upcoming-tab">
                  
                  <?php displayUpcomingColumn(); ?>
                
                </div>
                <!-- End Upcoming -->

                <!-- Latest -->
                <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">

                  <?php displayLatestColumn(); ?>
                
                </div>
                <!-- End Latest -->

              </div>
            </div>

            <!--
              Events and Tags Changes:
                A2: Events and Tags now filter events based on their type
            -->
            <div class="aside-block">
              <h3 class="aside-title">Events</h3>
              <ul class="aside-links list-unstyled">
                <li><a href="events.php"><i class="bi bi-chevron-right"></i> All Events</a></li>
                <li><a href="events.php?type=Music"><i class="bi bi-chevron-right"></i> Music</a></li>
                <li><a href="events.php?type=Art%2bCulture"><i class="bi bi-chevron-right"></i> Art + Culture</a></li>
                <li><a href="events.php?type=Sports"><i class="bi bi-chevron-right"></i> Sports</a></li>
                <li><a href="events.php?type=Food"><i class="bi bi-chevron-right"></i> Food</a></li>
                <li><a href="events.php?type=Fund Raiser"><i class="bi bi-chevron-right"></i> Fund Raiser</a></li>
              </ul>
            </div><!-- End Events -->

            <div class="aside-block">
              <h3 class="aside-title">Tags</h3>
              <ul class="aside-tags list-unstyled">
                <li><a href="events.php">All Events</a></li>
                <li><a href="events.php?type=Music">Music</a></li>
                <li><a href="events.php?type=Art%2bCulture">Art + Culture</a></li>
                <li><a href="events.php?type=Sports">Sports</a></li>
                <li><a href="events.php?type=Food">Food</a></li>
                <li><a href="events.php?type=Fund Raiser">Fund Raiser</a></li>
              </ul>
            </div><!-- End Tags -->

          </div>

        </div>
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