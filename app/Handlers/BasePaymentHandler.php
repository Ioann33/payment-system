<?php

namespace App\Handlers;

use App\Http\Requests\PaymentRequest;
use App\Models\PaymentModel;

abstract class BasePaymentHandler
{
    public const PAYMENT_SERVICE = null;

    public function isSupported(string $type): bool
    {
        return $type == static::PAYMENT_SERVICE;
    }

    /**
     * @param PaymentRequest $request
     * @return array<string, mixed>
     */
    public function validate(PaymentRequest $request): array
    {
        return $request->validate($this->getRules());
    }

    /**
     * @return array<string, string>
     */
    abstract public function getRules(): array;

    abstract public function submit(PaymentRequest $request): PaymentModel;

    abstract protected function getPaymentBody(PaymentRequest $request): array;

    abstract public function save(PaymentRequest $request): PaymentModel;
}
