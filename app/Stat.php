<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $machine
 * @property mixed $product
 * @property mixed $event_types
 */
class Stat extends Model
{
    protected $table = 'stats';
    protected $fillable = [
        'machine_id',
        'product_id',
        'date',
        'hour',
        'transactions',
        'product_count',
        'event_types_id'
    ];

    protected $casts = [
        'product_count' => 'array'
    ];

    public static function whereDateRange($min, $max)
    {
        $min = Carbon::createFromFormat('m/d/Y', $min)->toDateTimeString();
        $max = Carbon::createFromFormat('m/d/Y', $max)->toDateTimeString();
        return Stat::whereDate('created_at','>=',$min)
            ->whereDate('created_at','<=',$max)
            ->orderBy('created_at')
            ->where('event_types_id','=',3 )
            ->get();
    }


    public function product()
    {
        return $this->belongsTo('App\Product')->withTrashed();
    }

    public function event_types()
    {
        return $this->belongsTo('App\EventTypes');
    }

    /**
     * @return mixed
     */
    public function machine()
    {
        return $this->belongsTo('App\Machine')->withTrashed();
    }
}
