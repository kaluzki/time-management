<?php

$input = htmlspecialchars($_REQUEST['data'] ?? "");

echo <<<HTML
<!doctype html>
<html lang = "en">
<head>
    <meta charset="UTF-8">
    <title>Time-Management</title>
</head>
<body style= "display: grid; place-items: center; margin-top: 100px">
    <section>
        <form method="post">
            <label for="data">Time input</label>
            <br>
            <textarea name="data" cols="130" rows="40" placeholder="Paste your time table here..."></textarea>
            <button type="submit" value="submit">Submit text</button>
        </form>
    </section>
</body>
$input
HTML;
