@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.sales.management'))

@section('breadcrumb-links')
    @include('backend.report.sales.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.sales.management') }}
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('labels.backend.sales.table.name') }}</th>
                                <th>{{ __('labels.backend.sales.table.dining') }}</th>
                                <th>{{ __('labels.backend.sales.table.product') }}</th>
                                <th>{{ __('labels.backend.sales.table.quantity') }}</th>
                                <th>{{ __('labels.backend.sales.table.amount') }}</th>
                                <th>{{ __('labels.backend.sales.table.discount') }}</th>
                                <th>{{ __('labels.backend.sales.table.senior') }}</th>
                                <th>{{ __('labels.backend.sales.table.order') }}</th>
                                <th>{{ __('labels.backend.sales.table.status') }}</th>
                                <th style="border-right: none;">{{ __('labels.backend.sales.table.created_at') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->order->user->full_name }}</td>
                                <td>{{ $sale->order->dining->name }}</td>
                                <td>{!! $sale->product->code !!}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>{{ $sale->amount }}</td>
                                <td>{{ $sale->discount_id == 0 ? 'N/A' : $sale->discount->name . '('.$sale->discount->discount.')' }}</td>
                                <td>{{ $sale->senior ? $sale->senior : 'N/A' }}</td>
                                <td>{{ $sale->customer_type }}</td>
                                <td>{{ $sale->status }}</td>
                                <td>{{ date('F d, Y (h:i A)', strtotime($sale->created_at)) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left non-printable">
                    {!! $sales->total() !!} {{ trans_choice('labels.backend.sales.table.total', $sales->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $sales->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->

<form class="modal fade bd-example-modal-lg form-horizontal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="filterModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter Sales Report</h5>
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label for="datepicker" class="control-label col-md-4 mt-2">Date Range</label>

                            <div class="col-md-8">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-sm form-control" name="date_start" autocomplete="false" value="{{ Request::get('date_start') }}"/>
                                    <span class="input-group-prepend input-group-text">to</span>
                                    <input type="text" class="input-sm form-control" name="date_end" value="{{ Request::get('date_end') }}"/>
                                </div>
                            </div>
                        </div> <!-- form-group -->

                        <div class="form-group row">
                            <label for="datepicker" class="control-label col-md-4 mt-2">Shift</label>

                            <div class="col-md-8">
                                <select name="shift" id="shift" class="form-control">
                                    <option value=""></option>
                                    @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}" {{ Request::get('shift') == $shift->id ? 'selected' : '' }}>{{ $shift->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> <!-- form-group -->

                        <div class="form-group row">
                            <label for="datepicker" class="control-label col-md-4 mt-2">Custom Time</label>

                            <div class="col-md-8">
                                <div class="input-timerange input-group" id="timerange">
                                    <input type="time" class="input-sm form-control" name="start_time" value="{{ Request::get('start_time') }}"/>
                                    <span class="input-group-prepend input-group-text">to</span>
                                    <input type="time" class="input-sm form-control" name="end_time" value="{{ Request::get('end_time') }}"/>
                                </div>
                            </div>
                        </div> <!-- form-group -->

                        <div class="form-group row">
                            <label for="datepicker" class="control-label col-md-4 mt-2">Order Type</label>

                            <div class="col-md-8">
                                <select name="order_type" id="order_type" class="form-control">
                                    <option value=""></option>
                                    <option value="0" {{ Request::get('order_type') == 0 ? 'selected' : '' }}>Dine-In</option>
                                    <option value="1" {{ Request::get('order_type') == 1 ? 'selected' : '' }}>Take-Out</option>
                                    <option value="2" {{ Request::get('order_type') == 2 ? 'selected' : '' }}>Salary Deduct</option>
                                    <option value="3" {{ Request::get('order_type') == 3 ? 'selected' : '' }}>Acknowledge</option>
                                </select>
                            </div>
                        </div> <!-- form-group -->

                        <div class="form-group row">
                            <label for="datepicker" class="control-label col-md-4 mt-2">Sales Status</label>

                            <div class="col-md-8">
                                <select name="sales_status" id="sales_status" class="form-control">
                                    <option value=""></option>
                                    <option value="CANCELLED" {{ Request::get('sales_status') == 'CANCELLED' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="PENDING" {{ Request::get('sales_status') == 'PENDING' ? 'selected' : '' }}>Pending</option>
                                    <option value="SALE" {{ Request::get('sales_status') == 'SALE' ? 'selected' : '' }}>Sale</option>
                                </select>
                            </div>
                        </div> <!-- form-group -->
                    </div> <!-- col -->
                </div> <!-- row -->
            </div> <!-- modal-body -->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Filter Report</button>
            </div> <!-- modal-footer -->
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</form> <!-- modal -->
@endsection

@push('before-scripts')
<script>
    $('#datepicker').datepicker();
</script>
@endpush