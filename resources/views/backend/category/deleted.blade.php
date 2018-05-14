@extends ('backend.layouts.app')

@section ('title', __('labels.backend.categories.management') . ' | ' . __('labels.backend.categories.deleted'))

@section('breadcrumb-links')
    @include('backend.category.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.categories.management') }}
                    <small class="text-muted">{{ __('labels.backend.categories.deleted') }}</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('labels.backend.categories.table.name') }}</th>
                                <th>{{ __('labels.backend.categories.table.product_count') }}</th>
                                <th>{{ __('labels.backend.categories.table.deleted_at') }}</th>
                                <th>{{ __('labels.general.actions') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if ($categories->count())
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->products_count }}</td>
                                    <td>{{ date('F d, Y (h:i:s A)', strtotime($category->deleted_at)) }}</td>
                                    <td>{!! $category->action_buttons !!}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="9"><p class="text-center">{{ __('strings.backend.categories.no_deleted') }}</p></td></tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $categories->total() !!} {{ trans_choice('labels.backend.categories.table.total', $categories->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $categories->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
