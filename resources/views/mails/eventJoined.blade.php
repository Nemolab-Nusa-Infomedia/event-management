@include('layouts.components.header')
<body class="bg-gray-900 text-gray-100">
    <div class="container mx-auto mt-10 p-6 bg-gray-800 rounded-lg shadow-lg">
        <!-- Header -->
        <div class="header flex items-center text-left text-2xl font-bold text-gray-100 mb-6">
            <img src="{{ asset('vendor/img/Logo.png') }}" class="h-8 mr-3" alt="OURevent Logo" />
            <span class="text-xl font-semibold whitespace-nowrap">OURevent - Event Joined</span>
        </div>

        <!-- Content -->
        <div class="content text-left text-gray-300 mb-8">
            <p>Hello, <strong>{{$user->name}}</strong>!</p>
            <p>You have joined the event: <strong>{{$event->name}}</strong></p>
        </div>

        <!-- User Information -->
        <div class="content text-left text-gray-300 mb-8">
            <h1 class="text-2xl font-bold text-gray-100 mb-4">Your Information</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <p><strong>Name:</strong> {{$user->name}}</p>
                <p><strong>Email:</strong> {{$user->email}}</p>
                <p><strong>Phone:</strong> {{$user->no_telp}}</p>
                <p><strong>Address:</strong> {{$user->alamat}}</p>
            </div>
        </div>

        <!-- Event Details -->
        <div class="content text-left text-gray-300 mb-8">
            <h1 class="text-2xl font-bold text-gray-100 mb-4">Event Details</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <p><strong>Event Name:</strong> {{$event->name}}</p>
                <p><strong>Event Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</p>    
                <p><strong>Event Start:</strong> {{ \Carbon\Carbon::parse($event->event_start)->format('h:i A') }}</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer text-left text-gray-400 mt-6 text-sm">
            <p>Thank you for using OURevent. We look forward to seeing you at the event!</p>
        </div>
    </div>
</body>
</html>
