<?php

namespace App\Handlers;

use App\Http\Requests\PaymentRequest;
use App\Models\PaymentModel;
use Illuminate\Support\Facades\DB;

class SecondPaymentHandler extends BasePaymentHandler
{

    public const PAYMENT_SERVICE = PaymentModel::SECOND_PAYMENT_SERVICE;
    public function getRules(): array
    {
        return [
            'identifier' => 'required|string',
            'orderId' => 'required|string',
            'state' => 'required',
            'amount' => 'required|string',
        ];
    }

    public function submit(PaymentRequest $request): PaymentModel
    {
        $this->validate($request);
        DB::beginTransaction();
        if ($request->get('state') == 2) {
            $this->getReplenishmentService(
                $this->getUserByOrderId(
                    $request->get('orderId')
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
            'order_id' => $request->get('orderId'),
            'external_id' => $request->get('identifier'),
            'amount' => $request->get('amount'),
            'status' => $request->get('state'),
            'extra_data' => [
                'currency' => $request->get('currency'),
                'createdAt' => $request->get('createdAt'),
                'updatedAt' => $request->get('updatedAt'),
                'hash' => $request->get('hash'),
                'email' => $request->get('email'),
                'cardMetadata' => $request->get('cardMetadata')
            ],
        ];
    }
}
