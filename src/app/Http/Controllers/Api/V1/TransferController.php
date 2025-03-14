<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transfer\MakeRequest;
use App\Services\TransferServiceInterface;
use Illuminate\Http\JsonResponse;

class TransferController extends Controller
{
    public function __construct(
        private TransferServiceInterface $transferService
    ) {}

    /**
     * Make transfer.
     */
    public function make(MakeRequest $request): JsonResponse
    {
        try {
            [$status, $result] =  $this->transferService->make($request->validated());
        } catch (\Throwable $th) {
            throw $th;
        }

        return $this->response($result, $status);
    }
}
