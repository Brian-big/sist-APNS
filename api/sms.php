<?php
    require 'vendor/autoload.php';
    use AfricasTalking\SDK\AfricasTalking;
    
    // Set your app credentials
    $username   = "brian24";
    $apiKey     = "b0dbf4c2aaa732408a8917b9b89adc2ddd31014a212276e74cd859efafd220e2";
    
    // Initialize the SDK
    $AT = new AfricasTalking($username, $apiKey);
    // Get the SMS service
    $sms = $AT->sms();
?>