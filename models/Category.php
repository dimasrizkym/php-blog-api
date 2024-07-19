<?php
class Category {
    private $conn;
    private $table_name = 'kategori';

    public $id_kategori;
    public $nama_kategori;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create category
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nama_kategori) VALUES (:nama_kategori)";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->nama_kategori=htmlspecialchars(strip_tags($this->nama_kategori));

        // Bind value
        $stmt->bindParam(":nama_kategori", $this->nama_kategori);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Read categories
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read category by ID
    public function readById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_kategori = :id_kategori";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_kategori", $this->id_kategori);
        $stmt->execute();
        return $stmt;
    }

    // Update category
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_kategori = :nama_kategori WHERE id_kategori = :id_kategori";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->nama_kategori=htmlspecialchars(strip_tags($this->nama_kategori));
        $this->id_kategori=htmlspecialchars(strip_tags($this->id_kategori));

        // Bind values
        $stmt->bindParam(":nama_kategori", $this->nama_kategori);
        $stmt->bindParam(":id_kategori", $this->id_kategori);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete category
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_kategori = :id_kategori";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->id_kategori=htmlspecialchars(strip_tags($this->id_kategori));

        // Bind value
        $stmt->bindParam(":id_kategori", $this->id_kategori);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
