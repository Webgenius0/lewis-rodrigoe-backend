<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    /**
     * fillable
     * @var array
     */
    protected $fillable = ['uin', 'label', 'street', 'apartment', 'country_id', 'state_id', 'city_id', 'zip_id', 'latitude', 'longitude'];

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
            'country_id' => 'integer',
            'state_id'   => 'integer',
            'city_id'    => 'integer',
            'zip_id'     => 'integer',
            'latitude'   => 'double',
            'longitude'  => 'double',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * country
     * @return BelongsTo<Country, Address>
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * state
     * @return BelongsTo<CountryState, Address>
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(CountryState::class, 'state_id');
    }

    /**
     * city
     * @return BelongsTo<StateCity, Address>
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(StateCity::class, 'city_id');
    }

    /**
     * zip
     * @return BelongsTo<CityZip, Address>
     */
    public function zip(): BelongsTo
    {
        return $this->belongsTo(CityZip::class, 'zip_id');
    }

    /**
     * engineers
     * @return HasMany<Engineer, Expertise>
     */
    public function engineers(): HasMany
    {
        return $this->hasMany(Engineer::class);
    }

    /**
     * properties
     * @return HasMany<Property, User>
     */
    public function properties():HasMany
    {
        return $this->hasMany(Property::class);
    }
}
