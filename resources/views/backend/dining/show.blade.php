@extends ('backend.layouts.app')

@section ('title', __('labels.backend.dinings.management') . ' | ' . __('labels.backend.dinings.view', ['name' => $dining->name]))

@section('breadcrumb-links')
    @include('backend.dining.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.dinings.management') }}
                    <small class="text-muted">{{ __('labels.backend.dinings.view', ['name' => $dining->name]) }}</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-tag"></i> {{ __('labels.backend.dinings.tabs.titles.overview') }}</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                        @include('backend.dining.show.tabs.overview')
                    </div><!--tab-->
                </div><!--tab-content-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>{{ __('labels.backend.dinings.tabs.content.overview.created_at') }}:</strong> {{ date('F d, Y (h:i:s A)', strtotime($dining->updated_at)) }} ({{ $dining->created_at->diffForHumans() }}),
                    <strong>{{ __('labels.backend.dinings.tabs.content.overview.updated_at') }}:</strong> {{ date('F d, Y (h:i:s A)', strtotime($dining->created_at)) }} ({{ $dining->updated_at->diffForHumans() }})
                    @if ($dining->trashed())
                        <strong>{{ __('labels.backend.dinings.tabs.content.overview.deleted_at') }}:</strong> {{ date('F d, Y (h:i:s A)', strtotime($dining->deleted_at)) }} ({{ $dining->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
