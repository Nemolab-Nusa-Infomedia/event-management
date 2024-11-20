<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            background-color: #1a202c;
            color: #f7fafc;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 2.5rem auto;
            padding: 1.5rem;
            background-color: #2d3748;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #f7fafc;
            margin-bottom: 1.5rem;
        }

        .header img {
            height: 2rem;
            margin-right: 0.75rem;
        }

        .content {
            margin-bottom: 2rem;
            color: #e2e8f0;
        }

        .content h1 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #f7fafc;
            margin-bottom: 1rem;
        }

        .content p {
            margin-bottom: 0.5rem;
        }

        .grid {
            display: grid;
            gap: 1rem;
        }

        .grid-cols-1 {
            grid-template-columns: 1fr;
        }

        @media (min-width: 640px) {
            .grid-cols-2 {
                grid-template-columns: 1fr 1fr;
            }
        }

        .footer {
            color: #a0aec0;
            font-size: 0.875rem;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ asset('vendor/img/Logo.png') }}" alt="OURevent Logo" />
            <span>OURevent - Event Joined</span>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Hello, <strong>{{$user->name}}</strong>!</p>
            <p>You have joined the event: <strong>{{$event->name}}</strong></p>
        </div>

        <!-- User Information -->
        <div class="content">
            <h1>Your Information</h1>
            <div class="grid grid-cols-1 grid-cols-2">
                <p><strong>Name:</strong> {{$user->name}}</p>
                <p><strong>Email:</strong> {{$user->email}}</p>
                <p><strong>Phone:</strong> {{$user->no_telp}}</p>
                <p><strong>Address:</strong> {{$user->alamat}}</p>
            </div>
        </div>

        <!-- Event Details -->
        <div class="content">
            <h1>Event Details</h1>
            <div class="grid grid-cols-1 grid-cols-2" style="color: #e2e8f0">
                <p><strong>Event Name:</strong> {{ $event->name }}</p>
                <p style="color: #e2e8f0"><strong>Event Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</p>
                <p><strong>Event Start:</strong> {{ \Carbon\Carbon::parse($event->event_start)->format('h:i A') }}</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for using OURevent. We look forward to seeing you at the event!</p>
        </div>
    </div>
</body>
</html>
