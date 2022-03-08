<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class World extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','post_id'];


    public function posts(): HasMany
    {
        return $this->hasMany(Post::class,'id', 'post_id');

    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
