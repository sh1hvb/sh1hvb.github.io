<?php

// Put your contacting email here
$php_main_email = "medchihab651@protonmail.com";

// Fetching Values from POST request
$php_name = htmlspecialchars($_POST['name']);
$php_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$php_message = htmlspecialchars($_POST['message']);

// Validate other fields
if (empty($php_name) || empty($php_message)) {
    echo "<span class='contact_error'>* Please fill in all required fields *</span>";
    exit; // Stop further execution
}

// Validate email
if (!filter_var($php_email, FILTER_VALIDATE_EMAIL)) {
    echo "<span class='contact_error'>* Invalid email address *</span>";
    exit; // Stop further execution
}

$php_subject = "Message from contact form";
$php_headers = 'MIME-Version: 1.0' . "\r\n";
$php_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$php_headers .= 'From: ' . $php_email . "\r\n";
$php_headers .= 'Cc: ' . $php_email . "\r\n";

$php_template = '<div action="" style="padding:50px;">Hello ' . $php_name . ',<br/>'
    . 'Thank you for contacting us.<br/><br/>'
    . '<strong style="color:#f00a77;">Name:</strong>  ' . $php_name . '<br/>'
    . '<strong style="color:#f00a77;">Email:</strong>  ' . $php_email . '<br/>'
    . '<strong style="color:#f00a77;">Message:</strong>  ' . $php_message . '<br/><br/>'
    . 'This is a Contact Confirmation mail.'
    . '<br/>'
    . 'We will contact you as soon as possible.</div>';

$php_sendmessage = "<div style=\"background-color:#f5f5f5; color:#333;\">" . $php_template . "</div>";

// Send mail using PHPMailer or Swift Mailer for better security
// Example using PHPMailer:
// require 'PHPMailer/PHPMailerAutoload.php';
// $mail = new PHPMailer;
// $mail->setFrom($php_email);
// $mail->addAddress($php_main_email);
// $mail->Subject = $php_subject;
// $mail->msgHTML($php_sendmessage);
// if(!$mail->send()) {
//     echo 'Message could not be sent.';
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
//     echo "<span class='contact_success'>Your message has been sent successfully</span>";
// }

// For demonstration purpose, using mail() function
if (mail($php_main_email, $php_subject, $php_sendmessage, $php_headers)) {
    echo "<span class='contact_success'>Your message has been sent successfully</span>";
    // Redirect to index page after successful submission
    header("Location: ../index.html"); // Change index.php to your actual index page URL
    exit;
} else {
    echo "<span class='contact_error'>* Failed to send message. Please try again later *</span>";
}
?>
