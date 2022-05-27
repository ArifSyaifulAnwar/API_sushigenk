<?php 
  class Product {
    // DB stuff
    private $conn;
    private $table = 'product';

    // Post Properties
    public $id;
    public $menu;
    
    public $stock;
    public $price;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table . ' ORDER BY Id';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM ' . $this->table . ' WHERE Id = ?';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->id = $row['id'];
          $this->menu = $row['menu'];
        
          $this->stock = $row['stock'];
          $this->price = $row['price'];
    }
    public function create() {
      // Create query
      $query = 'INSERT INTO ' . $this->table . ' SET id = :id, menu = :menu, stock = :stock, price = :price';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->menu = htmlspecialchars(strip_tags($this->menu));
      $this->stock = htmlspecialchars(strip_tags($this->stock));
      $this->price = htmlspecialchars(strip_tags($this->price));

      // Bind data
      $stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':menu', $this->menu);
      $stmt->bindParam(':stock', $this->stock);
      $stmt->bindParam(':price', $this->price);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
  }
// Perbarui Paket
    public function update() {
      // Create query
      $query = 'UPDATE ' . $this->table . '
                            SET menu = :menu, stock = :stock, price = :price
                            WHERE id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->menu = htmlspecialchars(strip_tags($this->menu));
      $this->stock = htmlspecialchars(strip_tags($this->stock));
      $this->price = htmlspecialchars(strip_tags($this->price));
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':menu', $this->menu);
      $stmt->bindParam(':stock', $this->stock);
      $stmt->bindParam(':price', $this->price);
      $stmt->bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Hapus Paket
    public function delete() {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    } 
  

}
