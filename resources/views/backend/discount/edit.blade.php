@extends ('backend.layouts.app')

@section ('title', __('labels.backend.discounts.management') . ' | ' . __('labels.backend.discounts.edit'))

@section('breadcrumb-links')
    @include('backend.discount.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($discount, 'PATCH', route('admin.discount.update', $discount->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.discounts.management') }}
                        <small class="text-muted">{{ __('labels.backend.discounts.edit') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.discounts.name'))->class('col-md-2 form-control-label')->style('line-height: 3')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.discounts.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.discounts.discount'))->class('col-md-2 form-control-label')->style('line-height: 3')->for('discount') }}

                        <div class="input-group col-md-10">
                            <span class="input-group-prepend input-group-text">PHP</span>
                            {{ html()->text('discount')
                                ->class('form-control numeric-input')
                                ->placeholder(__('validation.attributes.backend.discounts.discount'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                            <span class="input-group-prepend input-group-text">%</span>
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.discount.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection