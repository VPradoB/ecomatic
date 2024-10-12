<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Configuration extends Model
{
    protected $table = 'configurations';

    protected $fillable = [
        'code',
        'value',
        'description'
    ];

    protected $dates=[
        'created_at',
        'updated_at'
    ];

    protected $dateFormat= 'Y-m-d H:m:s';
}
