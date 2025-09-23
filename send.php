<?php
header('Content-Type: application/json; charset=utf-8');

$to = "alexey.kuliw@gmail.com";
$subject = "Нова заявка з сайту";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = isset($_POST["name"]) ? strip_tags(trim($_POST["name"])) : "";
    $contact = isset($_POST["contact"]) ? strip_tags(trim($_POST["contact"])) : "";
    $message = isset($_POST["message"]) ? strip_tags(trim($_POST["message"])) : "";

    if (empty($name) || empty($contact) || empty($message)) {
        echo json_encode([
            "success" => false,
            "message" => "Будь ласка, заповніть усі обов’язкові поля."
        ]);
        exit;
    }

    $body  = "Ім’я: $name\n";
    $body .= "Контакт: $contact\n\n";
    $body .= "Повідомлення:\n$message\n";

    $headers = "From: $name <$contact>\r\n";
    $headers .= "Reply-To: $contact\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode([
            "success" => true,
            "message" => "Ваша заявка успішно надіслана!"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Сталася помилка під час відправки. Спробуйте ще раз."
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Некоректний метод відправки форми."
    ]);
}