<?php

namespace App\Providers;

use App\Handlers\FirstPaymentHandler;
use App\Handlers\SecondPaymentHandler;
use App\Handlers\ThirdPaymentHandler;
use App\Models\PaymentModel;
use App\Services\PaymentHandlerService;
use Carbon\Laravel\ServiceProvider;
class PaymentHandlerServiceProvider extends ServiceProvider
{
    protected string $tag = 'payment.handler';

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(PaymentHandlerService::class);
        $this->app->when(PaymentHandlerService::class)->needs('$handlers')->giveTagged($this->tag);
        $this->app->tag($this->getHandlers(), $this->tag);
    }

    /**
     * @return array<string, string>
     */
    public function getHandlers(): array
    {
        return [
            PaymentModel::FIRST_PAYMENT_SERVICE => FirstPaymentHandler::class,
            PaymentModel::SECOND_PAYMENT_SERVICE => SecondPaymentHandler::class,
            PaymentModel::THIRD_PAYMENT_SERVICE => ThirdPaymentHandler::class,
        ];
    }
}
