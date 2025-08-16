<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $subjects = $_POST["subject"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Basic validation
    if (empty($subjects) || empty($email) || empty($message)) {
        echo "Please fill in all the fields.";
    } else {
        // Create the email content
        $subject = "New Contact Form Submission";
        $to = "augustaasemotaoghogho@gmail.com"; // Replace with your email address

        $headers = "From: $email" . "\r\n" .
                   "Reply-To: $email" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        $emailContent = "Name: $subjects\n";
        $emailContent .= "Email: $email\n";
        $emailContent .= "Message:\n$message";

        // Send email
        if (mail($to, $subject, $emailContent, $headers)) {
            echo "Thank you for your message. We will get back to you soon.";
        } else {
            echo "Error sending the email. Please try again later.";
        }
    }
} else {
    echo "Invalid request.";
}
?>
