<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'content',
        'status',
    ];
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
