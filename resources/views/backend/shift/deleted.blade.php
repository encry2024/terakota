@extends ('backend.layouts.app')

@section ('title', __('labels.backend.shifts.management') . ' | ' . __('labels.backend.shifts.deleted'))

@section('breadcrumb-links')
    @include('backend.shift.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.shifts.management') }}
                    <small class="text-muted">{{ __('labels.backend.shifts.deleted') }}</small>
                </h4>
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
                        @if ($shifts->count())
                            @foreach ($shifts as $shift)
                            <tr>
                                <td>{{ $shift->name }}</td>
                                <td>{{ $shift->employee }}</td>
                                <td>{{ $shift->time_start }}</td>
                                <td>{{ $shift->time_end }}</td>
                                <td>{{ date('F d, Y (h:i A)', strtotime($shift->created_at)) }}</td>
                                <td>{{ date('F d, Y (h:i A)', strtotime($shift->updated_at)) }}</td>
                                <td>{!! $shift->action_buttons !!}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr><td colspan="7"><p class="text-center">{{ __('strings.backend.shifts.no_deleted') }}</p></td></tr>
                        @endif
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
