<?php

namespace App\Handlers;

use App\Http\Requests\PaymentRequest;
use App\Models\PaymentModel;

class FirstPaymentHandler extends BasePaymentHandler
{
    public const PAYMENT_SERVICE = PaymentModel::FIRST_PAYMENT_SERVICE;
    public function getRules(): array
    {
        // TODO: Implement getRules() method.
    }

    public function submit(PaymentRequest $request)
    {
        // TODO: Implement submit() method.
    }

    protected function getPaymentBody(PaymentRequest $request): array
    {
        // TODO: Implement getPaymentBody() method.
    }

    public function save(PaymentRequest $request)
    {
        // TODO: Implement save() method.
    }
}
