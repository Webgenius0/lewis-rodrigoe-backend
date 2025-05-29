<?php

namespace App\Models;

use Carbon\Carbon;
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
            'id'                   => 'integer',
            'user_id'              => 'integer',
            'property_id'          => 'integer',
            'engineer'             => 'integer',
            'date_time'            => 'datetime',
            'engineer_assigned_at' => 'datetime',
            'created_at'           => 'datetime',
            'updated_at'           => 'datetime',
        ];
    }

    /**
     * sccessor for Image attribute
     * @param mixed $url
     * @return string
     */
    public function getImageAttribute($url): string
    {
        if ($url) {
            if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                return $url;
            } else {
                return asset('storage/' . $url);
            }
        } else {
            return asset('assets/img/user_placeholder.png');
        }
    }

    /**
     * sccessor for video attribute
     * @param mixed $url
     * @return string
     */
    public function getVideoAttribute($url): string
    {
        if ($url) {
            if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                return $url;
            } else {
                return asset('storage/' . $url);
            }
        } else {
            return asset('assets/img/user_placeholder.png');
        }
    }

    /**
     * sccessor for ErrorCodeImage attribute
     * @param mixed $url
     * @return string
     */
    public function getErrorCodeImageAttribute($url): string
    {
        if ($url) {
            if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                return $url;
            } else {
                return asset('storage/' . $url);
            }
        } else {
            return asset('assets/img/user_placeholder.png');
        }
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
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * getDateTimeAttribute
     * @param mixed $value
     * @return array{date: null, time: null|array{date: string, time: string}}
     */
    protected function getDateTimeAttribute($value): array
    {
        if (!$value) {
            return [
                'date' => null,
                'time' => null,
            ];
        }
        $dateTime = Carbon::parse($this->value);
        return [
            'date' => $dateTime->format('d/m/y'),
            'time' => $dateTime->format('h:i A'),
        ];
    }
}
