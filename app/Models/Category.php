<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    protected $fillable = [
        'name',
        'slug',
    ];
    protected $dates = ['deleted_at','created_at', 'updated_at'];
    public static function getCategory()
    {
        $category = Category::all();
        return $category;
    }
    public function type()
    {
        return $this->hasMany(Type::class);
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
