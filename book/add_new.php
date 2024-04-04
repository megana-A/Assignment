<?php
include '../includes/db_connect.php';
$db = new DB(); // Create a new instance of the DB class
$conn = $db->getConnection(); // Get the database connection

$error_message = '';

if(isset($_POST['submit'])){
    // Validate and sanitize inputs
    $bookid = filter_input(INPUT_POST, 'book_id', FILTER_SANITIZE_NUMBER_INT);
    $isbn = filter_input(INPUT_POST, 'ISBN', FILTER_SANITIZE_STRING);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $pyear = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT);
    $category = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_input(INPUT_POST, 'qty', FILTER_SANITIZE_NUMBER_INT);
    $totqty = filter_input(INPUT_POST, 'total_qty', FILTER_SANITIZE_NUMBER_INT);

    // Check if any field is empty
    if(empty($bookid) || empty($isbn) || empty($title) || empty($pyear) || empty($category) || empty($quantity) || empty($totqty)) {
        $error_message = "Please fill all the fields";
    } else {
        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO `books`(`ISBN`, `book_id`, `title`, `published_year`, `category_id`, `quantity`,`total_qty`) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sisiiii", $isbn, $bookid, $title, $pyear, $category, $quantity, $totqty);
        $result = mysqli_stmt_execute($stmt);

        if($result){
            header("Location: ../book.php?msg=New record created successfully");
            exit();
        }
        else {
            $error_message = "Failed: ".mysqli_error($conn);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>LMS</title>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
        LIBRARY MANAGEMENT SYSTEM
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Add new Book </h3>
            <p class="text-muted">Complete the form below to add a new book </p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <?php if(!empty($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Book ID : </label>
                        <input type="number" class="form-control" name="book_id" placeholder="1">
                    </div>
                    <div class="col">
                        <label class="form-label">ISBN : </label>
                        <input type="text" class="form-control" name="ISBN" placeholder="978-00000000000">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Title : </label>
                    <input type="text" class="form-control" name="title" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Published Year : </label>
                    <input type="text" class="form-control" name="year" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Category ID : </label>
                    <input type="number" class="form-control" name="category_id" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Quantity : </label>
                    <input type="number" class="form-control" name="qty" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Total Quantity : </label>
                    <input type="number" class="form-control" name="total_qty" placeholder="">
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="submit"> Save </button>
                    <a href="../index.php" class="btn btn-danger"> Cancel </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
