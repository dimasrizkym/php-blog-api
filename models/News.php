<?php
class News {
    private $conn;
    private $table_name = 'news';

    public $id_news;
    public $penulis;
    public $tgl_posting;
    public $title;
    public $text_berita;
    public $id_kategori;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create news
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (penulis, tgl_posting, title, text_berita, id_kategori) VALUES (:penulis, :tgl_posting, :title, :text_berita, :id_kategori)";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->penulis=htmlspecialchars(strip_tags($this->penulis));
        $this->tgl_posting=htmlspecialchars(strip_tags($this->tgl_posting));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->text_berita=htmlspecialchars(strip_tags($this->text_berita));
        $this->id_kategori=htmlspecialchars(strip_tags($this->id_kategori));

        // Bind values
        $stmt->bindParam(":penulis", $this->penulis);
        $stmt->bindParam(":tgl_posting", $this->tgl_posting);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":text_berita", $this->text_berita);
        $stmt->bindParam(":id_kategori", $this->id_kategori);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Read news
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read news by ID
    public function readById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_news = :id_news";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_news", $this->id_news);
        $stmt->execute();
        return $stmt;
    }

    // Update news
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET penulis = :penulis, tgl_posting = :tgl_posting, title = :title, text_berita = :text_berita, id_kategori = :id_kategori WHERE id_news = :id_news";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->penulis=htmlspecialchars(strip_tags($this->penulis));
        $this->tgl_posting=htmlspecialchars(strip_tags($this->tgl_posting));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->text_berita=htmlspecialchars(strip_tags($this->text_berita));
        $this->id_kategori=htmlspecialchars(strip_tags($this->id_kategori));
        $this->id_news=htmlspecialchars(strip_tags($this->id_news));

        // Bind values
        $stmt->bindParam(":penulis", $this->penulis);
        $stmt->bindParam(":tgl_posting", $this->tgl_posting);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":text_berita", $this->text_berita);
        $stmt->bindParam(":id_kategori", $this->id_kategori);
        $stmt->bindParam(":id_news", $this->id_news);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete news
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_news = :id_news";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->id_news=htmlspecialchars(strip_tags($this->id_news));

        // Bind value
        $stmt->bindParam(":id_news", $this->id_news);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
