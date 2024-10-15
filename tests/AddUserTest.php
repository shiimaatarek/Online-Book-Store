<?php
require 'src/addUser.php';  
use PHPUnit\Framework\TestCase;

class AddUserTest extends TestCase {
    private $conn;
    private $new_user_id;  

    protected function setUp(): void {
        $servername = "localhost";
        $username = "root";
        $password = "";  
        $dbname = "shbs";

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function testAddUser() {
        // Data for the new user
        $f_name = 'John';
        $l_name = 'Doe';
        $username = 'johndoe123';
        $email = 'johndoe@example.com';
        $password = 'password123';
        $mobile = '0123456789';
        $address = '123 Test Street';
        $city = 'Test City';
        $user_role = 1;

        // Try to add the user
        $this->new_user_id = addUser(
            $this->conn, 
            $f_name, 
            $l_name, 
            $username, 
            $email, 
            $password, 
            $mobile, 
            $address, 
            $city, 
            $user_role
        );

        $this->assertIsInt($this->new_user_id);  // Ensure we got a valid user ID
    }

    protected function tearDown(): void {
        if ($this->new_user_id) {
            // Clean up by removing the user
            $sql = "DELETE FROM user WHERE user_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('i', $this->new_user_id);

            if (!$stmt->execute()) {
                throw new Exception("Failed to delete user: " . $stmt->error);
            }
        }

        if ($this->conn) {
            $this->conn->close();
        }
    }
}
