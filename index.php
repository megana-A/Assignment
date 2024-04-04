<?php
class Book
{
    protected $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function getTotalBooks()
    {
        $query = "SELECT SUM(total_qty) AS total_books FROM books;";
        $result = $this->db->getConnection()->query($query);
        $row = $result->fetch_assoc();
        return $row['total_books'];
    }


    public function getAvailableBooks()
    {
        $query = "SELECT SUM(quantity) AS available_books FROM books WHERE quantity > 0";
        $result = $this->db->getConnection()->query($query);
        $row = $result->fetch_assoc();
        return $row['available_books'];
    }

    public function getBorrowedBooks()
    {
        $query = "SELECT SUM(quantity) AS borrowed_books FROM books WHERE borrowed = 'borrowed'";
        $result = $this->db->getConnection()->query($query);
        $row = $result->fetch_assoc();
        return $row['borrowed_books'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Library Management system</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <section id="topbar" class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:library1@gmail.com">library1@gmail.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+94 78-724-4035</span></i>
      </div>
    </div>
  </section><!-- End Top Bar -->

  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <h1>LMS<span>.</span></h1>
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="#hero">Home</a></li>
          <li><a href=".\login\login.php">Log Out</a></li>
        </ul>
      </nav><!-- .navbar -->
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
  <?php
    include 'includes/db_connect.php';
    $book = new Book();
    ?>
    <div class="icon-boxes position-relative">
      <div class="container position-relative">
        <div class="row gy-4 mt-5">

          <div class="" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-book"></i></div>
              <h4 class="title"><a href="book.php" class="stretched-link">Manage Books</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-book"></i></div>
              <h4 class="title"><a href="books.php" class="stretched-link">Total Books ( <?php echo $book->getTotalBooks(); ?> )</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-book"></i></div>
              <h4 class="title"><a href="borrowing_history/borrowing_history.php" class="stretched-link">Borrowed Books</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="" data-aos="fade-up" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-book"></i></div>
              <h4 class="title"><a href="a.php" class="stretched-link">Available Books ( <?php echo $book->getAvailableBooks(); ?> )</a></h4>
            </div>
          </div><!--End Icon Box -->
       </div>
      </div>
    </div>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="container mt-4">
      <div class="copyright">
        &copy; Copyright <strong><span>LIBRARY</span></strong>. All Rights Reserved
      </div>
    </div>

  </footer>
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>