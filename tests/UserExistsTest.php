<?php
require_once 'src/userExists.php';  
use PHPUnit\Framework\TestCase;

class UserExistsTest extends TestCase {
    private $conn;

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

    public function testUserExists() {
       
        $this->assertTrue(
            userExists($this->conn, 'username', 'tsara8074@gmail.com'),  
            "User 'tsara8074@gmail.com' should exist"  
        );

        
        $this->assertFalse(
            userExists($this->conn, 'username', 'nonexistent@example.com'),  
            "User 'nonexistent@example.com' should not exist"
        );
    }

    protected function tearDown(): void {
        if ($this->conn) {
            $this->conn->close();  
        }
    }
}
?>
