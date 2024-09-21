<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserOrderModel;

class UserOrderFactory
{
    public static function create(): void
    {
        UserOrderModel::query()->delete();
        for ($i = 12345; $i < 12348; $i ++){
            UserOrderModel::query()->create([
               'id' => $i,
               'user_id' => User::query()->inRandomOrder()->first()->id,
            ]);
        }
    }
}
