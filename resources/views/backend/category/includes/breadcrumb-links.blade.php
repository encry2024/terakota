<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('menus.backend.categories.main') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.category.index') }}">{{ __('menus.backend.categories.all') }}</a>
                <a class="dropdown-item" href="{{ route('admin.category.create') }}">{{ __('menus.backend.categories.create') }}</a>
                <a class="dropdown-item" href="{{ route('admin.category.deleted') }}">{{ __('menus.backend.categories.deleted') }}</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>