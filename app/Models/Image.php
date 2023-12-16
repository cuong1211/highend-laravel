<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'color_id',
        'image',
    ];
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
