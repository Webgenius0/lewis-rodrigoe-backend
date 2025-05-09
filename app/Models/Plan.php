<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plan extends Model
{
    /**
     * fillable
     * @var array
     */
    protected $fillable = ['name', 'price', 'duration', 'duration_value', 'features'];

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
            'id'             => 'integer',
            'price'          => 'double',
            'duration_value' => 'integer',
            'created_at'     => 'datetime',
            'updated_at'     => 'datetime',
        ];
    }

    /**
     * users
     * @return BelongsToMany<User, Plan, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
