<?php

namespace App\Handlers;

use App\Http\Requests\PaymentRequest;
use App\Models\PaymentModel;

class FirstPaymentHandler extends BasePaymentHandler
{
    public const PAYMENT_SERVICE = PaymentModel::FIRST_PAYMENT_SERVICE;
    public function getRules(): array
    {
        return [

        ];
    }

    public function submit(PaymentRequest $request): PaymentModel
    {
        return $this->save($request);
    }

    protected function getPaymentBody(PaymentRequest $request): array
    {
        return  $request->all();
    }

    public function save(PaymentRequest $request): PaymentModel
    {
        return new PaymentModel();
    }
}
