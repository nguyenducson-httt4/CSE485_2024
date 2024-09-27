<?php
require_once '../services/DatabaseService.php';

class Author {
    private $conn;

    public function __construct() {
        $this->conn = getDatabaseConnection();
    }


    public static function getAll() {
        $conn = getDatabaseConnection();
        $sql = "SELECT ma_tgia, ten_tgia FROM tacgia";
        $result = $conn->query($sql);
        $authors = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $authors[] = $row;
            }
        }
        $conn->close();
        return $authors;
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM tacgia WHERE ma_tgia = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Trả về tác giả
        }
        
        return null; // Trường hợp không tìm thấy
    }


   

    public function deleteAuthor($catId) {
        $stmt = $this->conn->prepare("DELETE FROM tacgia WHERE ma_tgia = ?");
        $stmt->bind_param("i", $catId);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
}
?>
