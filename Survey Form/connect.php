<?php
// Collect Data
$name = $_POST['name'];
$email = $_POST['email'];
$age = $_POST['age'];
$selectOccupation = $_POST['occupation'];
$radioAns = $_POST['radio_ans'];
$knownLanguage = $_POST['radio_lang'];
$additionalMessage = $_POST['additional_messages']; // Corrected name

// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration_form";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO survey_data (name, email, age, occupation, radio_ans, radio_lang, additional_messages) VALUES (?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ssissss", $name, $email, $age, $selectOccupation, $radioAns, $knownLanguage, $additionalMessage);

// Execute the statement
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
} else {
    echo "Data inserted successfully!";
}

// Close the connection
$stmt->close();
$conn->close();
?>
