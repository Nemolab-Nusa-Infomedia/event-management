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

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Juguran Komunitas - Event Joined</h1>

        <div class="section">
            <p>Hello, <strong>{{ $name }}</strong>!</p>
            <p>Your Certificate</p>
            <a href="{{ $pdfUrl }}" class="btn" target="_blank">Download Certificate</a>
        </div>

        <div class="section">
            <p>Thank you for using Juguran Komunitas. We look forward to seeing you at the event!</p>
        </div>
    </div>
</body>

</html>
