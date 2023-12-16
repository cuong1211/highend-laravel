<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_type_id',
        'color_id',
        'price',
    ];
    public function product_type()
    {
        return $this->hasMany(Product_type::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

}
