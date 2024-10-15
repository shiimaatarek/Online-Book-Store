<?php
function userExists($conn, $field, $value) {
    $sql = "SELECT * FROM user WHERE $field = ?";  
    $stmt = $conn->prepare($sql); 
    
    if ($stmt === false) {
        throw new Exception("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param('s', $value); 
    $stmt->execute();

    $result = $stmt->get_result();  
    
    return $result->num_rows > 0;  
}
?>
