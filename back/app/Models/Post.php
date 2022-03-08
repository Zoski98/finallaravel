<?php

namespace App\Models;
use App\Models\World;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;
    const WORLD = 1;
    const COMMUNITY = 2;
    const FEED = 3;


    protected $fillable = ['user_id','post_title','post_content','section','image'];

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class,'post_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function isFeed(): bool
    {
        return $this->type() === self::FEED;
    }

    public function isCommunity(): bool
    {
        return $this->type() === self::COMMUNITY;
    }

    public function isWorld(): bool
    {
        return $this->type() === self::WORLD;
    }
    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }

    public function feed(): BelongsTo
    {
        return $this->belongsTo(Feed::class);
    }
    public function world(): hasOne
    {
        return $this->hasOne(World::class, 'id', 'post_id');
    }

}
