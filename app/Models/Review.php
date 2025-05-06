<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    /**
     * fillable
     * @var array
     */
    protected $fillable = ['user_id', 'users', 'engineer', 'rating', 'comment'];

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
            'user_id'    => 'integer',
            'engineer'   => 'integer',
            'rating'     => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * user
     * @return BelongsTo<User, GasSafetyRegistration>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * engineer
     * @return BelongsTo<User, Review>
     */
    public function engineer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'engineer');
    }
}
