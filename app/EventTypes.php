<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $stats
 */
class EventTypes extends Model
{
    protected $fillable = [];
    protected $table = 'event_types';

    public function stats()
    {
        return $this->hasMany('App\stat');
    }
}
