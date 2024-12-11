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

    // Lấy thông tin sinh viên
    $sql = "SELECT * FROM table_Students WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
    } else {
        die("Không tìm thấy sinh viên.");
    }
} else {
    die("ID không hợp lệ.");
}

// Cập nhật thông tin sinh viên
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hometown = $_POST['hometown'];
    $education_level = $_POST['education_level'];
    $groups = $_POST['groups'];

    $update_sql = "UPDATE table_Students SET fullname='$fullname', dob='$dob', gender=$gender, hometown='$hometown', level=$education_level, groups='$groups' WHERE id=$id";

    if (mysqli_query($conn, $update_sql)) {
        echo "Cập nhật thành công!";
        header("Location: indexx.php"); // Quay lại danh sách sinh viên
        exit;
    } else {
        echo "Cập nhật thất bại: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sinh viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9; /* Màu nền nhẹ */
            color: #333; /* Màu chữ */
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #2C3E50; /* Màu xanh nổi bật */
            font-size: 38px; /* Kích thước chữ */

        }

        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff; /* Màu nền form */
            border: 1px solid #ddd; /* Viền */
            border-radius: 8px; /* Bo góc */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng */
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50; /* Màu xanh */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049; /* Hiệu ứng hover */
        }

        a {
            text-decoration: none;
            color: #555;
            margin-left: 10px;
        }

        a:hover {
            color: #000;
        }
    </style>
</head>
<body>
    <h1>Chỉnh sửa thông tin sinh viên</h1>
    <form method="POST">
        <label>Họ và tên:</label>
        <input type="text" name="fullname" value="<?= $student['fullname'] ?>" required><br>

        <label>Ngày sinh:</label>
        <input type="date" name="dob" value="<?= $student['dob'] ?>" required><br>

        <label>Giới tính:</label>
        <select name="gender">
            <option value="1" <?= $student['gender'] == 1 ? 'selected' : '' ?>>Nam</option>
            <option value="0" <?= $student['gender'] == 0 ? 'selected' : '' ?>>Nữ</option>
        </select><br>

        <label>Quê quán:</label>
        <input type="text" name="hometown" value="<?= $student['hometown'] ?>" required><br>

        <label>Trình độ học vấn:</label>
        <select name="education_level">
            <option value="1" <?= isset($student['education_level']) && $student['education_level'] == 1 ? 'selected' : '' ?>>Tiến sĩ</option>
            <option value="2" <?= isset($student['education_level']) && $student['education_level'] == 2 ? 'selected' : '' ?>>Thạc sĩ</option>
            <option value="3" <?= isset($student['education_level']) && $student['education_level'] == 3 ? 'selected' : '' ?>>Kỹ sư</option>
            <option value="4" <?= isset($student['education_level']) && $student['education_level'] == 4 ? 'selected' : '' ?>>Khác</option>
        </select><br>

        <label>ID nhóm:</label>
        <input type="text" name="groups" value="<?= $student['groups'] ?>" required><br>

        <button type="submit">Lưu thay đổi</button>
        <a href="indexx.php">Hủy</a>
    </form>
</body>
</html>
