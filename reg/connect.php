<?php
$username = $_POST['username'];
$nic = $_POST['nic'];
$address = $_POST['address'];
$mobileno = $_POST['mobileno'];
$course = $_POST['course'];

$conn = new mysqli('dinusha-niwan.github.io', 'root', '', 'webproject');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Prepare statement with placeholders
    $stmt = $conn->prepare("INSERT INTO registration (username, nic, address, mobileno, course) VALUES (?, ?, ?, ?, ?)");
    
    // Check if prepare() failed
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssis", $username, $nic, $address, $mobileno, $course);

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
}
?>
