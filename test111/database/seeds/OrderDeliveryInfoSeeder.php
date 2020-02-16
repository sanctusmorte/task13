<?php

use Illuminate\Database\Seeder;

class OrderDeliveryInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    factory(App\OrderDeliveryInfo::class, 100000)->create()->each(function ($u) {
	        
	    }); 
    }
}
