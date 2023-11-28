<?php

namespace App\Service;

use Twilio\Rest\Client;

class Twilioiheb
{
    private $accountSid = 'ACce153e914cf2e4d6332f4025974359fd';
    private $authToken = 'ee57822c48ee1ecef5dfdb24ee3525fb';
    private $twilioPhoneNumber = '+15715816100';

    public function sendSMS($to, $body)
    {
        $client = new Client($this->accountSid, $this->authToken);
        $client->messages->create(
            $to,
            [
                'from' => $this->twilioPhoneNumber,
                'body' => $body,
            ]
        );
    }
}