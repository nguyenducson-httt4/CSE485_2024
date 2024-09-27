<?php
require_once '../services/DatabaseService.php';

class Article {
    private $conn;

    public function __construct() {
        $this->conn = getDatabaseConnection();
    }




    public function deleteArticle($id) {
        $stmt = $this->conn->prepare("DELETE FROM baiviet WHERE ma_bviet = ?");
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public static function getAll() {
        $conn = getDatabaseConnection();
        $sql = "SELECT 
                    bv.ma_bviet,
                    bv.tieude,
                    bv.tomtat,
                    bv.ngayviet,
                    tg.ten_tgia,
                    tl.ten_tloai 
                FROM 
                    baiviet bv
                JOIN 
                    tacgia tg ON bv.ma_tgia = tg.ma_tgia
                JOIN 
                    theloai tl ON bv.ma_tloai = tl.ma_tloai
                ORDER BY bv.ma_bviet ASC;";
                
        $result = $conn->query($sql);
        $articles = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $articles[] = $row;
            }
        }
        return $articles;
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT tieude, tomtat FROM baiviet WHERE ma_bviet = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $article = $result->fetch_assoc();
        $stmt->close();
        return $article;
    }

}
?>
