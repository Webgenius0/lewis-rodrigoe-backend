<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    /**
     * fillable
     * @var array
     */
    protected $fillable = [
        'sn',
        'user_id',
        'address_id',
        'boiler_type_id',
        'boiler_model_id',
        'property_type_id',
        'quantity',
        'purchase_year',
        'last_service_date',
        'location',
        'accessability_info',
        'radiator',
        'price',
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
            'id'                => 'integer',
            'user_id'           => 'integer',
            'address_id'        => 'integer',
            'boiler_type_id'    => 'integer',
            'boiler_model_id'   => 'integer',
            'property_type_id'  => 'integer',
            'radiator'          => 'integer',
            'quantity'          => 'integer',
            'purchase_year'     => 'date',
            'last_service_date' => 'date',
            'price'             => 'double',
            'created_at'        => 'datetime',
            'updated_at'        => 'datetime',
        ];
    }

    /**
     * user
     * @return BelongsTo<User, Property>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * address
     * @return BelongsTo<Address, Property>
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * boilerType
     * @return BelongsTo<BoilerTypes, Property>
     */
    public function boilerType(): BelongsTo
    {
        return $this->belongsTo(BoilerTypes::class);
    }

    /**
     * boilerModel
     * @return BelongsTo<BoilerModel, Property>
     */
    public function boilerModel(): BelongsTo
    {
        return $this->belongsTo(BoilerModel::class);
    }

    /**
     * propertyType
     * @return BelongsTo<PropertyType, Property>
     */
    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    /**
     * jobs
     * @return HasMany<PropertyJob, Property>
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(PropertyJob::class, 'property_id');
    }
}
