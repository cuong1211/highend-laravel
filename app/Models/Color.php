<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'label',
        'value',
        'price',
    ];
    public function atribute()
    {
        return $this->hasMany(Atribute::class);
    }
    public function image()
    {
        return $this->hasMany(Image::class);
    }
}
