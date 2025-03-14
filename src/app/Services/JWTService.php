<?php

namespace App\Services;

use Firebase\JWT\JWT;

class JWTService
{
    /**
     * Make JWT.
     */
    public function make(): string
    {
        $now = now('Asia/Ho_Chi_Minh')->addMinutes(5)->timestamp;
        $key = config('services.appota_pay.secret_key');
        $payload = [
            'iss' => config('services.appota_pay.partner_code'),
            'jti' => config('services.appota_pay.api_key') . '-' . $now,
            'api_key' => config('services.appota_pay.api_key'),
            'exp' => $now
        ];
        $headers = [
            'typ' => 'JWT',
            'alg' => 'HS256',
            'cty' => 'appotapay-api;v=1'
        ];

        return JWT::encode($payload, $key, 'HS256', head: $headers);
    }
}
