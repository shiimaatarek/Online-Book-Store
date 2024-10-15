<?php
function addCategory($conn, $cat_title) {
    $sql = "INSERT INTO categories (cat_title) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cat_title);

    return $stmt->execute();  // Returns true if successful, false otherwise
}
?>
