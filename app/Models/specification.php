<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specification extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'name',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function specification_detail()
    {
        return $this->hasMany(Specification_detail::class);
    }
}
