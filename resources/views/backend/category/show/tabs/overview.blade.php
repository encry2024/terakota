<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.categories.tabs.content.overview.name') }}</th>
                <td>{{ $category->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.categories.tabs.content.overview.product_count') }}</th>
                <td>{{ $category->products->count() }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->