<?php
require 'src\getUsers.php';  
use PHPUnit\Framework\TestCase;

class GetUsersTest extends TestCase {
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

   
    public function testGetUsers() {
        $users = getUsers($this->conn);  

        
        $this->assertNotEmpty($users);

       
        $this->assertIsArray($users);

        
        foreach ($users as $user) {
            $this->assertArrayHasKey('username', $user);
            $this->assertArrayHasKey('f_name', $user);
            $this->assertArrayHasKey('l_name', $user);
        }
    }

   
    protected function tearDown(): void {
        if ($this->conn) {
            $this->conn->close(); 
        }
    }
}
