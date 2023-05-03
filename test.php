<?php
// Khởi tạo một session cURL
$ch = curl_init();

// Cấu hình URL và các tùy chọn
$url = "https://facebook.com";
$options = [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
];

// Thiết lập các tùy chọn cho session cURL
curl_setopt_array($ch, $options);

// Thực hiện yêu cầu GET và lấy dữ liệu
$response = curl_exec($ch);

// Kiểm tra mã trạng thái HTTP
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($httpCode === 200) {
    // Xử lý dữ liệu nhận được
    echo "Response: " . $response;
} else {
    // Xử lý lỗi
    echo "Error: " . curl_error($ch);
}

// Đóng session cURL
curl_close($ch);
?>
