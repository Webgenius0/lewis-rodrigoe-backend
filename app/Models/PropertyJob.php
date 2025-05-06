<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyJob extends Model
{
    /**
     * fillable
     * @var array
     */
    protected $fillable = [
        'sn',
        'user_id',
        'property_id',
        'engineer',
        'title',
        'description',
        'date_time',
        'error_code',
        'error_code_image',
        'water_pressure_level',
        'tools_info',
        'additional_info',
        'image',
        'video',
        'status',
        'engineer_assigned_at',
    ];

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

    /**
     * property
     * @return BelongsTo<Property, PropertyJob>
     */
    public function property():BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
