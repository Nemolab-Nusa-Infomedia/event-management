@include('layouts.components.header')

<body class=" dark:bg-slate-900">
    @include('layouts.components.landingpage.navbar')
    @include('layouts.components.sidebar')
    <div class="p-4 sm:ml-64 min-h-svh peer-checked:sm:ml-14">
        <div class="p-4 mt-14">
            @yield('content_header')
            @yield('content')
        </div>
    </div>

</body>
@yield('script')

@include('layouts.components.footer')
