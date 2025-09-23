<?php

$to = "alexey.kuliw@gmail.com";

$subject = "Новая заявка с сайта";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = isset($_POST["name"]) ? strip_tags(trim($_POST["name"])) : "";
    $email   = isset($_POST["contact"]) ? strip_tags(trim($_POST["email"])) : "";
    $message = isset($_POST["message"]) ? strip_tags(trim($_POST["message"])) : "";

    $body = "Имя: $name\n";
    $body .= "Email: $email\n\n";
    $body .= "Сообщение:\n$message\n";

    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "Сообщение успешно отправлено!";
    } else {
        echo "Ошибка при отправке сообщения.";
    }
} else {
    echo "Некорректный метод отправки формы.";
}
