<?php
$servername = "localhost"; // Replace with the actual server name if not localhost
$user = "id22332642_root"; // Replace with your actual database username
$password = "Kariya_000"; // Replace with your actual database password
$dbname = "id22332642_register"; // Replace with your actual database name

// Get POST data and sanitize it
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$nic = isset($_POST['nic']) ? trim($_POST['nic']) : '';
$address = isset($_POST['address']) ? trim($_POST['address']) : '';
$mobileno = isset($_POST['mobileno']) ? trim($_POST['mobileno']) : '';
$course = isset($_POST['course']) ? trim($_POST['course']) : '';
$user_password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Check if any required field is empty
if(empty($username) || empty($nic) || empty($address) || empty($mobileno) || empty($course) || empty($user_password)) {
    die('All fields are required.');
}

// Validate the mobile number if necessary (example: check if it's numeric)
if (!is_numeric($mobileno)) {
    die('Invalid mobile number.');
}

// Create connection
$conn = new mysqli($servername, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare statement with placeholders
$stmt = $conn->prepare("INSERT INTO registration (username, nic, address, mobileno, course, password) VALUES (?, ?, ?, ?, ?, ?)");

// Check if prepare() failed
if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}

// Bind parameters
$stmt->bind_param("ssssss", $username, $nic, $address, $mobileno, $course, $user_password);

// Execute the statement
if ($stmt->execute()) {
    // Feedback to user
    echo "Registration Successful.";
} else {
    // Output error if execution fails
    echo "Execution failed: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
