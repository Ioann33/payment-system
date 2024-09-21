<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrderModel extends Model
{
    protected $table = 'user_orders';
    protected $fillable =[
      'id',
      'user_id'
    ];
}
