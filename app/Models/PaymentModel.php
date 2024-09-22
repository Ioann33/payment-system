<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    public const FIRST_PAYMENT_SERVICE = 'OnePay';
    public const SECOND_PAYMENT_SERVICE = 'TwoPay';
    public const THIRD_PAYMENT_SERVICE = 'TreePay';

    protected $table = 'payments';

    protected $fillable = [
        'order_id',
        'external_id',
        'amount',
        'status',
        'extra_data',
        'type'
    ];

    protected $casts = [
      'extra_data' => 'array',
      'amount' => 'float',
      'order_id' => 'integer',
    ];
}
