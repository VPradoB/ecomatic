<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $id
 * @property mixed $tanks
 * @property mixed $sales
 * @property \Carbon\Carbon $deleted_at
 * @property mixed $stats
 * @property mixed logo
 */
class Product extends Model
{

    use SoftDeletes;

    protected $table = 'products';


    protected $fillable= [
        'name',
        'price',
        'logo',
        'vel'
    ];

    protected $dates =[
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function tanks()
    {
        return $this->hasMany('App\Tank');
    }

    public function sales()
    {
        return $this->hasMany('App\Sale');
    }

    public function stats()
    {
        return $this->hasMany('App\Stat');
    }

    public static function getSales($month)
    {
        $products = Product::all();
        $now = new Carbon();

        if($month== 0) $now = new Carbon('first day of January 2008');

        $result['labels'] = $products->map(function($item,$key) {
            return $item->name;
        });
        $result['data'] = $products->map(function($item,$key) use ($now,$month){
            return $item->sales()->whereDate('created_at','>=',$now->subMonth($month)->toDateTimeString())->sum('total_amount');
        });
        return $result;
    }

    public function salesByDateRange($min, $max)
    {
        $min = Carbon::createFromFormat('m/d/Y', $min)->toDateTimeString();
        return $this->sales()
            ->whereDate('created_at','>=',$min)
            ->whereDate('created_at','<=',Carbon::createFromFormat('m/d/Y', $max)->toDateTimeString())
            ->orderBy('created_at')
            ->get();
    }

    public function delete()
    {
        Storage::delete($this->logo);
        return parent::delete();
    }

}
