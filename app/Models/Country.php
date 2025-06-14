<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    /**
     * fillable
     * @var array
     */
    protected $fillable = ['name', 'slug'];

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
     * getRouteKeyName
     * @return string
     */
    public function getRouteKeyName():string
    {
        return 'slug';
    }

    /**
     * has many states
     * @return HasMany<CountryState, Country>
     */
    public function states():HasMany
    {
        return $this->hasMany(CountryState::class);
    }

    /**
     * addresses
     * @return HasMany<Address, Country>
     */
    public function addresses():HasMany
    {
        return $this->hasMany(Address::class, 'country_id');
    }
}
