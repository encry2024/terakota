<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.shifts.tabs.content.overview.name') }}</th>
                <td>{{ $shift->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.shifts.tabs.content.overview.user') }}</th>
                <td>{{ $shift->user->full_name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.shifts.tabs.content.overview.time_start') }}</th>
                <td>{{ $shift->time_start }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.shifts.tabs.content.overview.time_end') }}</th>
                <td>{{ $shift->time_end }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->