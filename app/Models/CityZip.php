<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CityZip extends Model
{
    /**
     * fillable
     * @var array
     */
    protected $fillable = ['name', 'slug', 'state_city_id'];

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
            'id'            => 'integer',
            'state_city_id' => 'integer',
            'updated_at'    => 'datetime',
            'created_at'    => 'datetime',
        ];
    }

    /**
     * belongs to city
     * @return BelongsTo<StateCity, CityZip>
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(StateCity::class);
    }

    /**
     * addresses
     * @return HasMany<Address, Country>
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'zip_id');
    }
}
