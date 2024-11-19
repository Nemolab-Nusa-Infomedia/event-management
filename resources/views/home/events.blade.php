@extends('layouts.user')

@section('content')
    <section id="Events" class="py-16 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100">
        <div class="container mx-auto px-4 text-center">
            <div class="grid grid-cols-[repeat(auto-fit,_minmax(16rem,_1fr))] gap-8" id="content">
                <div
                    class="content-skeleton p-6 shadow-md rounded-lg bg-gray-200 dark:bg-gray-800 text-left hover:scale-105 transform transition duration-300">
                    <div class="w-full h-48 bg-gray-300 rounded-lg mb-4 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-6 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-10 bg-blue-700 rounded-lg dark:bg-blue-800 animate-pulse"></div>
                </div>
                <div
                    class="content-skeleton p-6 shadow-md rounded-lg bg-gray-200 dark:bg-gray-800 text-left hover:scale-105 transform transition duration-300">
                    <div class="w-full h-48 bg-gray-300 rounded-lg mb-4 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-6 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-10 bg-blue-700 rounded-lg dark:bg-blue-800 animate-pulse"></div>
                </div>
                <div
                    class="content-skeleton p-6 shadow-md rounded-lg bg-gray-200 dark:bg-gray-800 text-left hover:scale-105 transform transition duration-300">
                    <div class="w-full h-48 bg-gray-300 rounded-lg mb-4 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-6 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-10 bg-blue-700 rounded-lg dark:bg-blue-800 animate-pulse"></div>
                </div>
                <div
                    class="content-skeleton p-6 shadow-md rounded-lg bg-gray-200 dark:bg-gray-800 text-left hover:scale-105 transform transition duration-300">
                    <div class="w-full h-48 bg-gray-300 rounded-lg mb-4 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-6 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-10 bg-blue-700 rounded-lg dark:bg-blue-800 animate-pulse"></div>
                </div>
                <div
                    class="content-skeleton p-6 shadow-md rounded-lg bg-gray-200 dark:bg-gray-800 text-left hover:scale-105 transform transition duration-300">
                    <div class="w-full h-48 bg-gray-300 rounded-lg mb-4 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-6 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                    <div class="h-10 bg-blue-700 rounded-lg dark:bg-blue-800 animate-pulse"></div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('script')
    <script>
        let createdat = 0
        $(document).ready(function() {
            let index = 20;

            function getEvent() {
                index = 0
                $.ajax({
                    type: "get",
                    url: "{{ route('home.events') }}",
                    data: {
                        'createdAt': createdat,
                    },
                    success: function(response) {
                        console.log(response)
                        // Function to format date
                        function formatDate(dateString) {
                            const options = {
                                year: 'numeric',
                                month: 'long',
                                day: '2-digit'
                            };
                            const date = new Date(dateString);
                            return date.toLocaleDateString('en-US', options);
                        }
                        // Function to format time
                        function formatTime(dateString) {
                            const options = {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            };
                            const date = new Date(dateString);
                            return date.toLocaleTimeString('en-US', options);
                        }
                        response.forEach((data) => {
                            $('#content').append(`
                            <div class="max-w-[540px] p-6 shadow-md rounded-lg bg-gray-200 dark:bg-gray-800 text-left hover:scale-105 transform transition duration-300">
                                <img src="http://localhost:8000/storage/${data['thumbnail_img']}" alt="${data['name']}" class="w-full h-48 object-cover rounded-lg mb-4">
                                <h3 class="text-xl font-semibold mb-2">${data['name']}</h3>
                                <p class="text-gray-700 dark:text-gray-300 mb-2">
                                    <strong>Date:</strong> ${formatDate(data['event_date'])}
                                </p>
                                <p class="text-gray-700 dark:text-gray-300 mb-2">
                                    <strong>Time:</strong> ${formatTime(data['event_start'])}
                                </p>
                                <p class="text-gray-700 dark:text-gray-300 mb-2">
                                    <strong>Location:</strong> ${data['location']}
                                </p>
                                <a href="{{ route('events.preview', '') }}${data['id']}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    See Details
                                </a>
                            </div>
                        `);
                            createdat = data['created_at'];
                            index++;
                            if (index < 20) {
                                $('.content-skeleton').addClass('hidden');
                            } else {
                                $('.content-skeleton').removeClass('hidden');
                                $('.content-skeleton').appendTo('#content');
                            }
                        });
                    }
                });
            }
            // Function to handle the intersection
            function handleIntersection(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (index < 20) {
                            $('.content-skeleton').addClass('hidden');
                        } else {
                            $('.content-skeleton').removeClass('hidden');
                            $('.content-skeleton').appendTo('#content');
                            getEvent();
                        }
                    }
                });
            }

            // Create an Intersection Observer
            const observer = new IntersectionObserver(handleIntersection, {
                root: null, // Use the viewport as the root
                rootMargin: '0px',
                threshold: 0.1 // Trigger when 10% of the element is in view
            });

            // Observe the element with the id 'content-skeleton'
            $('.content-skeleton').each(function() {
                observer.observe(this);
            });
        });
    </script>
@stop
