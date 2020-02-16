<?php

use Illuminate\Database\Seeder;

class OrderShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    factory(App\OrderShipment::class, 100000)->create()->each(function ($u) {
	        
	    }); 
    }
}
