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
                                <form id="order-form" class="form-horizontal" method="POST"
                                      action="{{ action('OrderController@store')   }}">
                                    <input type="hidden" name="_method" value="post">
                                    <input type="hidden" name="user_id" value="{{ \Auth::check() ? \Auth::user()->id : '' }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                        <label for="date" class="col-md-2 control-label">Order Date</label>

                                        <div class="col-md-8">
                                            <input id="date" type="date" class="form-control"
                                                   data-provide="datepicker"
                                                   data-date-start-date="{{ \Carbon\Carbon::now()->format('m/d/Y') }}"
                                                   name="date" value="{{ old('date') ? old('date') : \Carbon\Carbon::now()->format('m/d/Y')  }}"
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
                                                      name="comments" required>{{ old('comments')  }}</textarea>

                                            @if ($errors->has('comments'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('comments') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group"> <!-- Submit Button -->
                                        <div class="col-md-offset-2 col-md-8">
                                            <button type="submit" class="btn btn-default ">
                                                <span class="text-success">Save </span>
                                                <span class="glyphicon glyphicon-floppy-save text-success"
                                                      aria-hidden="true"></span>
                                            </button>
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
                                            <tr>
                                                <td>Lemon Juice Packets</td>
                                                <td>3</td>
                                                <td>Delete</td>
                                            </tr>
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
                                <button class="btn brn-default">Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection