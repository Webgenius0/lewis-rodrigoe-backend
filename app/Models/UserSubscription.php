<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{

    /**
     * fillable
     * @var array
     */
    protected $fillable = ['user_id', 'package_id', 'status'];

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
            'user_id'    => 'integer',
            'package_id' => 'integer',
            'status'     => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, UserSubscription>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * package
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Package, UserSubscription>
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
