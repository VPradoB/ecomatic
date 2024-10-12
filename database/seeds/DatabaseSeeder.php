<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EventTypeSeeder::class);
        Model::unguard();
        $post = factory('App\Stat', 10)->create();
        $post = factory('App\Machine', 10)->create();
        $post = factory('App\Product', 10)->create();
        $post = factory('App\Sale', 500)->create();
        Model::reguard();
    }
}
