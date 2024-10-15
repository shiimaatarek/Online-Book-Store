<?php
function getUsers($conn) {
    $sql = "SELECT * FROM user";  // SQL query to fetch data from the user table
    $result = $conn->query($sql);

    $users = array();  
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {  
            $users[] = $row;  
        }
    }

    return $users;  
}
?>
