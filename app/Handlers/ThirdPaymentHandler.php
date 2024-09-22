<?php

namespace App\Handlers;

use App\Http\Requests\PaymentRequest;
use App\Models\PaymentModel;
use Illuminate\Support\Facades\DB;

class ThirdPaymentHandler extends BasePaymentHandler
{
    public const PAYMENT_SERVICE = PaymentModel::THIRD_PAYMENT_SERVICE;
    public function getRules(): array
    {
        return [
            'txid' => 'required|string',
            'order' => 'required|string',
            'status' => 'required',
            'usdAmount' => 'required|string',
        ];
    }

    public function submit(PaymentRequest $request): PaymentModel
    {
        $this->validate($request);
        DB::beginTransaction();
        if ($request->get('status') == 'completed') {
            $this->getReplenishmentService(
                $this->getUserByOrderId(
                    $request->get('order')
                ),
                $request->get('usdAmount')
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
            'order_id' => $request->get('order'),
            'external_id' => $request->get('txid'),
            'amount' => $request->get('usdAmount'),
            'status' => $request->get('status'),
        ];
    }
}
