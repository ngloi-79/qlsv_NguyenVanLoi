<?php
// Kết nối cơ sở dữ liệu
$hostname = "localhost";
$username = "root";
$password = "";
$database = "qlsv_nguyenvanloi";

$conn = mysqli_connect($hostname, $username, $password, $database);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy ID sinh viên từ URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Xóa sinh viên
    $sql = "DELETE FROM table_Students WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Xóa thành công!";
        header("Location: indexx.php"); // Quay lại danh sách sinh viên
        exit;
    } else {
        echo "Xóa thất bại: " . mysqli_error($conn);
    }
} else {
    die("ID không hợp lệ.");
}
?>


