<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once '../vendor/autoload.php';

// Find your Account SID and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure

// Load environment variables from .env, or environment if available
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$roomName = null;

if (isset($_GET['roomName'])) {
    $roomName = $_GET['roomName'];
}

$twilio = new Twilio\Rest\Client($_ENV['TWILIO_API_KEY'], $_ENV['TWILIO_API_SECRET'], $_ENV['TWILIO_ACCOUNT_SID']);

$room = $twilio->video->v1->rooms
    ->create(["uniqueName" => $roomName]);

header('Content-type:application/json;charset=utf-8');
echo json_encode(array(
    'room' => $room->toArray()
));