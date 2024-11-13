@include('layouts.components.header')
@include('layouts.components.sidebar')

<div class="p-4 sm:ml-64 dark:bg-slate-900 min-h-svh">
    <div class="p-4 mt-14">
        @yield('content_header')
        @yield('content')
    </div>
 </div>

 @include('layouts.components.footer')
 
