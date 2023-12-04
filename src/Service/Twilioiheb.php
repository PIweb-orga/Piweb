<?php

namespace App\Service;

use Twilio\Rest\Client;

class Twilioiheb
{
    private $accountSid = 'AC5591707fd50d397e2a6997d12e349c61';
    private $authToken = '002b8ae7f6871081e0d5433759c00c2a';
    private $twilioPhoneNumber = '+19787753098';

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