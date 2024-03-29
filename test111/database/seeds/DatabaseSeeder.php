<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {         
		$this->call(ProductsTableSeeder::class);        
        $this->call(ProductsInOrdersTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderShipmentSeeder::class); 
        $this->call(OrderDeliveryInfoSeeder::class); 
    }
}
