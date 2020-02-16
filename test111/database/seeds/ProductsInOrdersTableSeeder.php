<?php

use Illuminate\Database\Seeder;

class ProductsInOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    factory(App\ProductsInOrder::class, 100000)->create()->each(function ($u) {
	        
	    }); 
    }
}
