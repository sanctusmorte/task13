<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\ProductInOrders;
use App\OrderDeliveryInfo;
use App\OrderShipment;
use Auth;
use DB;

/*
|--------------------------------------------------------------------------
| Orders Contoller
|--------------------------------------------------------------------------
|
| This controller is responsible for displaying user's orders using pagination on the page 
| and for editing / deleting orders
|
*/

class OrdersController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return view
     */   
      
    public function index()
    {
        $orders = [];
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $orders = $this->getAllOrders($user_id);                   
        }
    	return view('orders', compact('orders'));
    }

    /**
     * Get all orders
     *
     * @param int $user_id
     *
     * @return array $orders
     */

    public function getAllOrders($user_id)
    {
        $orders = DB::table('orders')
            ->where('user_id', '=', $user_id)
            ->limit(10)
            ->orderBy('orders.id', 'asc')
            ->join('products_in_orders', 'orders.id', '=', 'products_in_orders.order_id')
            ->get();

        $data = [];

        foreach ($orders as $order) {

            $shipment_info = OrderShipment::where('order_id', '=', $order->order_id)->first();
            $delivery_info = OrderDeliveryInfo::where('order_id', '=', $order->order_id)->first();

            $result = [
                'order_id' => $order->order_id,
                'products' => $order->products,
                'shipment_info' => [
                    'name' => $shipment_info['name'],
                    'price' => $shipment_info['price'],
                    'delivery_day' => $shipment_info['delivery_day'],
                ],
                'delivery_info' => [
                    'country' => $delivery_info['country'],
                    'city' => $delivery_info['city'],
                    'street' => $delivery_info['street'],
                    'house' => $delivery_info['house'],
                    'room' => $delivery_info['room'],
                ]
            ];

            $data[] = $result;

        }

        return $data;  
    }

    /**
     * Edit order
     *
     * @param obj $request - data from ajax
     *
     * @return array $orders
     */

    public function orderEdit(Request $request)
    {
        // get data from request
        $orderId = (int)$request->data['orderId'];
        $country = $request->data['country'];
        $city = $request->data['city'];
        $street = $request->data['street'];
        $house = $request->data['house'];
        $room = $request->data['room'];

        if (strlen($country) == 0 or 
            strlen($city) == 0 or 
            strlen($street) == 0 or 
            strlen($house) == 0 or
            strlen($room) == 0) {

            $json_response = [
                'response' => '404',
                'status' => 'false',
                'message' => 'The field/fields cannot be empty!'
            ];

            return response()->json([$json_response]);              
        }

        $editOrder = OrderDeliveryInfo::where('order_id', $orderId)
            ->update([
                'country' => $country,
                'city' => $city,
                'street' => $street,
                'house' => $house,
                'room' => $room,
            ]); 

        if ($editOrder === 1) {

            $json_response = [
                'response' => '200',
                'status' => 'ok',
                'message' => 'The order has successfully changed!'
            ];

        } else {
            $json_response = [
                'response' => '404',
                'status' => 'false',
                'message' => 'The order # was not changed. Maybe you didn’t make changes fot this order or some error has occurred.'
            ];
        }  

        return response()->json([$json_response]);             
    }
}
