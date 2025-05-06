<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NVQQualification extends Model
{
    /**
     * fillable
     * @var array
     */
    protected $fillable = ['user_id', 'number', 'level_one', 'level_two', 'level_three'];

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
            'id'          => 'integer',
            'user_id'     => 'integer',
            'created_at'  => 'datetime',
            'updated_at'  => 'datetime',
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
}
