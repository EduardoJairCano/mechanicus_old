<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Model;

class AssignedOwner extends Model
{
    /**
     * The table name that belongs this model.
     *
     * @var string
     */
    protected $table = 'assigned_owners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'user_id',
    ];

    /**
     * Disabling auto timestamps
     *
     * @var bool
     */
    public $timestamps = false;
}
