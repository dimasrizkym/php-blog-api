<?php
class User {
    private $conn;
    private $table_name = 'user';

    public $id_user;
    public $username;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create user
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->password=htmlspecialchars(strip_tags($this->password));

        // Bind values
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Read users
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read Users By ID
    public function readById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_user = :id_user";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_user", $this->id_user);
        $stmt->execute();
        return $stmt;
    }

    // Update user
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET username = :username, password = :password WHERE id_user = :id_user";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->id_user=htmlspecialchars(strip_tags($this->id_user));

        // Bind values
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":id_user", $this->id_user);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete user
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_user = :id_user";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->id_user=htmlspecialchars(strip_tags($this->id_user));

        // Bind value
        $stmt->bindParam(":id_user", $this->id_user);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
