<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.dinings.tabs.content.overview.name') }}</th>
                <td>{{ $dining->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.dinings.tabs.content.overview.price') }}</th>
                <td>{{ $dining->formatted_price }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.dinings.tabs.content.overview.description') }}</th>
                <td>{{ $dining->description }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->