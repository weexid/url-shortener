<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = ['id_address', 'country'];

    public function short()
    {
        return $this->belongsTo(ShortUrl::class);
    }
}
