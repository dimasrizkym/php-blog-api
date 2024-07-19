<?php
require_once 'config/Database.php';
require_once 'models/Category.php';

class CategoryController {
    private $db;
    private $category;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->category = new Category($this->db);
    }

    // Create category
    public function create($data) {
        $this->category->nama_kategori = $data['nama_kategori'];

        if ($this->category->create()) {
            echo json_encode(["message" => "Category was created."]);
        } else {
            echo json_encode(["message" => "Unable to create category."]);
        }
    }

    // Read categories
    public function read() {
        $stmt = $this->category->read();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($categories);
    }

    // Read category by ID
    public function readById($id) {
        $this->category->id_kategori = $id;
        $stmt = $this->category->readById();
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($category);
    }

    // Update category
    public function update($data) {
        $this->category->id_kategori = $data['id_kategori'];
        $this->category->nama_kategori = $data['nama_kategori'];

        if ($this->category->update()) {
            echo json_encode(["message" => "Category was updated."]);
        } else {
            echo json_encode(["message" => "Unable to update category."]);
        }
    }

    // Delete category
    public function delete($id) {
        $this->category->id_kategori = $id;

        if ($this->category->delete()) {
            echo json_encode(["message" => "Category was deleted."]);
        } else {
            echo json_encode(["message" => "Unable to delete category."]);
        }
    }
}
?>
