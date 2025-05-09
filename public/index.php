<?php

$input = htmlspecialchars($_REQUEST['data'] ?? "");

$s = function (string $str, int $amount): string {
    return "$amount $str" . (abs($amount) !== 1 ? 's' : '');
};

function interval(string $matches): DateInterval|false
{
    [$startTimeStr, $endTimeStr] = explode('-', $matches);
    $startTime = DateTime::createFromFormat('H:i', $startTimeStr);
    $endTime = DateTime::createFromFormat('H:i', $endTimeStr);
    return $startTime->diff($endTime);
}

echo <<<HTML
<!doctype html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Time-Management</title>
    </head>
    <body style= "display: grid; place-items: center; margin-top: 100px">
        <section>
            <form method="post">
                <label for="data">Time input</label>
                <br>
                <textarea name="data" cols="35" rows="30" placeholder="Paste your time table here...">$input</textarea>
                <button type="submit" value="submit">Upload</button>
            </form>
        </section>
HTML;

$time = 0;
$input = explode("\n", $input);
foreach ($input as $line) {
    $line = trim($line);
    if ($line === '') {
        continue;
    }
    preg_match("/([0-9]?[0-9]):[0-5][0-9]-([0-9]?[0-9]):[0-5][0-9]/", $line, $matches);
    if ($matches) {
        $interval = interval($matches[0]);
        $minutes = ($interval->h * 60) + $interval->i;
        $time += $minutes;

        echo <<< HTML
        <p>
            $line - {$s('hour', $interval->h)} and {$s('minute', $interval->i)}
        </p>
        HTML;
    }
}
$hours = intval($time / 60);
$remMinutes = $time % 60;

echo <<< HTML
        <p>
            You have worked for {$s('hour', $hours)} and {$s('minute', $remMinutes)}.
        </p>
    </body>
</html>
HTML;
