<?php
include '../includes/db_connect.php';
$db = new DB();
$conn = $db->getConnection();

if(isset($_POST['submit'])){
    // Validate and sanitize inputs
    $bid = filter_var($_POST['borrower_id'], FILTER_SANITIZE_NUMBER_INT);
    $name = filter_var($_POST['borrower_name'], FILTER_SANITIZE_STRING);
    $age = filter_var($_POST['borrower_age'], FILTER_SANITIZE_NUMBER_INT);
    $address = filter_var($_POST['borrower_address'], FILTER_SANITIZE_STRING);

    // Check if inputs are not empty
    if(empty($bid) || empty($name) || empty($age) || empty($address)) {
        $error_message = "Please fill all the fields";
    } else {
        // Use prepared statement to prevent SQL injection
        $sql2 = "UPDATE `borrower` SET `borrower_name`=?, `borrower_age`=?, `borrower_address`=? WHERE `borrower_id`= ?";
        $stmt2 = mysqli_prepare($conn, $sql2);
        mysqli_stmt_bind_param($stmt2, "sisi", $name, $age, $address, $bid);
        $result2 = mysqli_stmt_execute($stmt2);
    
        if($result2){
            header("Location: borrower.php?msg=Record updated successfully");
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
            <h3>Edit Borrower Info </h3>
            <p class = "text-muted">Click update after changing</p>
        </div>
        
        <?php
        // Display error message if any
        if(isset($error_message)) {
            echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
        }
        
        // Fetch borrower information
        if(isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
            $sql1 = "SELECT * FROM `borrower` WHERE borrower_id = $id;";
            $result1 = mysqli_query($conn, $sql1);
            if($result1) {
                $row = mysqli_fetch_assoc($result1);
                if(!$row) {
                    echo "No borrower found with the provided ID";
                    exit();
                }
            } else {
                echo "Error executing SQL query: " . mysqli_error($conn);
                exit();
            }
        } else {
            echo "Invalid or missing borrower ID";
            exit();
        }
        ?>
        
        <div class="container d-flex justify-content-center">
            <form action="" method="post" style = "width:50vw; min-width:300px;">
                <div class = "mb-3">
                    <label class = "form-label">Borrower ID : </label>
                    <input type = "text" class = "form-control" name = "borrower_id" value = "<?php echo $row['borrower_id']?>" readonly>
                </div>
                <div class = "mb-3">
                    <label class = "form-label">Borrower Name : </label>
                    <input type = "text" class = "form-control" name = "borrower_name" value = "<?php echo $row['borrower_name']?>">
                </div>
                <div class = "mb-3">
                    <label class = "form-label">Borrower Age : </label>
                    <input type = "text" class = "form-control" name = "borrower_age" value = "<?php echo $row['borrower_age']?>">
                </div>
                <div class = "mb-3">
                    <label class = "form-label">Borrower Address : </label>
                    <input type = "text" class = "form-control" name = "borrower_address" value = "<?php echo $row['borrower_address']?>">
                </div>
                <div>
                    <button type = "submit" class="btn btn-success" name = "submit" > Update </button>
                    <a href = "borrower.php" class = "btn btn-danger"> Cancel </a>
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
