<?php

namespace App\Libraries;

use Twilio\Rest\Client;

class TwilioLibrary
{
    protected $client;

    public function __construct()
    {
        $sid = getenv('TWILIO_SID'); // Twilio Account SID dari lingkungan
        $token = getenv('TWILIO_AUTH_TOKEN'); // Twilio Auth Token dari lingkungan
         
        $this->client = new Client($sid, $token);
    }

    public function sendWhatsAppMessage($to, $message)
    {
        $from = 'whatsapp:' . getenv('TWILIO_WHATSAPP_FROM'); // Your Twilio WhatsApp number
        $to = 'whatsapp:' . $to; // The recipient's WhatsApp number

        return $this->client->messages->create($to, [
            'from' => $from,
            'body' => $message
        ]);
    }
}
