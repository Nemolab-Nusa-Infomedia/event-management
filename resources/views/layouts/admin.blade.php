@include('layouts.components.header')
@include('layouts.components.sidebar')

<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14">
        @yield('content')
    </div>
 </div>
 
@yeald('js')