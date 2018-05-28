<!DOCTYPE html>
@langrtl
    <html lang="{{ app()->getLocale() }}" dir="rtl">
@else
    <html lang="{{ app()->getLocale() }}">
@endlangrtl
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'Laravel 5 Boilerplate')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        <link rel="stylesheet" href="{{ asset('js/chosen_v1.8.3/chosen-bootstrap-css.css') }}">
        <link rel="stylesheet" href="{{ asset('js/chosen_v1.8.3/chosen.css') }}">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{ style(mix('css/frontend.css')) }}
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>

        @stack('after-styles')
    </head>
    <body>
        <div id="app">

            @include('includes.partials.logged-in-as')
            @if (!Active::checkUriPattern('cashier/order*'))
            @include('frontend.includes.nav')
            @endif

            <div class="container-fluid">
                @include('includes.partials.messages')
                @yield('content')
            </div><!-- container -->
        </div><!-- #app -->

        <!-- Scripts -->
        @stack('before-scripts')
        {!! script(mix('js/backend.js')) !!}
        @stack('after-scripts')

        @include('includes.partials.ga')

        <script>
            const numericField = document.getElementsByClassName('numeric-input');

            for(let elementIndex=0; elementIndex<numericField.length; elementIndex++) {
                new Cleave(numericField[elementIndex], {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
            }
        </script>
    </body>
</html>
