<?php
function addUser($conn, $f_name, $l_name, $username, $email, $password, $mobile, $address, $city, $user_role) {
    $sql = "INSERT INTO user (f_name, l_name, username, email, password, mobile, address, city, user_role)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);  // Securely hash the password

    $stmt->bind_param('ssssssssi', $f_name, $l_name, $username, $email, $hashed_password, $mobile, $address, $city, $user_role);

    if (!$stmt->execute()) {
        throw new Exception("Failed to add user: " . $stmt->error);
    }

    return $stmt->insert_id;  // Return the ID of the newly added user
}
?>
