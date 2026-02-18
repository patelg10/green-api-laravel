<?php

namespace YourName\GreenApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use YourName\GreenApi\Events\WebhookReceived;

class GreenApiWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $payload = $request->all();

        // 1. You could add logic here to verify a "Secret Key" if Green API supports it
        
        // 2. Fire a Laravel Event with the data
        event(new WebhookReceived($payload));

        return response()->json(['status' => 'success'], 200);
    }
}