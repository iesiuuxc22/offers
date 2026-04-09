<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = isset($_POST["name"]) ? trim($_POST["name"]) : "";
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $message = isset($_POST["message"]) ? trim($_POST["message"]) : "";

    if ($name === "" || $message === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Bitte alle Felder korrekt ausfüllen.");
    }

    $file = __DIR__ . "/contcontcont.txt";
    $date = date("Y-m-d H:i:s");
    $ip = $_SERVER["REMOTE_ADDR"] ?? "unknown";

    $entry  = "Name: " . $name . PHP_EOL;
    $entry .= "Email: " . $email . PHP_EOL;
    $entry .= "IP: " . $ip . PHP_EOL;
    $entry .= "Date: " . $date . PHP_EOL;
    $entry .= "Message:" . PHP_EOL;
    $entry .= $message . PHP_EOL;
    $entry .= "-----------------------" . PHP_EOL;

    file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);

    header("Location: contact.html");
    exit;
}
?>