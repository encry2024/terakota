<li class="breadcrumb-menu non-printable">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('menus.backend.sales.main') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.report.sales.index') }}">{{ __('menus.backend.sales.all') }}</a>
                <a class="dropdown-item" data-toggle="modal" data-target="#filterModal" style="cursor: pointer;">{{ __('menus.backend.sales.filter') }}</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>