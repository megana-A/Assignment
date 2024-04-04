<?php
include '../includes/db_connect.php';

if(isset($_POST['submit'])){
    $bookid = $_POST['book_id'];
    $isbn = $_POST['ISBN'];
    $title = $_POST['title'];
    $pyear = $_POST['year'];
    $category = $_POST['category_id'];
    $quantity = $_POST['qty'];

    $db = new DB(); // Create a new instance of the DB class
    $conn = $db->getConnection(); // Get the database connection

    // Use prepared statement to prevent SQL injection
    $sql2 = "UPDATE `books` SET `ISBN`=?, `book_id`=?, `title`=?, `published_year`=?, `category_id`=?, `quantity`=? WHERE `book_id`= ?";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, "ssssssi", $isbn, $bookid, $title, $pyear, $category, $quantity, $bookid);
    $result2 = mysqli_stmt_execute($stmt2);

    if($result2){
        header("Location: ../book.php?msg=Record updated successfully");
        exit();
    } else {
        echo "Failed: ".mysqli_error($conn);
    }
}

// Fetch book info for editing
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $db = new DB(); // Create a new instance of the DB class
    $conn = $db->getConnection(); // Get the database connection

    $sql = "SELECT * FROM `books` WHERE book_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        if(!$row) {
            echo "No book found with the provided ID";
            exit();
        }
    } else {
        echo "Error executing SQL query: " . mysqli_error($conn);
        exit();
    }
} else {
    echo "Invalid or missing book ID";
    exit();
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
            <h3>Edit Book Info </h3>
            <p class="text-muted">Click update after changing</p>
        </div>
        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Book ID : </label>
                        <input type="number" class="form-control" name="book_id" value="<?php echo $row['book_id']; ?>">
                    </div>
                    <div class="col">
                        <label class="form-label">ISBN : </label>
                        <input type="text" class="form-control" name="ISBN" value="<?php echo $row['ISBN']; ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Title : </label>
                    <input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Published Year : </label>
                    <input type="text" class="form-control" name="year" value="<?php echo $row['published_year']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Category ID : </label>
                    <input type="number" class="form-control" name="category_id" value="<?php echo $row['category_id']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Quantity : </label>
                    <input type="number" class="form-control" name="qty" value="<?php echo $row['quantity']; ?>">
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="submit"> Update </button>
                    <a href="../book.php" class="btn btn-danger"> Cancel </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
