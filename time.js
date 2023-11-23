$(document).ready(function() {
    function updateClock() {
        // Use AJAX to call a PHP script that returns the current server time
        $.ajax({
            url: 'get_time.php',
            type: 'GET',
            success: function(response) {
                // Update the clock with the received time
                $('#clock').text(response);
            }
        });
    }

    // Update the clock every second
    setInterval(updateClock, 1000);
});
