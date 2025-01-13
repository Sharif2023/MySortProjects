<?php
// Collect data
$name = $_POST['name'];
$email = $_POST['email'];
$age = $_POST['age'] ?? null; // Optional field
$user_role = $_POST['role'];
$user_recommend = $_POST['user-recommend'];
$most_like = $_POST['most-like'];
$prefer = isset($_POST['prefer']) ? implode(", ", $_POST['prefer']) : ''; // Convert array to string
$comment = $_POST['comment'] ?? '';

// Database connection
$conn = new mysqli('localhost', 'root', '', 'registration_form');

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO surveyform_freecodecamp 
    (name, email, age, role, user_recommend, most_like, prefer, comment) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Prepare Failed: " . $conn->error);
}

$stmt->bind_param("ssisssss", $name, $email, $age, $user_role, $user_recommend, $most_like, $prefer, $comment);

// Execute statement
if (!$stmt->execute()) {
    die("Execute Failed: " . $stmt->error);
} else {
    echo "Data Inserted Successfully!";
}

// Close connection
$stmt->close();
$conn->close();
?>
