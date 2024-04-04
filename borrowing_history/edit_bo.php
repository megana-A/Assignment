<?php
include '../includes/db_connect.php';
$db = new DB();
$conn = $db->getConnection();

$error_message = ''; // Initialize error message variable

if(isset($_POST['submit'])){
    // Validate and sanitize inputs
    $bid = filter_var($_POST['borrowing_id'], FILTER_SANITIZE_NUMBER_INT);
    $b_id = filter_var($_POST['book_id'], FILTER_SANITIZE_NUMBER_INT);
    $bo_id = filter_var($_POST['borrower_id'], FILTER_SANITIZE_NUMBER_INT);
    $bdate = $_POST['borrower_date'];
    $rdate = $_POST['return_date'];

    // Check if inputs are not empty
    if(empty($bid) || empty($b_id) || empty($bo_id) || empty($bdate) || empty($rdate)) {
        $error_message = "Please fill all the fields";
    } else {
        // Use prepared statement to prevent SQL injection
        $sql2 = "UPDATE `borrowing_history` SET `book_id`=?, `borrower_id`=?, `borrower_date`=?, `return_date`=? WHERE `borrowing_id`=?";
        $stmt2 = mysqli_prepare($conn, $sql2);
        mysqli_stmt_bind_param($stmt2, "iissi", $b_id, $bo_id, $bdate, $rdate, $bid);
        $result2 = mysqli_stmt_execute($stmt2);
    
        if($result2){
            header("Location: borrowing_history.php?msg=Record updated successfully");
            exit();
        } else {
            echo "Failed: ".mysqli_error($conn);
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
            <h3>Edit Borrow Info </h3>
            <p class = "text-muted">Click update after changing</p>
        </div>
    <?php

        // Check if borrowing_id is provided and is numeric
        if(isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];

            // Prepare and execute SQL query
            $sql1 = "SELECT * FROM `borrowing_history` WHERE borrowing_id = ?";
            $stmt1 = mysqli_prepare($conn, $sql1);
            mysqli_stmt_bind_param($stmt1, "i", $id);
            mysqli_stmt_execute($stmt1);
            $result1 = mysqli_stmt_get_result($stmt1);

            // Check if query was successful
            if($result1) {
                $row = mysqli_fetch_assoc($result1);
                // Check if a row was found
                if(!$row) {
                    echo "No borrow found with the provided ID";
                    exit();
                }
            } else {
                // Query execution failed
                echo "Error executing SQL query: " . mysqli_error($conn);
                exit();
            }
        } else {
            echo "Invalid or missing borrow ID";
            exit();
        }
    ?>
    <div class="container d-flex justify-content-center">
            <form action="" method="post" style = "width:50vw; min-width:300px;">
                <?php if(!empty($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <div class = "mb-3">
                    <label class = "form-label">Borrowing ID : </label>
                    <input type = "text" class = "form-control" name = "borrowing_id" value = "<?php echo $row['borrowing_id']?>">
                </div>
                <div class = "mb-3">
                    <label class = "form-label">Book ID : </label>
                    <input type = "text" class = "form-control" name = "book_id" value = "<?php echo $row['book_id']?>">
                </div>
                <div class = "mb-3">
                    <label class = "form-label">Borrower ID : </label>
                    <input type = "text" class = "form-control" name = "borrower_id" value = "<?php echo $row['borrower_id']?>">
                </div>
                <div class = "mb-3">
                    <label class = "form-label">Borrow Date: </label>
                    <input type = "text" class = "form-control" name = "borrower_date"value = "<?php echo $row['borrower_date']?>">
                </div>
                <div class = "mb-3">
                    <label class = "form-label">Return Date: </label>
                    <input type = "text" class = "form-control" name = "return_date"value = "<?php echo $row['return_date']?>">
                </div>
                <div>
                    <button type = "submit" class="btn btn-success" name = "submit" > Update </button>
                    <a href = "borrowing_history.php" class = "btn btn-danger"> Cancel </a>
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
