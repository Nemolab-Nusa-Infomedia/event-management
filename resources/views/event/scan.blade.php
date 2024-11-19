@extends('layouts.user')

@section('title', 'Peserta (Nama Event)')

@section('script_link')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
@stop

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

@section('content_header')
    <h1 class="text-2xl font-bold dark:text-gray-200 text-gray-700 mb-4">Event : {{ $event->name }}</h1>
@stop

@section('content')
    <div id="reader" class="bg-gray-200 dark:bg-gray-700 dark:text-white w-full md:w-96"></div>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            // console.log(`Code matched = ${decodedText}`, decodedResult);
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@stop
