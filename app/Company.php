<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $publicties
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Company extends Model
{
    protected $table ='companies';
    protected $fillable =[
      'name',
      'phone_number',
      'direction'
    ];

    public function publicties()
    {
        return $this->hasMany('App\Publicity');
    }

}
