<?php

use App\EventTypes;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventTypes::create(['name'=>'venta']);
        EventTypes::create(['name'=>'dosificación']);
        EventTypes::create(['name'=>'Alerta tanque vacio']);

    }
}
