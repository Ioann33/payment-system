<?php

namespace App\Handlers;

use App\Http\Requests\PaymentRequest;
use App\Models\PaymentModel;
use App\Models\User;
use App\Services\ReplenishService;
use Illuminate\Support\Facades\DB;

class FirstPaymentHandler extends BasePaymentHandler
{
    public const PAYMENT_SERVICE = PaymentModel::FIRST_PAYMENT_SERVICE;
    public function getRules(): array
    {
        return [
            'transactionId' => 'required|string',
            'userOrderId' => 'required|string',
            'status' => 'required|string',
            'amount' => 'required|string',
        ];
    }

    public function submit(PaymentRequest $request): PaymentModel
    {
        $this->validate($request);
        DB::beginTransaction();
        if ($request->get('status') === 'complete') {
            $this->getReplenishmentService(
                $this->getUserByOrderId(
                    $request->get('userOrderId')
                ),
                $request->get('amount')
            )->refuel()->applyPromo();
        }
        $payment = $this->save($request);
        DB::commit();
        return $payment;
    }

    protected function getPaymentBody(PaymentRequest $request): array
    {
        return [
            'type' => $request->getPaymentService(),
            'order_id' => $request->get('userOrderId'),
            'external_id' => $request->get('transactionId'),
            'amount' => $request->get('amount'),
            'status' => $request->get('status'),
            'extra_data' => [
                'currency' => $request->get('currency'),
                'orderCreatedAt' => $request->get('orderCreatedAt'),
                'orderCompleteAt' => $request->get('orderCompleteAt'),
                'hash' => $request->get('hash'),
                'email' => $request->get('email'),
            ],
        ];
    }
}
