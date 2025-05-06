<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expertise extends Model
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
     * engineers
     * @return HasMany<Engineer, Expertise>
     */
    public function engineers(): HasMany
    {
        return $this->hasMany(Engineer::class);
    }
}
