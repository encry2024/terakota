@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.products.management'))

@section('breadcrumb-links')
    @include('backend.product.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.products.management') }} <small class="text-muted">{{ __('labels.backend.products.list') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.product.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('labels.backend.products.table.code') }}</th>
                            <th>{{ __('labels.backend.products.table.name') }}</th>
                            <th>{{ __('labels.backend.products.table.category') }}</th>
                            <th>{{ __('labels.backend.products.table.price') }}</th>
                            <th>{{ __('labels.backend.products.table.created_at') }}</th>
                            <th>{{ __('labels.backend.products.table.updated_at') }}</th>
                            <th>{{ __('labels.general.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{!! $product->category_name !!}</td>
                                <td>{{ $product->formatted_price }}</td>
                                <td>{{ date('F d, Y (h:i A)', strtotime($product->created_at)) }}</td>
                                <td>{{ date('F d, Y (h:i A)', strtotime($product->updated_at)) }}</td>
                                <td>{!! $product->action_buttons !!}</td>
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
                    {!! $products->total() !!} {{ trans_choice('labels.backend.products.table.total', $products->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $products->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
