<?php
// Kết nối tới cơ sở dữ liệu
$hostname = "localhost";
$username = "root";
$password = "";
$database = "qlsv_nguyenvanloi";

$conn = mysqli_connect($hostname, $username, $password, $database);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy từ khóa tìm kiếm nếu có
$search = "";
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
}

// Câu lệnh SQL để lấy danh sách sinh viên, có thể lọc theo tên hoặc quê quán
$sql = "SELECT * FROM table_Students WHERE fullname LIKE '%$search%' OR hometown LIKE '%$search%'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <style>
        /* Cài đặt font và màu nền chung cho trang */
body {
    font-family: 'Roboto', Arial, sans-serif;
    background-color: #F4F6F9;  /* Màu nền sáng xám nhạt */
    color: #333; /* Màu chữ tối, dễ đọc */
    margin: 0;
    padding: 0;
}

/* Tiêu đề trang */
h1 {
    text-align: center;
    font-size: 48px; /* Kích thước chữ */
    color: #2C3E50; /* Màu chữ đậm, dễ đọc */
    margin-top: 20px;
}

/* Khung chứa bảng */
table {
    width: 70%;
    margin: 30px auto;
    background-color: #ffffff; /* Nền trắng cho bảng */
    border-collapse: collapse;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Tạo bóng nhẹ cho bảng */
}

/* Định dạng cho các ô bảng */
table, th, td {
    border: 1px solid #ddd; /* Màu viền sáng */
}

th, td {
    padding: 12px;
    text-align: center;
}

th {
    background-color: #E5E8E8; /* Nền sáng cho tiêu đề bảng */
    color: #2C3E50; /* Màu chữ tiêu đề đậm */
}

td {
    background-color: #F9F9F9; /* Nền sáng cho các ô dữ liệu */
}

/* Tạo hiệu ứng hover cho các ô dữ liệu */
tr:hover {
    background-color: #F0F0F0; /* Nền sáng khi hover qua dòng */
}

/* Nút Thêm Sinh Viên */
.btn-add {
    padding: 10px 20px;
    background-color: #27AE60;  /* Màu xanh lá tươi sáng */
    color: white;
    font-size: 16px;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
    margin-bottom: 20px;    
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-add:hover {
    background-color: #2ECC71; /* Màu xanh lá đậm khi hover */
    transform: scale(1.05); /* Tăng kích thước nhẹ khi hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Tăng độ bóng khi hover */
}

.btn-add:active {
    background-color: #2D843B; /* Màu khi nhấn */
    transform: scale(1); /* Khôi phục kích thước ban đầu khi nhấn */
}

/* Nút Sửa và Xóa */
.btn {
    padding: 6px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.btn-edit {
    background-color: #FFA500; /* Màu vàng cam cho nút sửa */
    color: white;
}

.btn-edit:hover {
    background-color: #FF8C00; /* Đổi màu vàng đậm khi hover */
}

.btn-delete {
    background-color: #E74C3C; /* Màu đỏ cam cho nút xóa */
    color: white;
}

.btn-delete:hover {
    background-color: #C0392B; /* Đổi màu đỏ đậm khi hover */
}

/* Form tìm kiếm */
.search-bar {
    text-align: center;
    margin-bottom: 30px;
}

.search-bar input {
    padding: 10px;
    font-size: 16px;
    width: 450px;
    border-radius: 5px;
    border: 1px solid #ddd;
    background-color: #ffffff;
    color: #333;
}

.search-bar button {
    padding: 10px 15px;
    font-size: 16px;
    background-color: #3498db; /* Màu xanh dương cho nút tìm kiếm */
    color: white;
    border: none;
    text-align: center;
    border-radius: 5px;
    cursor: pointer;
}

.search-bar button:hover {
    background-color: #2980B9; /* Đổi màu khi hover */
}

.search-bar button:active {
    background-color: #1C6E8C; /* Đổi màu khi click */
}


    </style>
</head>
<body>
    <h1>Danh sách sinh viên</h1>
     <!--      <a href="add_student.php" class="btn-add">Thêm Sinh Viên</a>
Nút để đi qua trang thêm sinh viên -->
    <!-- Nút để đi qua trang thêm sinh viên -->
<a href="add_student.php" class="btn-add">Thêm Sinh Viên</a>

    <!-- Form tìm kiếm -->
    <div class="search-bar">
        <form method="POST">
            <input type="text" name="search" placeholder="Tìm kiếm theo tên hoặc quê quán..." value="<?php echo $search; ?>" class = "sss">
            <button type="submit">Tìm kiếm</button>
        </form>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>TT</th>
                <th>Họ Và Tên</th>
                <th>Ngày Sinh</th>
                <th>Giới Tính</th>
                <th>Quê Quán</th>
                <th>Trình Độ Học Vấn</th>
                <th>ID Nhóm</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Xác định giới tính
                    $gender = $row['gender'] == 1 ? "Nam" : "Nữ";

                    // Xác định trình độ học vấn
                    if (isset($row['level'])) {
                        switch ($row['level']) {
                            case 1:
                                $education = "Tiến sĩ";
                                break;
                            case 2:
                                $education = "Thạc sĩ";
                                break;
                            case 3:
                                $education = "Kĩ sư";
                                break;
                            default:
                                $education = "Khác";
                        }
                    } else {
                        $education = "Không xác định";
                    }

                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['fullname']}</td>
                        <td>{$row['dob']}</td>
                        <td>$gender</td>
                        <td>{$row['hometown']}</td>
                        <td>$education</td>
                        <td>{$row['groups']}</td>
                        <td>
                            <button class='btn btn-edit' onclick=\"editStudent({$row['id']})\">Sửa</button>
                            <button class='btn btn-delete' onclick=\"deleteStudent({$row['id']})\">Xóa</button>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Không có dữ liệu.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function editStudent(id) {
            window.location.href = `edit.php?id=${id}`;
        }

        function deleteStudent(id) {
            if (confirm("Bạn có chắc chắn muốn xóa sinh viên này?")) {
                window.location.href = `delete.php?id=${id}`;
            }
        }
    </script>
</body>
</html>

<?php
// Đóng kết nối
mysqli_close($conn);
?>
