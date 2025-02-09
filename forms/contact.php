<?php
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// تحقق مما إذا كان النموذج قد تم إرساله
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    $mail = new PHPMailer(true);

    try {
        // إعدادات SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // أو مزود البريد الخاص بك
        $mail->SMTPAuth   = true;
        $mail->Username   = 'aamr87489@gmail.com'; // بريدك الإلكتروني
        $mail->Password   = 'nijj ehai rkfa islt'; // استبدلها بـ "App Password" إذا كنت تستخدم Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // إعدادات البريد
        $mail->setFrom($email, $name);
        $mail->addAddress('aamr87489@gmail.com'); // استبدل ببريدك الذي ستستقبل عليه الرسائل
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "
            <h3>New Contact Form Message</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong> $message</p>
        ";

        // إرسال البريد
        if ($mail->send()) {
            echo "success"; // سيتم معالجتها في JavaScript
        } else {
            echo "Mail Error: " . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo "Mail Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid Request";
}
?>
