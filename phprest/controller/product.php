<?php
class Product {
    private $conn;  
    private $table = 'products';
    public $id;
    public $item;
    public $price;
    public $quantity;
    public $create_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->item = $row['item'];
            $this->price = $row['price'];
            $this->quantity = $row['quantity'];
            $this->create_at = $row['create_at'];
        }
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (item, price, quantity, create_at) VALUES (:item, :price, :quantity, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':item', $this->item);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':quantity', $this->quantity);
        
        if ($stmt->execute()) {
            return true;
        }
        error_log("Error in create: " . $stmt->errorInfo()[2]);
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET item = :item, price = :price, quantity = :quantity WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':item', $this->item);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':id', $this->id);
        
        if ($stmt->execute()) {
            return true;
        }
        error_log("Error in update: " . $stmt->errorInfo()[2]);
        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            return true;
        }
        error_log("Error in delete: " . $stmt->errorInfo()[2]);
        return false;
    }
}
?>