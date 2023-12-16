<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'color_id',
        'quantity',
        'order_id',
        'price',
    ];
    protected $dates = ['created_at', 'updated_at'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product_type()
    {
        return $this->belongsTo(Product_type::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
