<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TransferService implements TransferServiceInterface
{
    const ACCOUNT_TYPE_ACCOUNT = 'account';
    const ACCOUNT_TYPE_CARD = 'card';
    const ACCOUNT_TYPE = [
        self::ACCOUNT_TYPE_ACCOUNT,
        self::ACCOUNT_TYPE_CARD
    ];

    const FEE_TYPE_PAYER = 'payer';
    const FEE_TYPE_RECEIVER = 'receiver';
    const FEE_TYPE = [
        self::FEE_TYPE_PAYER,
        self::FEE_TYPE_RECEIVER
    ];

    public function __construct(
        private JWTService $jwtService
    ) {}

    /**
     * Make transfer.
     */
    public function make(array  $params): array
    {
        $url = 'https://gateway.dev.appotapay.com';
        $headers = [
            "X-APPOTAPAY-AUTH" => 'Bearer ' . $this->jwtService->make(),
            "Content-Type" => 'application/json'
        ];
        $params['signature'] = $this->makeSignature($params);

        $res = Http::withHeaders($headers)->post($url . '/api/v1/service/transfer/make', $params);
        $statusRes = $res->status();
        $bodyRes = $res->json();

        return [$statusRes, $bodyRes];
    }

    /**
     * Make signature.
     */
    private function makeSignature($params): string
    {
        ksort($params);
        $data = http_build_query($params);
        $key = config('services.appota_pay.secret_key');

        return hash_hmac('sha256', $data, $key);
    }
}
