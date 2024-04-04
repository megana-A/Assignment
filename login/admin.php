<?php
include '../includes/db_connect.php';


class Admin {
    private $db;

  
    

    public function login($username, $password) {
       
        $username = $this->db->real_escape_string($username);
        $password = $this->db->real_escape_string($password);
         $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $this->db->query($query);

       
        if ($result && $result->num_rows > 0) {
            return true; 
        } else {
            return false; 
        }
    }
}
?>
