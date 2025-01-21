<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate</title>

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body{
            margin: 0;
            padding: 0;
            background-image: url('{{ url('sertif.png') }}');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            width: 100%;
            height: 100%;
        }

        .sertificate{
            position: absolute;
            top: 49%;
            left: 50%;
            transform: translate(-50%, -50%); /* Pusatkan konten secara vertikal dan horizontal */
            text-align: center;
            color: var(--color-c6);
            width: 100%;
        }

        .sertificate span{
            font-size: 60px;
            font-weight: 800;
            color: #263581;
        }
    </style>
</head>
<body>
    <div class="sertificate">
        <span>{{ $name }}</span>
    </div>

</body>
</html>