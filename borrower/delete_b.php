<?php
include '../includes/db_connect.php';
$db = new DB(); // Create a new instance of the DB class
$conn = $db->getConnection(); // Get the database connection
    $id = $_GET['id'];
    $sql = "DELETE FROM `borrower` WHERE `borrower_id`= $id";
    $result = mysqli_query($conn,$sql);
    if($result){
        header("Location: borrower.php?msg=Record deleted successfully");
        exit();
    } else {
        echo "Failed: ".mysqli_error($conn);
    }
?>