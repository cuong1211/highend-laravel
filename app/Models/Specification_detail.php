<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'specification_id',
        'label',
        'value',
    ];
    public function specification()
    {
        return $this->belongsTo(Specification::class);
    }
}
