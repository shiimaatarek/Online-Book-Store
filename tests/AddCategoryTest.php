<?php

require 'src/addCategory.php'; 

use PHPUnit\Framework\TestCase;

class AddCategoryTest extends TestCase {
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
    
    public function testAddCategory() {
       
        $newCategoryTitle = "Test Category";

        // Call the function
        $result = addCategory($this->conn, $newCategoryTitle);

        // Check if the insertion was successful
        $this->assertTrue($result);

        // Now let's check if the new category exists in the database
        $sql = "SELECT * FROM categories WHERE cat_title = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $newCategoryTitle);
        $stmt->execute();
        $result = $stmt->get_result();

        $this->assertGreaterThan(0, $result->num_rows);  
    }

    protected function tearDown(): void {
        if ($this->conn) {
            // Cleanup - delete the test category after the test
            $sql = "DELETE FROM categories WHERE cat_title = 'Test Category'";
            $this->conn->query($sql);

            $this->conn->close();  
        }
    }
}
?>
