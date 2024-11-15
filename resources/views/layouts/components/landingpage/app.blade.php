@include('layouts.components.landingpage.header')

<body onload="AOS.init();" class="bg-gray-100 dark:bg-gray-900 dark:text-white">

    @include('layouts.components.landingpage.navbar')
    @include('layouts.components.sidebar')

    <div class="sm:ml-64 peer-checked:sm:ml-14 min-h-svh mt-14">
        @yield('content')
    </div>

    @include('layouts.components.landingpage.footer')
    @include('layouts.components.footer')
</body>
