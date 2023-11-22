<?php

namespace App\Service;

use Twilio\Rest\Client;

class TwilioService
{
    private $accountSid = 'AC5424d814f660f9134be9ea5fbf310cb9';
    private $authToken = '463dedc0f1fc7280d0e3d0fd46c66ad4';
    private $twilioPhoneNumber = '+12512921508';

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