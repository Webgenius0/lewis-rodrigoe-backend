<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanUserPivot extends Model
{
    /**
     * table
     * @var string
     */
    protected $table = 'plan_user';
    /**
     * fillable
     * @var array
     */
    protected $fillable = ['start_date', 'end_date', 'is_active'];

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
            'start_date' => 'datetime',
            'end_date'   => 'datetime',
            'is_active'  => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
