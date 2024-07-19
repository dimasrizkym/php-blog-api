<?php
require_once 'config/Database.php';
require_once 'models/News.php';

class NewsController {
    private $db;
    private $news;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->news = new News($this->db);
    }

    // Create news
    public function create($data) {
        $this->news->penulis = $data['penulis'];
        $this->news->tgl_posting = $data['tgl_posting'];
        $this->news->title = $data['title'];
        $this->news->text_berita = $data['text_berita'];
        $this->news->id_kategori = $data['id_kategori'];

        if ($this->news->create()) {
            echo json_encode(["message" => "News was created."]);
        } else {
            echo json_encode(["message" => "Unable to create news."]);
        }
    }

    // Read news
    public function read() {
        $stmt = $this->news->read();
        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($news);
    }

    // Read news by ID
    public function readById($id) {
        $this->news->id_news = $id;
        $stmt = $this->news->readById();
        $news = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($news);
    }

    // Update news
    public function update($data) {
        $this->news->id_news = $data['id_news'];
        $this->news->penulis = $data['penulis'];
        $this->news->tgl_posting = $data['tgl_posting'];
        $this->news->title = $data['title'];
        $this->news->text_berita = $data['text_berita'];
        $this->news->id_kategori = $data['id_kategori'];

        if ($this->news->update()) {
            echo json_encode(["message" => "News was updated."]);
        } else {
            echo json_encode(["message" => "Unable to update news."]);
        }
    }

    // Delete news
    public function delete($id) {
        $this->news->id_news = $id;

        if ($this->news->delete()) {
            echo json_encode(["message" => "News was deleted."]);
        } else {
            echo json_encode(["message" => "Unable to delete news."]);
        }
    }
}
?>
