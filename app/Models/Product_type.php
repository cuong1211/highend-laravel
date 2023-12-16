<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Product_type extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    protected $fillable = [
        'name',
        'slug',
        'capacity',
        'product_id',
    ];
    protected $dates = ['deleted_at','created_at', 'updated_at'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function atribute()
    {
        return $this->hasMany(Atribute::class);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
