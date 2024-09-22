<?php

namespace App\Services;

use App\Models\User;

class ReplenishService
{

    public function __construct(protected User $user, protected float $depositAmount)
    {
    }

    public function applyPromo(): void
    {
        if ($this->user->is_active_promo){
            $this->user->amount += $this->calculateBonus();
            $this->user->save();
        }
    }

    private function calculateBonus(): float
    {
        return $this->depositAmount * $this->user->bonus;
    }

    public function refuel(): static
    {
        $this->user->amount += $this->depositAmount;
        $this->user->save();
        return $this;
    }
}
