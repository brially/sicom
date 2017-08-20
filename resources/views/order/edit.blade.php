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
                                <form id="order_form" class="form-horizontal" method="POST"
                                      action="{{ action('OrderController@update', $order)   }}">
                                    <input type="hidden" name="_method" value="put">
                                    <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
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

                                    <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                                        <label for="comments" class="col-md-2 control-label">Comments</label>

                                        <div class="col-md-8">
                                            <textarea id="comments" type="text" class="form-control"
                                                      name="comments" required>{{ $order->comments }}</textarea>

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
                                            <tbody>
                                            @forelse($order->order_items as $order_item)
                                                <tr>
                                                    <td>{{ $order_item->item->name }}</td>
                                                    <td>{{ $order_item->quantity }}</td>
                                                    <td>
                                                        <button class="btn btn-default btn-xs"><span class="text-danger">Delete</span></button>
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
                                        <button class="btn btn-default">Add item</button>
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

@endpush


@push('scripts')

<script type="text/javascript">
    $( document ).ready(function (){
        $('#btn_save_order').on('click', function(){
            let order_form = $('#order_form');
            if(order_form[0].checkValidity() ){
                let jqxhr = $.post( "{{ action('OrderController@update', [$order]) }}", order_form.serialize(), function (){}, 'json')
                        .done(function() {
                            alert('Order Saved')
                        })
                        .fail(function(jqXHR) {
                            console.log(jqXHR.responseText);
                            alert( "error" );
                        });

            }
            else {

            }

            console.log();

        })



    });
</script>

@endpush