@extends ('backend.layouts.app')

@section ('title', __('labels.backend.dinings.management') . ' | ' . __('labels.backend.dinings.edit'))

@section('breadcrumb-links')
    @include('backend.dining.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($dining, 'PATCH', route('admin.dining.update', $dining->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.dinings.management') }}
                        <small class="text-muted">{{ __('labels.backend.dinings.edit') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.dinings.name'))->class('col-md-2 form-control-label')->style('line-height: 3')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.dinings.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.dinings.price'))->class('col-md-2 form-control-label')->style('line-height: 3')->for('price') }}

                        <div class="col-md-10">
                            {{ html()->time('price')
                                ->class('form-control numeric-input')
                                ->placeholder(__('validation.attributes.backend.dinings.price'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.dinings.description'))->class('col-md-2 form-control-label')->style('line-height: 3')->for('description') }}

                        <div class="col-md-10">
                            {{ html()->time('description')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.dinings.description'))
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
                    {{ form_cancel(route('admin.dining.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection