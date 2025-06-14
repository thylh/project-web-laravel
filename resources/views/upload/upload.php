<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $uploadDir = 'uploads/';

    // Tạo thư mục nếu chưa tồn tại
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $originalName = $_FILES['file']['name']; // tên gốc người dùng tải lên
    $tmpName = $_FILES['file']['tmp_name'];  // đường dẫn tạm thời
    $fileSize = $_FILES['file']['size'];     // kích thước byte

    // Tạo tên file an toàn (tránh trùng lặp)
    $safeName = time() . '_' . basename($originalName);
    $targetPath = $uploadDir . $safeName;

    // Di chuyển file
    if (move_uploaded_file($tmpName, $targetPath)) {
        // Chuyển đến bước 2 với thông tin tên file, tên gốc, dung lượng
        header("Location: B2.php?filename=" . urlencode($safeName) . 
            "&original=" . urlencode($originalName) . 
            "&size=" . $fileSize);
        exit();
    } else {
        echo "❌ Lỗi khi tải lên tập tin.";
    }
}
?>
