<?php

$textArea = <<<HTML
<!doctype html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <title>Time-Management</title>
</head>
<body style= "display: grid; place-items: center;" marginheight = "100vp">
    <label for = "Time imput">Time imput</label>
    <textarea name = "Time imput" id = "Time imput" cols = "130" rows = "40" placeholder = "Paste your time table here..."></textarea>
</body>
HTML;
echo $textArea;
