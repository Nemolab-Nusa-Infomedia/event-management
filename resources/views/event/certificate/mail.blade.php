<!DOCTYPE html>
<html>

<head>
    <title>OURevent - Event Joined</title>
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
        <h1>OURevent - Event Joined</h1>

        <div class="section">
            <p>Hello, <strong>{{ $name }}</strong>!</p>
            <p>Your Certificate</strong></p>
             <a href="{{ $pdfUrl }}" target="_blank">Download Certificate</a>
        </div>


        <div class="section">
            <p>Thank you for using OURevent. We look forward to seeing you at the event!</p>
        </div>
    </div>
</body>

</html>
