@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                @if (Auth::check()) 

                    <div class="card-header">Мои заказы</div>


                        <div ref="refMessageFromRequest" class="refMessageFromRequest">

                        </div>                        

                        <table id="ordersTable" style="margin-bottom: 30px;" class="table">                        
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Состав заказа</th>
                              <th scope="col">Стоимость товаров</th>
                              <th scope="col">Доставка</th>
                              <th scope="col">Стоимость доставки</th>
                              <th scope="col">День доставки</th>
                              <th scope="col">Страна</th>
                              <th scope="col">Город</th>
                              <th scope="col">Улица</th>
                              <th scope="col">Дом</th>
                              <th scope="col">Квартира</th>
                              <th scope="col">Действия</th>
                            </tr>
                          </thead>
                          <tbody ref="refOrdersTbody">
                            @foreach ($orders as $order)
                                <tr>
                                    <!-- Id of note -->
                                    <th scope="row">{{ $order['order_id'] }}</th>
                                    <!-- First name -->
                                    <td>
                                        <? $total_products_amount = 0; ?>
                                        @foreach (json_decode($order['products'], true) as $product)
                                            <div class="products">
                                                <div class="name">{{ $product['name'] }}</div>
                                                <div>Цена: {{ $product['price'] }}</div>
                                                <div>Кол-во: {{ $product['quantity'] }}</div>
                                                <div>Итого: {{ $product['total_price'] }}</div>
                                            </div>
                                            <? $total_products_amount += $product['total_price']; ?>
                                        @endforeach
                                    </td>
                               
                                    <td>
                                        {{ $total_products_amount }}
                                    </td>

                                    <td>
                                        {{ $order['shipment_info']['name'] }}
                                    </td>

                                    <td>
                                        {{ $order['shipment_info']['price'] }}
                                    </td>

                                    <td>
                                        {{ $order['shipment_info']['delivery_day'] }}
                                    </td> 

                                    <td>
                                        <input class="country" ref="refCountry_{{ $order['order_id'] }}" v-bind:disabled="editCurrentField === false || {{ $order['order_id'] }} != currentFieldId" value="{{ $order['delivery_info']['country'] }}">
                                    </td>

                                    <td>
                                        <input class="city" ref="refCity_{{ $order['order_id'] }}" v-bind:disabled="editCurrentField === false || {{ $order['order_id'] }} != currentFieldId" value="{{ $order['delivery_info']['city'] }}">
                                    </td>

                                    <td>
                                        <input class="street" ref="refStreet_{{ $order['order_id'] }}" v-bind:disabled="editCurrentField === false || {{ $order['order_id'] }} != currentFieldId" value="{{ $order['delivery_info']['street'] }}">
                                    </td>

                                    <td>
                                        <input class="house" ref="refHouse_{{ $order['order_id'] }}" v-bind:disabled="editCurrentField === false || {{ $order['order_id'] }} != currentFieldId" value="{{ $order['delivery_info']['house'] }}">
                                    </td>   

                                    <!-- Room -->
                                    <td>
                                        <input class="room" ref="refRoom_{{ $order['order_id'] }}" v-bind:disabled="editCurrentField === false || {{ $order['order_id'] }} != currentFieldId" value="{{ $order['delivery_info']['room'] }}">
                                    </td>      

                                    <input ref="refOrderId_{{ $order['order_id'] }}" value="{{ $order['order_id'] }}" type="hidden">                                                                                                   

                                    <!-- Actions -->
                                    <td>
                                        <div class="actions">
                                            <div class="actions">
                                                <div v-if="editCurrentField === false || {{ $order['order_id'] }} != currentFieldId" v-on:click="clickEditButton('{{ $order['order_id'] }}')" class="edit">
                                                    <img src="{{ asset('img/edit_icon.png') }}" alt="">
                                                </div>

                                                <div v-if="editCurrentField === true && {{ $order['order_id'] }} == currentFieldId" v-on:click="clickSaveButton('{{ $order['order_id'] }}')" class="save">
                                                    <img src="{{ asset('img/save_icon.png') }}" alt="">
                                                </div>                                      
                                            </div>
                                        </div>
                                    </td>
                                </tr>                        
                            @endforeach                        
                          </tbody>
                        </table>
                    </div>

                @else
    
                    <div style="text-align: center;padding: 20px 0;font-size: 16px;">You are not logged. Please login</div>

                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade add_note_modal" id="AddNoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new note</h5>
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body add_note_modal_body">
        <div>
            <label for="input">First Name</label>
            <input ref="refModalFirstName" value="" required type="text">
        </div>
        <div>
            <label for="input">Last Name</label>
            <input ref="refModalLastName" value="" type="text">
        </div>
        <div>
            <label for="input">Phone</label>
            <input ref="refModalPhone" value="" type="text">
        </div>
        <div>
            <label for="input">Observations</label>
            <input ref="refModalObservations" value="" type="text">
        </div>        
      </div>
      <div style="justify-content: space-between;" class="modal-footer">
        <div style="padding: 0;" ref="refModalMessageFromRequest" class="refMessageFromRequest">

        </div>         
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button v-on:click="clickAddButton" type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

@endsection

