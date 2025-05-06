<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CountryState extends Model
{
    /**
     * fillable
     * @var array
     */
    protected $fillable = ['name', 'slug', 'country_id'];

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
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * belongs to country
     * @return BelongsTo<Country, Country>
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * has many cityes
     * @return HasMany<StateCity, CountryState>
     */
    public function cityes(): HasMany
    {
        return $this->hasMany(StateCity::class);
    }

    /**
     * addresses
     * @return HasMany<Address, Country>
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'state_id');
    }
}
