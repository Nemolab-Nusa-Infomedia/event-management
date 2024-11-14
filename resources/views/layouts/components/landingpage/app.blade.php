@include('layouts.components.landingpage.header')

<body class="bg-gray-100 dark:bg-gray-900">
    
    @include('layouts.components.landingpage.navbar')
    
    <div class="min-h-[calc(100svh_-_247px)]">
        @yield('content')
    </div>
    
    @include('layouts.components.landingpage.footer')
</body>