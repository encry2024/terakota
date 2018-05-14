@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.discounts.management'))

@section('breadcrumb-links')
    @include('backend.discount.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.discounts.management') }} <small class="text-muted">{{ __('labels.backend.discounts.list') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.discount.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('labels.backend.discounts.table.name') }}</th>
                                <th>{{ __('labels.backend.discounts.table.discount') }}</th>
                                <th>{{ __('labels.backend.discounts.table.created_at') }}</th>
                                <th>{{ __('labels.backend.discounts.table.updated_at') }}</th>
                                <th>{{ __('labels.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($discounts as $discount)
                            <tr>
                                <td>{{ $discount->name }}</td>
                                <td>{{ $discount->formatted_price }}</td>
                                <td>{{ date('F d, Y (h:i A)', strtotime($discount->created_at)) }}</td>
                                <td>{{ date('F d, Y (h:i A)', strtotime($discount->updated_at)) }}</td>
                                <td>{!! $discount->action_buttons !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $discounts->total() !!} {{ trans_choice('labels.backend.discounts.table.total', $discounts->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $discounts->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
