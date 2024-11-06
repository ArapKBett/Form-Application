<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form_application";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO form_submissions (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";

        // Send email notification
        $to = "your-email@example.com"; // Replace with your email address
        $subject = "New Form Submission";
        $body = "You have received a new form submission:\n\n";
        $body .= "Name: $name\n";
        $body .= "Email: $email\n";
        $body .= "Message: $message\n";

        $headers = "From: no-reply@example.com"; // Replace with a valid sender email address

        if (mail($to, $subject, $body, $headers)) {
            echo "Email notification sent.";
        } else {
            echo "Failed to send email notification.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
