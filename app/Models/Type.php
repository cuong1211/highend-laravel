<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Type extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    protected $fillable = [
        'name',
        'slug',
        'category_id',
    ];
    protected $dates = ['deleted_at','created_at', 'updated_at'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public static function getType()
    {
        return Type::all();
    }

}
