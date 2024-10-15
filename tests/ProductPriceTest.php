<?php
require 'src/productPrice.php';  

use PHPUnit\Framework\TestCase;

class ProductPriceTest extends TestCase {
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

    public function testUpdateProductPrice() {
        $product_id = 4;  
        $new_price = 25.5;  

        
        $result = updateProductPrice($this->conn, $product_id, $new_price);

        
        $this->assertTrue($result);

      
        $sql = "SELECT product_price FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $product_id);  
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

       
        $this->assertEquals($new_price, $product['product_price']);
    }

    protected function tearDown(): void {
        if ($this->conn) {
           
            $original_price = 18.99;  // The original price
            $product_id = 4;
            $sql = "UPDATE products SET product_price = ? WHERE product_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("di", $original_price, $product_id);
            $stmt->execute();  

            $this->conn->close();  
        }
    }
}
