<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminOrdersController extends CBController {


    public function cbInit()
    {
        $this->setTable("orders");
        $this->setPermalink("orders");
        $this->setPageTitle("Orders");

        $this->addNumber("Order id","id");
		$this->addSelectTable("price","products_in_orders.id",["table"=>"products_in_orders","value_option"=>"order_id","display_option"=>"products","sql_condition"=>""])->foreignKey('id');
		

    }
}
