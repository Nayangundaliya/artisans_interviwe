<?php

namespace App\Services;

use Twilio\Rest\Client;

class SmsService
{
    protected $twilio;

    public function __construct()
    {
        // Initialize the Twilio client using credentials from .env
        $this->twilio = new Client(
            env('TWILIO_SID'),
            env('TWILIO_AUTH_TOKEN')
        );
    }

    /**
     * Send SMS to a given phone number
     *
     * @param string $to The recipient's phone number
     * @param string $message The SMS content
     * @return bool
     */
    public function sendSms($to, $message): bool
    {
        try {
            if (empty($to)) {
                \Log::error('SMS Error: Recipient phone number is missing.');
                return false;
            }
    
            if (!str_starts_with($to, '+')) {
                $to = '+91' . ltrim($to, '0'); // Replace '91' with your default country code
            }
    
            $this->twilio->messages->create($to, [
                'from' => env('TWILIO_PHONE_NUMBER'),
                'body' => $message,
            ]);
            return true;
        } catch (\Exception $e) {
            // Log the error
            \Log::error('SMS Error: ' . $e->getMessage());
            return false;
        }
    }
}
