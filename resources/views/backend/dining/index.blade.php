@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.dinings.management'))

@section('breadcrumb-links')
    @include('backend.dining.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.dinings.management') }} <small class="text-muted">{{ __('labels.backend.dinings.list') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.dining.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('labels.backend.dinings.table.name') }}</th>
                                <th>{{ __('labels.backend.dinings.table.price') }}</th>
                                <th>{{ __('labels.backend.dinings.table.created_at') }}</th>
                                <th>{{ __('labels.backend.dinings.table.updated_at') }}</th>
                                <th>{{ __('labels.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($dinings as $dining)
                            <tr>
                                <td>{{ $dining->name }}</td>
                                <td>{{ $dining->formatted_price }}</td>
                                <td>{{ date('F d, Y (h:i A)', strtotime($dining->created_at)) }}</td>
                                <td>{{ date('F d, Y (h:i A)', strtotime($dining->updated_at)) }}</td>
                                <td>{!! $dining->action_buttons !!}</td>
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
                    {!! $dinings->total() !!} {{ trans_choice('labels.backend.dinings.table.total', $dinings->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $dinings->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
