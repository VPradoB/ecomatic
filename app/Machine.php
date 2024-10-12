<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property mixed $stats
 * @property mixed $tanks
 * @property mixed $publicities
 * @property mixed $sales
 */
class Machine extends Model
{
    use SoftDeletes;

    protected $table = 'machines';
    protected $dates = ['created_at','updated_at','deleted_at'];
    protected $fillable = [
        'mac',
        'name',
        'ubication'
    ];

    public function salesByDateRange($min, $max)
    {
        $min = Carbon::createFromFormat('m/d/Y', $min)->toDateTimeString();
        return $this->sales()
                ->whereDate('created_at','>=',$min)
                ->whereDate('created_at','<=',Carbon::createFromFormat('m/d/Y', $max)->toDateTimeString())
                ->orderBy('created_at')
                ->get();
    }


    public function tanks()
    {
        return $this->hasMany('App\Tank');
    }

    public function sales()
    {
        return $this->hasMany('App\Sale');
    }

    public function publicities()
    {
        return $this->belongsToMany('App\Publicity','machine_publicity','machine_id','publicity_id');
    }

    public function getProductsSaleByARangeTime()
    {
        $this->stats()->where();
    }

    public function delete()
    {
        //elimino los tanques pertenecientes a la maquina
        foreach ($this->tanks as $tank) $tank->delete();
        //elimino la relacion entre las publicidades y la maquina
        $this->publicities()->sync([]);
        return parent::delete();
    }

    public function stats()
    {
        $this->hasMany('App\Stat');
    }

    /**
     * return a sum total amount off all machines in a specific format for Chart.js use
     * @param integer $month
     * @return array(data[total_sales],labels[respective machine_id])
     */
    public static function getSales($month)
    {
        $machines =  Machine::all();
        $now = new Carbon();
        if($month== 0) $now = new Carbon('first day of January 2008');


        $result['labels'] = $machines->map(function($item,$key){
            return $item->mac.', '.$item->name;
        });
        $result['data'] = $machines->map(function($item,$key) use($now,$month){
            return $item->sales()->whereDate('created_at','>=',$now->subMonth($month)->toDateTimeString())->sum('total_amount');
        });
        return $result;
    }

    public function getSalesByMonth($diffYear)
    {
        $rangeDates = [
            'firstJanuary'  => (new Carbon('first day of january'))->subYears($diffYear),
            'lastJanuary'   => (new Carbon('last day of january'))->subYears($diffYear),
            'firstFebruary' => (new Carbon('first day of february'))->subYears($diffYear),
            'lastFebruary'  => (new Carbon('last day of february'))->subYears($diffYear),
            'firstMarch'    => (new Carbon('first day of march'))->subYears($diffYear),
            'lastMarch'     => (new Carbon('last day of march'))->subYears($diffYear),
            'firstApril'    => (new Carbon('first day of april'))->subYears($diffYear),
            'lastApril'     => (new Carbon('last day of april'))->subYears($diffYear),
            'firstMay'      => (new Carbon('first day of may'))->subYears($diffYear),
            'lastMay'       => (new Carbon('last day of may'))->subYears($diffYear),
            'firstJune'     => (new Carbon('first day of june'))->subYears($diffYear),
            'lastJune'      => (new Carbon('last day of june'))->subYears($diffYear),
            'firstJuly'     => (new Carbon('first day of july'))->subYears($diffYear),
            'lastJuly'      => (new Carbon('last day of july'))->subYears($diffYear),
            'firstAugust'   => (new Carbon('first day of august'))->subYears($diffYear),
            'lastAugust'    => (new Carbon('last day of august'))->subYears($diffYear),
            'firstSeptember'=> (new Carbon('first day of september'))->subYears($diffYear),
            'lastSeptember' => (new Carbon('last day of september'))->subYears($diffYear),
            'firstOctober'  => (new Carbon('first day of october'))->subYears($diffYear),
            'lastOctober'   => (new Carbon('last day of october'))->subYears($diffYear),
            'firstNovember' => (new Carbon('first day of november'))->subYears($diffYear),
            'lastNovember'  => (new Carbon('last day of november'))->subYears($diffYear),
            'firstDecember' => (new Carbon('first day of december'))->subYears($diffYear),
            'lastDecember'  => (new Carbon('last day of december'))->subYears($diffYear),
        ];
        $result['data'] = [
            $this->sales()->whereDate('created_at','>=',$rangeDates['firstJanuary']     ->toDateTimeString())->whereDate('created_at','<=',$rangeDates['lastJanuary']       ->toDateTimeString())->get()->sum('total_amount'),
            $this->sales()->whereDate('created_at','>=',$rangeDates['firstFebruary']    ->toDateTimeString())->whereDate('created_at','<=',$rangeDates['lastFebruary']      ->toDateTimeString())->get()->sum('total_amount'),
            $this->sales()->whereDate('created_at','>=',$rangeDates['firstMarch']       ->toDateTimeString())->whereDate('created_at','<=',$rangeDates['lastMarch']         ->toDateTimeString())->get()->sum('total_amount'),
            $this->sales()->whereDate('created_at','>=',$rangeDates['firstApril']       ->toDateTimeString())->whereDate('created_at','<=',$rangeDates['lastApril']         ->toDateTimeString())->get()->sum('total_amount'),
            $this->sales()->whereDate('created_at','>=',$rangeDates['firstMay']         ->toDateTimeString())->whereDate('created_at','<=',$rangeDates['lastMay']           ->toDateTimeString())->get()->sum('total_amount'),
            $this->sales()->whereDate('created_at','>=',$rangeDates['firstJune']        ->toDateTimeString())->whereDate('created_at','<=',$rangeDates['lastJune']          ->toDateTimeString())->get()->sum('total_amount'),
            $this->sales()->whereDate('created_at','>=',$rangeDates['firstJuly']        ->toDateTimeString())->whereDate('created_at','<=',$rangeDates['lastJuly']          ->toDateTimeString())->get()->sum('total_amount'),
            $this->sales()->whereDate('created_at','>=',$rangeDates['firstAugust']      ->toDateTimeString())->whereDate('created_at','<=',$rangeDates['lastAugust']        ->toDateTimeString())->get()->sum('total_amount'),
            $this->sales()->whereDate('created_at','>=',$rangeDates['firstSeptember']   ->toDateTimeString())->whereDate('created_at','<=',$rangeDates['lastSeptember']     ->toDateTimeString())->get()->sum('total_amount'),
            $this->sales()->whereDate('created_at','>=',$rangeDates['firstOctober']     ->toDateTimeString())->whereDate('created_at','<=',$rangeDates['lastOctober']       ->toDateTimeString())->get()->sum('total_amount'),
            $this->sales()->whereDate('created_at','>=',$rangeDates['firstNovember']    ->toDateTimeString())->whereDate('created_at','<=',$rangeDates['lastNovember']      ->toDateTimeString())->get()->sum('total_amount'),
            $this->sales()->whereDate('created_at','>=',$rangeDates['firstDecember']    ->toDateTimeString())->whereDate('created_at','<=',$rangeDates['lastDecember']      ->toDateTimeString())->get()->sum('total_amount'),



        ];
        $result['label'] = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        return $result;
    }

    public function getProductsByMonth($month)
    {
        $result = ['data'=>[],'label'=>[]];
        $sales =$this->sales()->whereDate('created_at','>=', (new Carbon('first day of '.$month)))->whereDate('created_at','<=',(new Carbon('last day of'.$month))->toDateTimeString())->get();
        for ($i=0; $i< count($sales);$i++){
            if(!in_array($sales[$i]->product->name,$result['label']))
            {
                array_push($result['label'],$sales[$i]->product->name);
                array_push($result['data'],$sales[$i]->quantity);

            }else{
                $result['data'][array_search($sales[$i]->product->name,$result['label'])] +=  $sales[$i]->quantity;
            }
        }

        return $result;
    }

    public function alertByDateRange($min, $max)
    {
        $min = Carbon::createFromFormat('m/d/Y', $min)->toDateTimeString();
        dd($this->stats());
        return $this->stats()
            ->whereDate('created_at','>=',$min)
            ->whereDate('created_at','<=',Carbon::createFromFormat('m/d/Y', $max)->toDateTimeString())
            ->orderBy('created_at')
            ->get();
    }
}
