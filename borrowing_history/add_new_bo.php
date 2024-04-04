<?php
include '../includes/db_connect.php';
$db = new DB();
$conn = $db->getConnection();

$error_message = ''; // Initialize error message variable

if(isset($_POST['submit'])){
    // Validate and sanitize inputs
    $bid = filter_input(INPUT_POST, 'borrowing_id', FILTER_VALIDATE_INT);
    $b_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
    $bo_id = filter_input(INPUT_POST, 'borrower_id', FILTER_VALIDATE_INT);
    $bdate = $_POST['borrower_date'];
    $rdate = $_POST['return_date'];

    // Check if inputs are not empty
    if(empty($bid) || empty($b_id) || empty($bo_id) || empty($bdate) || empty($rdate)) {
        $error_message = "Please fill all the fields";
    } else {
        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO borrowing_history (borrowing_id, book_id, borrower_id, borrower_date, return_date) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iiiss", $bid, $b_id, $bo_id, $bdate, $rdate);
        $result = mysqli_stmt_execute($stmt);

        // Check if insertion was successful
        if($result){
            // Update book quantity
            $sql_update = "UPDATE Books SET quantity = quantity - 1 WHERE book_id = ?";
            $stmt_update = mysqli_prepare($conn, $sql_update);
            mysqli_stmt_bind_param($stmt_update, "i", $b_id);
            $result_update = mysqli_stmt_execute($stmt_update);

            if($result_update) {
                header("Location: borrowing_history.php?msg=New record created successfully");
                exit();
            } else {
                $error_message = "Failed to update book quantity: ".mysqli_error($conn);
            }
        } else {
            $error_message = "Failed to insert record: ".mysqli_error($conn);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>LMS</title>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style = "background-color: #00ff5573;">
        LIBRARY MANAGEMENT SYSTEM
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Add new Borrow </h3>
            <p class = "text-muted">Complete the form below to add a new borrow </p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style = "width:50vw; min-width:300px;">
                <?php if(!empty($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <div class = "mb-3">
                    <label class = "form-label">Borrowing ID : </label>
                    <input type = "number" class = "form-control" name = "borrowing_id">
                </div>
                <div class = "mb-3">
                    <label class = "form-label">Book ID : </label>
                    <input type = "number" class = "form-control" name = "book_id">
                </div>
                <div class = "mb-3">
                    <label class = "form-label">Borrower ID : </label>
                    <input type = "number" class = "form-control" name = "borrower_id">
                </div>
                <div class = "mb-3">
                    <label class = "form-label">Borrow Date : </label>
                    <input type = "date" class = "form-control" name = "borrower_date">
                </div>
                <div class = "mb-3">
                    <label class = "form-label">Return Date : </label>
                    <input type = "date" class = "form-control" name = "return_date">
                </div>
                <div>
                    <button type = "submit" class="btn btn-success" name = "submit" > Save </button>
                    <a href = "borrowing_history.php" class = "btn btn-danger"> Cancel </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" 
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" 
    crossorigin="anonymous"></script>
</body>
</html>
