<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $sales
 * @property mixed $product
 * @property mixed $machine
 * @property mixed product_id
 * @property mixed id
 * @property mixed product_values
 * @property mixed machine_id
 * @property mixed created_at
 * @property mixed min_product_values
 * @property mixed alert
 */
class Tank extends Model
{
    protected $table = 'tanks';
    protected $fillable = [
        'machine_id',
        'product_values',
        'min_product_values',
        'status',
        'product_id',
        'alert'
    ];

    public function machine()
    {
        return $this->belongsTo('App\Machine');
    }

    public function product()
    {
        return $this->belongsTo('App\Product')->withTrashed();
    }

    public function toggleAlert()
    {
        $this->alert = $this->alert == 1 ? 0:1;
        $this->save();
        return $this;
    }
}
