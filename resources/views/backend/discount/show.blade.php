@extends ('backend.layouts.app')

@section ('title', __('labels.backend.discounts.management') . ' | ' . __('labels.backend.discounts.view', ['name' => $discount->name]))

@section('breadcrumb-links')
    @include('backend.discount.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.discounts.management') }}
                    <small class="text-muted">{{ __('labels.backend.discounts.view', ['name' => $discount->name]) }}</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-tag"></i> {{ __('labels.backend.discounts.tabs.titles.overview') }}</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                        @include('backend.discount.show.tabs.overview')
                    </div><!--tab-->
                </div><!--tab-content-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>{{ __('labels.backend.discounts.tabs.content.overview.created_at') }}:</strong> {{ date('F d, Y (h:i:s A)', strtotime($discount->updated_at)) }} ({{ $discount->created_at->diffForHumans() }}),
                    <strong>{{ __('labels.backend.discounts.tabs.content.overview.updated_at') }}:</strong> {{ date('F d, Y (h:i:s A)', strtotime($discount->created_at)) }} ({{ $discount->updated_at->diffForHumans() }})
                    @if ($discount->trashed())
                        <strong>{{ __('labels.backend.discounts.tabs.content.overview.deleted_at') }}:</strong> {{ date('F d, Y (h:i:s A)', strtotime($discount->deleted_at)) }} ({{ $discount->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
