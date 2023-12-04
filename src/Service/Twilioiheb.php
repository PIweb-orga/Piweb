<?php

namespace App\Service;

use Twilio\Rest\Client;

class Twilioiheb

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