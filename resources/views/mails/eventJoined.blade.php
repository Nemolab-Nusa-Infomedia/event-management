<!DOCTYPE html>
<html>

<head>
    <title>Juguran Komunitas - Event Joined</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .qr-code {
            text-align: center;
            margin: 20px 0;
        }

        .section {
            margin-bottom: 20px;
        }

        .label {
            font-weight: bold;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Juguran Komunitas</h1>

        <div class="section">
            <p>Hello, <strong>{{ $user['name'] }}</strong>!</p>
            <p>You have joined the event: <strong>{{ $event->name }}</strong></p>
        </div>

        <div class="qr-code">
            <h3>Your Event QR Code</h3>
            <img src="{{ $message->embed($qrCodePath) }}" alt="QR Code">
            <p>Please show this QR code when attending the event</p>
        </div>

        <div class="section">
            <h3>Your Information</h3>
            <p><span class="label">Name:</span> {{ $user['name'] }}</p>
            <p><span class="label">Email:</span> {{ $user['email'] }}</p>
            <p><span class="label">Phone:</span> {{ $user['no_telp'] }}</p>
            <p><span class="label">Instansi:</span> {{ $user['alamat'] }}</p>
        </div>

        <div class="section">
            <h3>Event Details</h3>
            <p><span class="label">Event Name:</span> {{ $event->name }}</p>
            <p><span class="label">Event Date:</span> {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}
            </p>
            <p><span class="label">Event Start:</span>
                {{ \Carbon\Carbon::parse($event->event_start)->format('h:i A') }}</p>
        </div>

        <div class="section">
            <p>Thank you for using Juguran Komunitas. We look forward to seeing you at the event!</p>
        </div>
    </div>
</body>

</html>
