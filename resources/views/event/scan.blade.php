@extends('layouts.user')

@section('title', 'Peserta (Nama Event)')

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
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
@stop

@section('content_header')
    <h1 class="text-2xl font-bold dark:text-gray-200 text-gray-700 mb-4">Event : {{ $event->name }}</h1>
@stop

@section('content')
    <div id="reader" class="bg-gray-200 dark:bg-gray-700 dark:text-white w-full md:w-96"></div>
    <form class="hidden" method="post" id="scanForm">
        @csrf
        @method('put')
        <input type="hidden" name="status" value="Present">
    </form>
    <script>
        let url = null

        function onScanSuccess(decodedText, decodedResult) {
            url = decodedText;
            $('#scanForm').submit();
        }
        $('#scanForm').on('submit', function(e) {
            e.preventDefault();
            // alert(url)
            $.ajax({
                type: "post",
                url: url,
                data:  $(this).serialize(),
                success: function(response) {
                    console.log(response);
                }
            });

        });

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
