<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'type_id',
    ];
    protected $dates = ['deleted_at','created_at', 'updated_at'];
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function specification()
    {
        return $this->hasMany(Specification::class);
    }
    public function product_type()
    {
        return $this->hasMany(Product_type::class);
    }
    public static function getProduct()
    {
        return Product::all();
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
