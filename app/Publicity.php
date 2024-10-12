<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


/**
 * @property mixed $company
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property int company_id
 * @property \Carbon\Carbon $updated_at
 * @property mixed logo
 * @property mixed vid
 * @property mixed $machines
 */
class Publicity extends Model
{
    protected $table = 'publicities';

    protected $fillable= [
        'name',
        'description',
        'company_id',
        'vid',
        'logo'
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function machines()
    {
        return $this->belongsToMany('App\Machine','machine_publicity','publicity_id','machine_id');
    }

    /**
     * @return bool|int|null
     * @throws \Exception
     */
    public function delete()
    {
        Storage::delete($this->vid);
        Storage::delete($this->logo);
        //quito la conexion entre maquinas y la publicidad
        $this->machines()->sync([]);
        return parent::delete();
    }
}
