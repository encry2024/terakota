<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('menus.backend.products.main') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.product.index') }}">{{ __('menus.backend.products.all') }}</a>
                <a class="dropdown-item" href="{{ route('admin.product.create') }}">{{ __('menus.backend.products.create') }}</a>
                <a class="dropdown-item" href="{{ route('admin.product.deleted') }}">{{ __('menus.backend.products.deleted') }}</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>