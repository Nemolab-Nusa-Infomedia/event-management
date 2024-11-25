@extends('layouts.app')

@section('title', 'Scan (' . $event->name . ')')

@section('style')
    <style>
        #reader__dashboard_section_csr span {
            display: flex !important;
            flex-direction: column;
            margin: auto !important;
            width: 80%;

            select:where(.dark, .dark *) {
                color: white;
                background: rgb(55 65 81);
                padding: .5rem;
                border: solid 1px rgb(229 231 235);
                border-radius: .5rem;
            }
        }

        #reader__scan_region img {
            margin: auto
        }
    </style>
@stop

@section('script_link')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
@stop

@section('content_header')
    <h1 class="text-2xl font-bold dark:text-gray-200 text-gray-700 mb-4">Event : {{ $event->name }}</h1>
@stop

@section('content')
    <div class="p-4">
        <div id="reader" class="bg-gray-200 dark:bg-gray-700 dark:text-white w-full md:w-96"></div>
        <form class="hidden" method="post" id="scanForm">
            @csrf
            @method('put')
            <input type="hidden" name="status" value="Present">
        </form>
    </div>
@stop

@section('script')
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Handle the scanned code as you like, for example:
            console.log(`Code matched = ${decodedText}`, decodedResult);
        }

        // const formatsToSupport = [
        //     Html5QrcodeSupportedFormats.QR_CODE,
        //     Html5QrcodeSupportedFormats.UPC_A,
        //     Html5QrcodeSupportedFormats.UPC_E,
        //     Html5QrcodeSupportedFormats.UPC_EAN_EXTENSION,
        // ];
        const html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                },
                formatsToSupport: Html5QrcodeSupportedFormats.QR_CODE
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess);
    </script>
@stop
