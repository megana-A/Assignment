<?php
include '../includes/db_connect.php';
$db = new DB();
$conn = $db->getConnection();

$error_message = '';

if(isset($_POST['submit'])){
    // Validate and sanitize inputs
    $authorid = filter_input(INPUT_POST, 'author_id', FILTER_SANITIZE_NUMBER_INT);
    $name = filter_input(INPUT_POST, 'author_name', FILTER_SANITIZE_STRING);

    // Check if inputs are not empty
    if(empty($authorid) || empty($name)) {
        $error_message = "Please fill all the fields";
    } else {
        // Use prepared statement to prevent SQL injection
        $sql = "UPDATE `authors` SET `author_name`=? WHERE `author_id`=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $name, $authorid);
        $result = mysqli_stmt_execute($stmt);

        if($result){
            header("Location: author.php?msg=Record updated successfully");
            exit();
        } else {
            $error_message = "Failed: ".mysqli_error($conn);
        }
    }
}

// Fetch author info for editing
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM `authors` WHERE author_id = ?";
    $stmt1 = mysqli_prepare($conn, $sql1);
    mysqli_stmt_bind_param($stmt1, "i", $id);
    mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);

    if($result1) {
        $row = mysqli_fetch_assoc($result1);
        if(!$row) {
            $error_message = "No author found with the provided ID";
        }
    } else {
        $error_message = "Error executing SQL query: " . mysqli_error($conn);
    }
} else {
    $error_message = "Invalid or missing author ID";
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
            <h3>Edit Author Info </h3>
            <p class="text-muted">Click update after changing</p>
        </div>
        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <?php if(!empty($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label class="form-label">Author ID : </label>
                    <input type="text" class="form-control" name="author_id" value="<?php echo htmlspecialchars($row['author_id']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Author Name : </label>
                    <input type="text" class="form-control" name="author_name" value="<?php echo htmlspecialchars($row['author_name']); ?>">
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="submit"> Update </button>
                    <a href="author.php" class="btn btn-danger"> Cancel </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
