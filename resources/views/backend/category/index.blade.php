@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.categories.management'))

@section('breadcrumb-links')
    @include('backend.category.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.categories.management') }} <small class="text-muted">{{ __('labels.backend.categories.list') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.category.includes.header-buttons')
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
                            <th>{{ __('labels.backend.categories.table.created_at') }}</th>
                            <th>{{ __('labels.backend.categories.table.updated_at') }}</th>
                            <th>{{ __('labels.general.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->products_count }}</td>
                                <td>{{ date('F d, Y (h:i A)', strtotime($category->created_at)) }}</td>
                                <td>{{ date('F d, Y (h:i A)', strtotime($category->updated_at)) }}</td>
                                <td>{!! $category->action_buttons !!}</td>
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
