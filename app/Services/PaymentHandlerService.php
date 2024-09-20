<?php

namespace App\Services;

use App\Handlers\BasePaymentHandler;
use App\Http\Requests\PaymentRequest;
use App\Models\PaymentModel;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class PaymentHandlerService
{
    /**
     * @param array<string, BasePaymentHandler> $handlers
     */
    public function __construct(
        protected array $handlers
    ) {
    }

    /**
     * Return supported form handler
     * @param string $paymentService
     * @return BasePaymentHandler|null
     */
    protected function get(string $paymentService): ?BasePaymentHandler
    {
        return Arr::first($this->handlers, fn (BasePaymentHandler $handler) => $handler->isSupported($paymentService));
    }

    /**
     * @param PaymentRequest $request
     * @return PaymentModel
     */
    public function handle(PaymentRequest $request): PaymentModel
    {
        if($paymentHandler = $this->get($request->getPaymentService())) {
            return $paymentHandler->submit($request);
        } else {
            throw new BadRequestException('This payment service dont support');
        }
    }
}
