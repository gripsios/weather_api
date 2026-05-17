<?php
require_once __DIR__ . '/config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// Έλεγχος παραμέτρου
if (empty($_GET['city'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Παρακαλώ δώσε όνομα πόλης.']);
    exit;
}

$city    = urlencode(trim($_GET['city']));
$apiKey  = API_KEY;
$units   = 'metric';
$lang    = 'el';
$baseUrl = 'https://api.openweathermap.org/data/2.5';

// Κλήση για τρέχοντα καιρό
$curUrl  = "{$baseUrl}/weather?q={$city}&appid={$apiKey}&units={$units}&lang={$lang}";
$curJson = file_get_contents($curUrl);

if ($curJson === false) {
    http_response_code(502);
    echo json_encode(['error' => 'Δεν ήταν δυνατή η σύνδεση με το OpenWeatherMap.']);
    exit;
}

$cur = json_decode($curJson, true);

if (isset($cur['cod']) && $cur['cod'] !== 200) {
    http_response_code((int)$cur['cod']);
    echo json_encode(['error' => $cur['message'] ?? 'Άγνωστο σφάλμα.']);
    exit;
}

// Κλήση για 5ήμερη πρόγνωση
$foreUrl  = "{$baseUrl}/forecast?q={$city}&appid={$apiKey}&units={$units}&lang={$lang}";
$foreJson = file_get_contents($foreUrl);
$fore     = json_decode($foreJson, true);

// Ομαδοποίηση πρόγνωσης ανά μέρα
$daily = [];
if (!empty($fore['list'])) {
    foreach ($fore['list'] as $item) {
        $day = substr($item['dt_txt'], 0, 10);
        if (!isset($daily[$day])) {
            $daily[$day] = ['temps' => [], 'icons' => []];
        }
        $daily[$day]['temps'][] = $item['main']['temp'];
        $daily[$day]['icons'][] = $item['weather'][0]['icon'];
    }
}

// Κρατάμε μόνο 5 μέρες
$forecast = [];
foreach (array_slice($daily, 0, 5, true) as $date => $data) {
    $midIcon = $data['icons'][intdiv(count($data['icons']), 2)];
    $forecast[] = [
        'date'  => $date,
        'max'   => round(max($data['temps'])),
        'min'   => round(min($data['temps'])),
        'icon'  => $midIcon,
    ];
}

// Επιστροφή αποτελέσματος
echo json_encode([
    'city'        => $cur['name'],
    'country'     => $cur['sys']['country'],
    'temp'        => round($cur['main']['temp']),
    'feels_like'  => round($cur['main']['feels_like']),
    'humidity'    => $cur['main']['humidity'],
    'wind_kmh'    => round($cur['wind']['speed'] * 3.6),
    'description' => $cur['weather'][0]['description'],
    'icon'        => $cur['weather'][0]['icon'],
    'forecast'    => $forecast,
], JSON_UNESCAPED_UNICODE);