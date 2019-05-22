<?php
error_reporting(E_ALL ^ E_DEPRECATED);
include 'PHPMailers/PHPMailerAutoload.php';

if (isset($_POST['submit'])) {
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;  // หากต้องการแสดงผลว่ามี error อะไรให้ใส่ 1 , 2 , 3 ตามต้องการ
    $mail->Debugoutput = 'html';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->CharSet = "UTF-8";
    $mail->Username = "samitkoyom@gmail.com";
    $mail->Password = "xxx";

    $mail->setFrom('samitkoyom@gmail.com', 'Samit Koyom');
    $mail->addAddress("samitkoyom@gmail.com", "Samit Koyom");

    $mail->Subject = "=?utf-8?B?" . base64_encode("แจ้งลิงก์เปลี่ยนรหัสผ่านจากระบบ stock") . "?=";
    $mail->msgHTML("ท่านสามารถคลิ๊กลิงก์ด้านล่าง เพื่อรีเซ็ตรหัสผ่านใหม่ได้");

    // Send email
    if ($mail->send()) {
        echo 'Message has been sent';
    } else {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send Mail</title>
</head>

<body>
    <h1>Test Send Mail wit PHPMailer</h1>
    <form action="sendmail_phpmailer.php" method="post">
        <input type="submit" value="submit" name="submit">
    </form>
</body>

</html>