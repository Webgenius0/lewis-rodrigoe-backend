<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Engineer extends Model
{
    /**
     * fillable
     * @var array
     */
    protected $fillable = ['user_id', 'expertise_id', 'address_id', 'ni', 'utr'];

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
            'id'           => 'integer',
            'user_id'      => 'integer',
            'expertise_id' => 'integer',
            'created_at'   => 'datetime',
            'updated_at'   => 'datetime',
        ];
    }

    /**
     * user
     * @return BelongsTo<User, Engineer>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * expertise
     * @return BelongsTo<Expertise, Engineer>
     */
    public function expertise(): BelongsTo
    {
        return $this->belongsTo(Expertise::class);
    }

    /**
     * address
     * @return BelongsTo<Address, Engineer>
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
