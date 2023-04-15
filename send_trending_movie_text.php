<?php
// Include the Twilio PHP Helper Library
require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';
use Twilio\Rest\Client;

// Define the phone numbers you want to send the message to
$phone_numbers = array(
 
   
);

// Retrieve the movie list from the API
$movie_list_url = '';
$movie_list_json = file_get_contents($movie_list_url);
if (!$movie_list_json) {
    die("Failed to retrieve movie list from API");
}
$movie_list = json_decode($movie_list_json);
if (!$movie_list || !isset($movie_list->Movies)) {
    var_dump($movie_list_json); // Debugging line
    die("Failed to decode movie list JSON");
}

// Construct the message body with the movie list
$message_body = "Here is a list of trending movies:\n\n";
foreach ($movie_list->Movies as $movie) {
    $message_body .= "\u{1F7E2}\u{FE0F}Name:" . $movie->name . "\n";
    $message_body .= "Overview: " . $movie->overview . "\n\n";
}
$message_chunks = str_split($message_body, 1590);

// Set up the Twilio client
$sid    = "";
$token  = "";
$client = new Client($sid, $token);

// Send the message to each phone number in the array
foreach ($phone_numbers as $phone_number) {
    foreach ($message_chunks as $chunk) {
        $client->messages->create(
            // The number you'd like to send the message to
            $phone_number,
            [
                // A Twilio phone number you purchased at https://console.twilio.com
                'from' => "",
                // The body of the text message chunk
                'body' => $chunk
            ]
        );
    }
}
?>
