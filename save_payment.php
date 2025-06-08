<?php
// Allow CORS for testing; remove in production
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid data']);
    exit;
}

$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$phone = $data['phone'] ?? '';
$amount = $data['amount'] ?? 0;
$payment_id = $data['razorpay_payment_id'] ?? '';
$payment_date = $data['payment_date'] ?? '';

if (!$name || !$email || !$phone || !$amount || !$payment_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing fields']);
    exit;
}

// Connect to DB - update credentials!
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "E_COMM";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO payments (name, email, phone, amount, payment_id, payment_date) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiss", $name, $email, $phone, $amount, $payment_id, $payment_date);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Database insert failed']);
}

$stmt->close();
$conn->close();
?>
