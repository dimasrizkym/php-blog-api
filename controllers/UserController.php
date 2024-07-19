<?php
require_once 'config/Database.php';
require_once 'models/User.php';

class UserController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    // Create user
    public function create($data) {
        $this->user->username = $data['username'];
        $this->user->password = password_hash($data['password'], PASSWORD_DEFAULT);

        if ($this->user->create()) {
            echo json_encode(["message" => "User was created."]);
        } else {
            echo json_encode(["message" => "Unable to create user."]);
        }
    }

    // Read users
    public function read() {
        $stmt = $this->user->read();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
    }

    // Read user by ID
    public function readById($id) {
        $this->user->id_user = $id;
        $stmt = $this->user->readById();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($user);
    }

    // Update user
    public function update($data) {
        $this->user->id_user = $data['id_user'];
        $this->user->username = $data['username'];
        $this->user->password = password_hash($data['password'], PASSWORD_DEFAULT);

        if ($this->user->update()) {
            echo json_encode(["message" => "User was updated."]);
        } else {
            echo json_encode(["message" => "Unable to update user."]);
        }
    }

    // Delete user
    public function delete($id) {
        $this->user->id_user = $id;

        if ($this->user->delete()) {
            echo json_encode(["message" => "User was deleted."]);
        } else {
            echo json_encode(["message" => "Unable to delete user."]);
        }
    }
}
?>
