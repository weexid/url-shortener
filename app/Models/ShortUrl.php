<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\NodeVisitorAbstract;

class ShortUrl extends Model
{
    use HasFactory;

    protected $fillable = ['original_url', 'short_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visitor()
    {
        return $this->hasMany(Visitor::class, 'short_id');
    }
}
