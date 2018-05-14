@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.shifts.management'))

@section('breadcrumb-links')
    @include('backend.shift.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.shifts.management') }} <small class="text-muted">{{ __('labels.backend.shifts.list') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.shift.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('labels.backend.shifts.table.name') }}</th>
                                <th>{{ __('labels.backend.shifts.table.user') }}</th>
                                <th>{{ __('labels.backend.shifts.table.time_start') }}</th>
                                <th>{{ __('labels.backend.shifts.table.time_end') }}</th>
                                <th>{{ __('labels.backend.shifts.table.created_at') }}</th>
                                <th>{{ __('labels.backend.shifts.table.updated_at') }}</th>
                                <th>{{ __('labels.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($shifts as $shift)
                            <tr>
                                <td>{{ $shift->name }}</td>
                                <td>{{ $shift->employee }}</td>
                                <td>{{ date('h:i A', strtotime($shift->time_start)) }}</td>
                                <td>{{ date('h:i A', strtotime($shift->time_end)) }}</td>
                                <td>{{ date('F d, Y (h:i A)', strtotime($shift->created_at)) }}</td>
                                <td>{{ date('F d, Y (h:i A)', strtotime($shift->updated_at)) }}</td>
                                <td>{!! $shift->action_buttons !!}</td>
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
                    {!! $shifts->total() !!} {{ trans_choice('labels.backend.shifts.table.total', $shifts->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $shifts->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
