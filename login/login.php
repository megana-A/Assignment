<?php
session_start();

// Check if the user is already logged in, if yes, redirect to index.php
if(isset($_SESSION["user_id"])) {
    header("Location: ../index.php");
    exit;
}

include '../includes/db_connect.php';
$db = new DB();
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $db->getConnection()->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: ../index.php");
            exit;
        } else {
            $message = "Incorrect password";
        }
    } else {
        $message = "Username not found";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="..\style.css">
    <link rel="stylesheet" href="../assets/css/login-style.css">
</head>

<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php echo $message; ?>
    </div>
</body>

</html>
