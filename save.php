<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $consent = isset($_POST["consent"]) ? "yes" : "no";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Ungültige E-Mail-Adresse.");
    }

    if ($consent !== "yes") {
        die("Zustimmung ist erforderlich.");
    }

    $file = __DIR__ . "/collcollcoll.txt";
    $date = date("Y-m-d H:i:s");
    $ip = $_SERVER["REMOTE_ADDR"] ?? "unknown";

    $line = $email . " | consent:" . $consent . " | ip:" . $ip . " | date:" . $date . PHP_EOL;
    file_put_contents($file, $line, FILE_APPEND | LOCK_EX);

    header("Location: index.html");
    exit;
}
?>