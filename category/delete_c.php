<?php
include '../includes/db_connect.php';
$db = new DB(); // Create a new instance of the DB class
$conn = $db->getConnection(); // Get the database connection
    $id = $_GET['id'];
    $sql = "DELETE FROM `categories` WHERE `category_id`= $id;";
    $result = mysqli_query($conn,$sql);
    if($result){
        header("Location: category.php?msg=Record deleted successfully");
        exit();
    } else {
        echo "Failed: ".mysqli_error($conn);
    }
?>