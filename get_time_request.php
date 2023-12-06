<?php
function timeElapsedString($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diffString = [
        'y' => 'year',
        'm' => 'month',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    ];

    foreach ($diffString as $key => &$value) {
        if ($diff->$key) {
            $value = $diff->$key . ' ' . ($diff->$key > 1 ? $value . 's' : $value);
        } else {
            unset($diffString[$key]);
        }
    }

    if (!$full) {
        $diffString = array_slice($diffString, 0, 1);
    }

    return $diffString ? implode(', ', $diffString) . ' ago' : 'just now';
}

// Example usage:
$timestamp = '2023-12-12 14:30:00'; // Replace this with the timestamp from your database
echo timeElapsedString($timestamp);


// Example usage:
$datetime = '2023-12-12 14:30:00'; // Replace this with the timestamp from your database
echo timeElapsedString($timestamp);
?>
