<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.products.tabs.content.overview.code') }}</th>
                <td>{{ $product->code }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.products.tabs.content.overview.name') }}</th>
                <td>{{ $product->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.products.tabs.content.overview.category') }}</th>
                <td>{!! $product->category_name !!}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.products.tabs.content.overview.price') }}</th>
                <td>{{ $product->formatted_price }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.products.tabs.content.overview.created_at') }}</th>
                <td>{{ date('F d, Y (h:i:s A)', strtotime($product->created_at)) }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.products.tabs.content.overview.updated_at') }}</th>
                <td>{{ date('F d, Y (h:i:s A)', strtotime($product->updated_at)) }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->