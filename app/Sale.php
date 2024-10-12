<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $product
 * @property mixed $tank
 * @property mixed quantity
 */
class Sale extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $table = 'sales';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'product_id',
        'machine_id',
        'price',
        'quantity',
        'total_amount',
        'code'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product')->withTrashed();

    }

    public function machine()
    {
        return $this->belongsTo('App\Machine')->withTrashed();

    }

    public static function whereDateRange($min,$max)
    {
        $min = Carbon::createFromFormat('m/d/Y', $min)->toDateTimeString();
        $max = Carbon::createFromFormat('m/d/Y', $max)->toDateTimeString();
        return Sale::whereDate('created_at','>=',$min)
                    ->whereDate('created_at','<=',$max)
                    ->orderBy('created_at')
                    ->get();
    }
}
