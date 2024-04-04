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
        <?php
        if(isset($_GET['msg'])){
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            '.$msg.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        ?>
        <a href = "../book.php" class ="btn btn-info mb-3"> Back to Home </a>
        <a href = "add_new_a.php" class ="btn btn-outline-warning mb-3"> Add New Author </a>

        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope = "col"> Author ID </th>
                    <th scope = "col"> Author Name </th>
                    <th scope = "col"> Action </th>
            </thead>
            <tbody>
                <?php
                include '../includes/db_connect.php';
                $db = new DB(); // Create a new instance of the DB class
                $conn = $db->getConnection(); // Get the database connection
                    $sql = "SELECT * FROM `authors`";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        ?>
                            <tr>
                                <th><?php echo $row['author_id'] ?> </th>
                                <td><?php echo $row['author_name'] ?></td>
                                <td>
                                    <a href = "edit_a.php?id=<?php echo $row['author_id']?>" class = "link-dark"><i class = "fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                                    <a href = "delete_a.php?id=<?php echo $row['author_id']?>" class = "link-dark"><i class = "fa-solid fa-trash fs-5 me-3"></i></a>
                                </td>
                            </tr>

                        <?php
                    }
                ?>
                
            </tbody>
        </table>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" 
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" 
    crossorigin="anonymous"></script>
</body>
</html>