<?php
include 'connect.php'; // Kết nối CSDL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form đăng nhập
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn để tìm user theo username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra nếu user tồn tại
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // So sánh mật khẩu đã được mã hóa
        if (password_verify($password, $user['password'])) {
            echo "<script>alert('Đăng nhập thành công!');</script>";
            // Chuyển hướng người dùng sau khi đăng nhập thành công, ví dụ:
            // header('Location: dashboard.php');
        } else {
            echo "<script>alert('Sai mật khẩu!');</script>";
        }
    } else {
        echo "<script>alert('Không tìm thấy người dùng!');</script>";
    }

    // Đóng kết nối
    $stmt->close();
}

$conn->close();
?>

<!-- Form đăng nhập -->
<form method="POST" action="login.php">
    <input type="text" name="username" placeholder="Tên đăng nhập" required>
    <input type="password" name="password" placeholder="Mật khẩu" required>
    <button type="submit">Đăng nhập</button>
</form>
