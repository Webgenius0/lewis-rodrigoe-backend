<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
