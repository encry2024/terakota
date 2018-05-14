<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('menus.backend.shifts.main') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.shift.index') }}">{{ __('menus.backend.shifts.all') }}</a>
                <a class="dropdown-item" href="{{ route('admin.shift.create') }}">{{ __('menus.backend.shifts.create') }}</a>
                <a class="dropdown-item" href="{{ route('admin.shift.deleted') }}">{{ __('menus.backend.shifts.deleted') }}</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>