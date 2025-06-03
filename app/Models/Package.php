<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    /**
     * fillable
     * @var array
     */
    protected $fillable = ['type', 'price', 'duration', 'status'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id'         => 'integer',
            'price'      => 'decimal',
            'status'     => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * subscriptions
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<UserSubscription, Package>
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(UserSubscription::class);
    }

    /**
     * users
     * @return BelongsToMany<User, Package, \Illuminate\Database\Eloquent\Relations\Pivot>|\Illuminate\Database\Eloquent\Builder<mixed>
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_subscriptions')
            ->withTimestamps()
            ->withTrashed(); // Optional if soft-deleted
    }
}
