<?php
    require 'vendor/autoload.php';
    use AfricasTalking\SDK\AfricasTalking;
    
    // Set your app credentials
    $username   = "brian24";
    $apiKey     = "a85ceb7cdb74e70541fd125a9fdb4ecf906e0b780da51f6808ccc63eb371adec";
    
    // Initialize the SDK
    $AT = new AfricasTalking($username, $apiKey);
    // Get the SMS service
    $sms = $AT->sms();
?>