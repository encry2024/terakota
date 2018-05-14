<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.discounts.tabs.content.overview.name') }}</th>
                <td>{{ $discount->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.discounts.tabs.content.overview.discount') }}</th>
                <td>{{ $discount->formatted_price }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->