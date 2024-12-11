<?php
// Kết nối đến cơ sở dữ liệu
$hostname = "localhost";
$username = "root";
$password = "";
$database = "qlsv_nguyenvanloi";

// Kết nối tới cơ sở dữ liệu
$conn = mysqli_connect($hostname, $username, $password, $database);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $hometown = mysqli_real_escape_string($conn, $_POST['hometown']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);
    
    // Kiểm tra xem trường 'groups' có tồn tại và có giá trị hợp lệ
    if (isset($_POST['groups'])) {
        $groups = mysqli_real_escape_string($conn, $_POST['groups']);
    } else {
        $groups = ''; // Nếu không có giá trị, gán mặc định là rỗng
    }

    // Kiểm tra nếu dữ liệu hợp lệ
    if (empty($fullname) || empty($dob) || empty($gender) || empty($hometown) || empty($level) || empty($groups)) {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
    } else {
        // Câu lệnh SQL để thêm sinh viên vào bảng (loại bỏ 'id' vì nó tự động tăng)
        $sql = "INSERT INTO table_Students (fullname, dob, gender, hometown, level, groups)
        VALUES ('$fullname', '$dob', '$gender', '$hometown', '$level', '$groups')";
        // Thực thi câu lệnh SQL
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Sinh viên đã được thêm thành công.'); window.location.href = 'indexx.php';</script>";
            header("Location: indexx.php"); // Quay lại danh sách sinh viên

        } else {
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

// Đóng kết nối
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <style>
        body {
             font-family: 'Roboto', Arial, sans-serif;
             background-color: #F4F6F9;  /* Màu nền sáng xám nhạt */
            color: #333; /* Màu chữ tối, dễ đọc */
            margin: 0;
            padding: 0;
}
        .container {
            width: 40%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            font-size: 38px; /* Kích thước chữ */
            color: #2C3E50; /* Màu chữ đậm, dễ đọc */
            margin-top: 20px;
}

        form {
            display: grid;
            gap: 15px;
            color: #2C3E50; /* Màu chữ đậm, dễ đọc */

        }
        label {
            font-size: 16px;
            font-weight: bold;
        }
        input[type="text"], input[type="date"], input[type="number"], select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        a{            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thêm Sinh Viên Mới</h1>
        <form method="POST" action="add_student.php">
            <div class="form-group">
                <label for="fullname">Họ và tên:</label>
                <input type="text" name="fullname" id="fullname" required>
            </div>
            <div class="form-group">
                <label for="dob">Ngày sinh:</label>
                <input type="date" name="dob" id="dob" required>
            </div>
            <div class="form-group">
                <label for="gender">Giới tính:</label>
                <select name="gender" id="gender" required>
                    <option value=""></option>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="hometown">Quê quán:</label>
                <input type="text" name="hometown" id="hometown" required>
            </div>
            <div class="form-group">
                <label for="level">Trình độ học vấn:</label>
                <select name="level" id="level" required>
                    <option value=""></option>
                    <option value="Tiến sĩ">Tiến sĩ</option>
                    <option value="Thạc sĩ">Thạc sĩ</option>
                    <option value="Kĩ sư">Kĩ sư</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>
            <div class="form-group">
                <label for="groups">Nhóm:</label>
                <input type="number" name="groups" id="groups" required>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="submit">Thêm Sinh Viên</button>
                <a href="indexx.php">Hủy</a>

            </div>
        </form>
    </div>
</body>
</html>
