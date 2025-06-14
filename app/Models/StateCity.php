<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StateCity extends Model
{
    /**
     * fillable
     * @var array
     */
    protected $fillable = ['name', 'slug', 'country_state_id'];

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
            'id'               => 'integer',
            'country_state_id' => 'integer',
            'created_at'       => 'datetime',
            'updated_at'       => 'datetime',
        ];
    }

    /**
     * getRouteKeyName
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * belongs to state
     * @return BelongsTo<CountryState, DrivingLicence>
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(CountryState::class, 'country_state_id');
    }

    /**
     * has many zips
     * @return HasMany<CityZip, StateCity>
     */
    public function zips(): HasMany
    {
        return $this->hasMany(CityZip::class);
    }

    /**
     * addresses
     * @return HasMany<Address, Country>
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'city_id');
    }
}
