@extends ('backend.layouts.app')

@section ('title', __('labels.backend.shifts.management') . ' | ' . __('labels.backend.shifts.create'))

@section('breadcrumb-links')
    @include('backend.shift.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.shift.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.shifts.management') }}
                        <small class="text-muted">{{ __('labels.backend.shifts.create') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.shifts.time_start'))->class('col-md-2 form-control-label')->style('line-height: 3')->for('time_start') }}

                        <div class="col-md-10">
                            {{ html()->time('time_start')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.shifts.time_start'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.shifts.time_end'))->class('col-md-2 form-control-label')->style('line-height: 3')->for('time_end') }}

                        <div class="col-md-10">
                            {{ html()->time('time_end')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.shifts.time_end'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.shift.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection