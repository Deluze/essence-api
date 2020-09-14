<?php

namespace App\Models;

use App\Events\PlayerCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Player extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'rank', 'prestige', 'level', 'don', 'cash', 'coins', 'experience', 'playtime',
    ];

    protected $dispatchesEvents = [
        'created' => PlayerCreated::class,
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function memos(): HasMany
    {
        return $this->hasMany(Memo::class);
    }

    /**
     * @return HasMany
     */
    public function friends(): HasMany
    {
        return $this->hasMany(Friend::class, 'player_from');
    }

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(PlayerItem::class);
    }

    /**
     * @return HasMany
     */
    public function equipment(): HasMany
    {
        return $this->hasMany(PlayerEquipment::class);
    }

    public function stats(): HasOne
    {
        return $this->hasOne(PlayerStats::class);
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'name';
    }
}
