<?php

namespace App\Handlers;

use App\Http\Requests\PaymentRequest;
use App\Models\PaymentModel;
use App\Models\User;
use App\Models\UserOrderModel;
use App\Services\ReplenishService;

abstract class BasePaymentHandler
{

    public const PAYMENT_SERVICE = null;
    /**
     * @return array<string, string>
     */
    abstract public function getRules(): array;

    abstract public function submit(PaymentRequest $request): PaymentModel;

    abstract protected function getPaymentBody(PaymentRequest $request): array;

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

    protected function getReplenishmentService(User $user, float $depositAmount): ReplenishService
    {
        return new ReplenishService($user, $depositAmount);
    }

    protected function getUserByOrderId(int $orderId): User
    {
        return UserOrderModel::query()->with('user')->findOrFail($orderId)->user;
    }

    public function save(PaymentRequest $request): PaymentModel
    {
        return PaymentModel::query()->create($this->getPaymentBody($request));
    }
}
