<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Services\PaymentHandlerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function save(PaymentRequest $request, PaymentHandlerService $handlerService): JsonResponse
    {
        return response()->json([
           'success' => true,
           'data' => $handlerService->handle($request)->toArray()
        ]);
    }
}
