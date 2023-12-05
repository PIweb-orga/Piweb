<?php

namespace App\Service;

use Twilio\Rest\Client;

class TwilioService
{
    private $accountSid = 'ACc4e5792ea13de16dfb4dbe9ffafd9817';
    private $authToken = '65c816e361a7eafe15c04cb2a3db1c96';
    private $twilioPhoneNumber = '+19032744405';

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