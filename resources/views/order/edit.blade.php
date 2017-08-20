@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Order</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <form id="order_form" class="form-horizontal was-validated" method="POST"
                                      action="{{ action('OrderController@update', $order)   }}">
                                    <input type="hidden" name="_method" value="put">
                                    <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                    {{ csrf_field() }}
                                    <div id="date_frm_grp" class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                        <label for="date" class="col-md-2 control-label">Order Date</label>
                                        <div class="col-md-8">
                                            <input id="date" type="date" class="form-control"
                                                   data-provide="datepicker"
                                                   data-date-start-date="{{ \Carbon\Carbon::now()->format('m/d/Y') }}"
                                                   name="date" value="{{ $order->date->format('m/d/Y')  }}"
                                                   required
                                            >
                                            @if ($errors->has('date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div id="comments_frm_grp"  class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                                        <label for="comments" class="col-md-2 control-label">Comments</label>

                                        <div class="col-md-8">
                                            <textarea id="comments" type="text" class="form-control"
                                                      name="comments" >{{ $order->comments }}</textarea>
                                            @if ($errors->has('comments'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('comments') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </form>

                                <div class="row">
                                    <div class="col-md-12"><h3>Items</h3></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-responsive table-striped">
                                            <thead>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                            </thead>
                                            <tbody id="order_items_table_body">
                                            @forelse($order->order_items as $order_item)
                                                <tr id="tr_order_item_{{ $order_item->id  }}">
                                                    <td class="ordered_item_id_{{ $order_item->item->id }}">{{ $order_item->item->name }}</td>
                                                    <td class="col-sm-3">
                                                        <form id="frm_order_item_edit_{{ $order_item->id  }}" class="form-horizontal" >
                                                            {{ csrf_field() }}
                                                            <div id="quantity_frm_grp_{{ $order_item->id  }}" class="form-group form-group-sm">
                                                                <div class="col-sm-12">
                                                                    <div class="input-group input-group-sm">
                                                                        <input id="quantity_{{ $order_item->id  }}" type="number" class="form-control"
                                                                               name="quantity" value="{{ $order_item->quantity  }}"
                                                                               required min="1"
                                                                        >
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-sm btn-default btn-order-item-update"
                                                                                    data-order-item-id="{{ $order_item->id }}"
                                                                                    date-csrf-token="{{ csrf_token() }}"
                                                                                    type="button">
                                                                                <span class="text-success">Update</span>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td class="col-sm-2">
                                                        <div class="btn-group btn-group-sm" role="group" aria-label="">
                                                            <button class="btn btn-default btn-sm btn-delete-order-item"
                                                                    data-order-item-id="{{ $order_item->id }}"
                                                                    date-csrf-token="{{ csrf_token() }}"
                                                            >
                                                                <span class="text-danger">Delete</span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty

                                            @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-default" data-toggle="modal" data-target="#orderItemModal">Add item</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <button id="btn_save_order" class="btn brn-default">Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('modals')
        <!-- Modal -->
    <div class="modal fade" id="orderItemModal" tabindex="-1" role="dialog" aria-labelledby="orderItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderItemModalLabel">New Order Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="order_item_form" class="form-horizontal">
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        {{ csrf_field() }}

                        <div id="item_id_frm_grp" class="form-group {{ $errors->has('item_id') ? ' has-error' : '' }}">
                            <label for="item_id" class="col-md-2 control-label">Item</label>
                            <div class="col-md-8">
                                <select class="form-control" id="item_id" name="item_id" >
                                    @forelse($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>



                        <div id="quantity_frm_grp" class="form-group {{ $errors->has('quantity') ? ' has-error' : '' }}">
                            <label for="quantity" class="col-md-2 control-label">Quantity</label>
                            <div class="col-md-8">
                                <input id="quantity" type="number" class="form-control"
                                       name="quantity" value=""
                                       required min="1"
                                >
                                @if ($errors->has('quantity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_order_item" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endpush


@push('scripts')

<script type="text/javascript">
    function updateOrderItem(){
        $('tr' ).removeClass('success');
        $('.has-error').removeClass('has-error');
        let order_item_id = $(this).attr('data-order-item-id');
        let order_item_form = $('#frm_order_item_edit_' + order_item_id);

        if(order_item_form[0].checkValidity() ){
            let url = '{{ action('OrderItemController@index') }}/' + order_item_id;
            let token = $(this).attr('date-csrf-token');
            $.ajax({
                        url: url,
                        data: {
                            '_method': 'put',
                            '_token':token,
                            'quantity':$('#quantity_' + order_item_id).val(),
                        },
                        type: "POST",
                        dataType : "json",
                    })
                    .done(function( json ) {
                        $('#tr_order_item_' + order_item_id ).addClass('success');
                    })
                    .fail(function( xhr, status, errorThrown ) {
                        alert( "Error, item cannot be updated!" );
                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                        console.dir( xhr );
                        console.log(xhr.responseText);
                    });
        }
        else {
            $('#quantity_frm_grp_' + order_item_id).addClass('has-error');
        }
    }

    function deleteOrderItem(){
        let order_item_id = $(this).attr('data-order-item-id');
        let url = '{{ action('OrderItemController@index') }}/' + order_item_id;
        let token = $(this).attr('date-csrf-token');
        $.ajax({
                    url: url,
                    data: {
                        '_method': 'DELETE',
                        '_token':token
                    },
                    type: "POST",
                    dataType : "json",
                })
                .done(function( json ) {
                    $('#tr_order_item_' + order_item_id ).remove();

                })
                .fail(function( xhr, status, errorThrown ) {
                    alert( "Error, item cannot be deleted!" );
                    console.log( "Error: " + errorThrown );
                    console.log( "Status: " + status );
                    console.dir( xhr );
                    console.log(xhr.responseText);
                });
    }

    function saveOrderItem(){
        $('.has-error').removeClass('has-error');
        let order_item_form = $('#order_item_form');
        let item_id = $('#item_id').val();
        console.log($('.ordered_item_id_'+ item_id)[0])
        if($('.ordered_item_id_'+ item_id)[0]){
            alert('The item has already been added to the order\nPlease adjust the quantity of the existing entry');
        }
        else if(order_item_form[0].checkValidity() ){
            $.post( "{{ action('OrderItemController@store', [$order]) }}", order_item_form.serialize(), function (){}, 'json')
                    .done(function(order_item) {
                        console.log(order_item);
                        $('#orderItemModal').modal('hide');
                        let row = $('<tr />', {
                            'id': 'tr_order_item_' + order_item.id
                        }).appendTo("#order_items_table_body");

                        $('<td />', {
                            'text': order_item.item.name,
                            'class':'ordered_item_id_' + order_item.item.id
                        }).appendTo(row);

                        let td_quantity = $('<td />', {}).appendTo(row);

                        let frm_quantity = $('<form />', {
                            'id': 'frm_order_item_edit_' + order_item.id,
                            'class':'form-horizontal'
                        }).appendTo(td_quantity);

                        $('<input />', {
                            'name': '_token',
                            'type':'hidden',
                            'value':'{{ csrf_token() }}'
                        }).appendTo(frm_quantity);

                        let frm_grp_quantity = $('<div />', {
                            'id': 'quantity_frm_grp_' + order_item.id,
                            'class':'form-group form-group-sm'
                        }).appendTo(frm_quantity);

                        let div_quantity_layout = $('<div />', {
                            'class':'col-sm-12'
                        }).appendTo(frm_grp_quantity);

                        let input_grp_quantity = $('<div />', {
                            'class':'input-group input-group-sm'
                        }).appendTo(div_quantity_layout);

                        $('<input />', {
                            'id': 'quantity_' + order_item.id,
                             'type':'number',
                            'class':'form-control',
                            'name':'quantity',
                            'value':order_item.quantity,
                            'required':true, 'min':'1'
                        }).appendTo(input_grp_quantity);

                        let input_btn_grp_quantity = $('<span />', {
                            'class':'input-group-btn'
                        }).appendTo(input_grp_quantity);

                        let btn_quantity_update = $('<button />', {
                            'class':'btn btn-sm btn-default btn-order-item-update',
                            'data-order-item-id':order_item.id,
                            'date-csrf-token':'{{ csrf_token() }}',
                            'type':'button'
                        }).appendTo(input_btn_grp_quantity).on('click', updateOrderItem);

                        $('<span />', {
                            'class':'text-success',
                            'text':'Update'
                        }).appendTo(btn_quantity_update);

                        let td_delete = $('<td />', {}).appendTo(row);

                        let button_delete = $('<button />', {
                            'class':'btn btn-default btn-xs btn-delete-order-item',
                            'data-order-item-id':order_item.id,
                            'date-csrf-token':"{{ csrf_token() }}"
                        }).appendTo(td_delete)
                                .on('click', deleteOrderItem);

                        $('<span />', {
                            'class':'text-danger',
                            'text':'Delete'
                        }).appendTo(button_delete);
                    })
                    .fail(function(xhr, status, errorThrown) {
                        alert( "Error, item cannot be added!" );
                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                        console.dir( xhr );
                        console.log(xhr.responseText);
                    });

        }
        else {

            let fld_item_id = $('#item_id');
            if(!fld_item_id[0].checkValidity()){
                console.log('item invalid');
                $('#item_id_frm_grp').addClass('has-error');
            }

            let fld_quantity = $('#quantity');
            if(!fld_quantity[0].checkValidity()){
                console.log('quantity invalid');
                $('#quantity_frm_grp').addClass('has-error');
            }
        }
    }

    function saveOrder(){
        $('.has-error').removeClass('has-error');
        let order_form = $('#order_form');
        if(!$('tr' )[0]){
            alert( "Add an item before saving!" );
        }
        else if(order_form[0].checkValidity() ){
            $.post( "{{ action('OrderController@update', [$order]) }}", order_form.serialize(), function (){}, 'json')
                    .done(function() {
                        alert('Order Saved')
                    })
                    .fail(function(xhr, status, errorThrown) {
                        alert( "Sorry, there was a problem!" );
                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                        console.dir( xhr );
                        console.log(xhr.responseText);
                    });

        }
        else {
            let fld_date = $('#date');
            if(!fld_date[0].checkValidity()){
                console.log('date invalid');
                $('#date_frm_grp').addClass('has-error');
            }
        }
    }

    $( document ).ready(function (){
        $('#btn_save_order').on('click', saveOrder );

        $('#btn_save_order_item').on('click', saveOrderItem);

        $('.btn-order-item-update').on('click', updateOrderItem);

        $('.btn-delete-order-item').on('click', deleteOrderItem);

    });

</script>

@endpush