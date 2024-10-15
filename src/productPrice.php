<?php
function updateProductPrice($conn, $product_id, $new_price) {
    $sql = "UPDATE products SET product_price = ? WHERE product_id = ?";  // SQL query to update the product price
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("di", $new_price, $product_id);  // Bind parameters for price and product ID
    return $stmt->execute();  // Return whether the update was successful
}
?>
