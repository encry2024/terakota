<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('menus.backend.discounts.main') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.discount.index') }}">{{ __('menus.backend.discounts.all') }}</a>
                <a class="dropdown-item" href="{{ route('admin.discount.create') }}">{{ __('menus.backend.discounts.create') }}</a>
                <a class="dropdown-item" href="{{ route('admin.discount.deleted') }}">{{ __('menus.backend.discounts.deleted') }}</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>