@extends ('backend.layouts.app')

@section ('title', __('labels.backend.products.management') . ' | ' . __('labels.backend.products.deleted'))

@section('breadcrumb-links')
    @include('backend.product.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.products.management') }}
                    <small class="text-muted">{{ __('labels.backend.products.deleted') }}</small>
                </h4>
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
                                <th>{{ __('labels.backend.products.table.deleted_at') }}</th>
                                <th>{{ __('labels.general.actions') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if ($products->count())
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{!! $product->category !!}</td>
                                    <td>{{ $product->formatted_price }}</td>
                                    <td>{{ date('F d, Y (h:i:s A)', strtotime($product->deleted_at)) }}</td>
                                    <td>{!! $product->action_buttons !!}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="9"><p class="text-center">{{ __('strings.backend.products.no_deleted') }}</p></td></tr>
                        @endif
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
