<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    // Orders.php model
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
