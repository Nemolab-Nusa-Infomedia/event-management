@include('layouts.components.header')
@include('layouts.components.dashboard.navbar')
@include('layouts.components.sidebar')

<body class=" dark:bg-slate-900">

    <div class="p-4 sm:ml-64 min-h-svh">
        <div class="p-4 mt-14">
            @yield('content_header')
            @yield('content')
        </div>
    </div>

</body>

@include('layouts.components.footer')
