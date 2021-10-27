<?php

use Exception as Exception;
use Twilio\Rest\Client;

function sendSMS($receiverNumber,$message){
    try {
        $account_sid = config('app.twilio_sid');
        $auth_token = config('app.twilio_token');
        $twilio_number = config('app.twilio_from');
        $client = new Client($account_sid, $auth_token);
        $client->messages->create("whatsapp:$receiverNumber", [
            'from' => $twilio_number,
            'body' => $message]);
    } catch (Exception $e) {
          //dd("Error: ". $e->getMessage());
    }
}

