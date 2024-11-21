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
        let createdat = 0;
        let loading = false;

        $(document).ready(function() {
            let index = 20;

            function getEventStatusClass(status) {
                switch(status) {
                    case 'ongoing':
                        return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300';
                    case 'ended':
                        return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300';
                    case 'upcoming':
                        return 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300';
                    default:
                        return '';
                }
            }

            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            function getEvent() {
                if(loading) return;
                loading = true;
                
                $.ajax({
                    type: "get", 
                    url: "{{ route('home.events') }}",
                    data: {
                        'createdAt': createdat,
                        'sort': $('#sort-select').val()
                    },
                    success: function(response) {
                        if(response.length === 0) {
                            $('.content-skeleton').addClass('hidden');
                            if (index === 20) {
                                $('#content').html('<div class="col-span-full text-center text-gray-500">No events found</div>');
                            }
                            loading = false;
                            return;
                        }

                        $('.content-skeleton').addClass('hidden');
                        
                        response.forEach((data) => {
                            const statusClass = getEventStatusClass(data.status);
                            
                            $('#content').append(`
                                <div class="max-w-[540px] p-6 shadow-md rounded-lg bg-gray-200 dark:bg-gray-800 text-left hover:scale-105 transform transition duration-300">
                                    <div class="relative">
                                        <img src="http://localhost:8000/storage/${data.thumbnail_img}" 
                                            alt="${data.name}" 
                                            class="w-full h-48 object-cover rounded-lg mb-4">
                                        <span class="absolute top-2 right-2 px-2 py-1 rounded-full text-sm ${statusClass}">
                                            ${capitalizeFirstLetter(data.status)}
                                        </span>
                                    </div>
                                    <h3 class="text-xl font-semibold mb-2">${data.name}</h3>
                                    <p class="text-gray-700 dark:text-gray-300 mb-2">
                                        <strong>Date:</strong> ${data.formatted_date}
                                    </p>
                                    <p class="text-gray-700 dark:text-gray-300 mb-2">
                                        <strong>Time:</strong> ${data.formatted_start} - ${data.formatted_end}
                                    </p>
                                    <p class="text-gray-700 dark:text-gray-300 mb-2">
                                        <strong>Location:</strong> ${data.location}
                                    </p>
                                    <a href="{{ route('events.preview', '') }}/${data.id}" 
                                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                        See Details
                                    </a>    
                                </div>
                            `);
                        });

                        createdat = response[response.length - 1].created_at;
                        index = response.length;
                        if (index >= 20) {
                            $('.content-skeleton').removeClass('hidden').appendTo('#content');
                        }
                        loading = false;
                    },
                    error: function() {
                        loading = false;
                        $('.content-skeleton').addClass('hidden');
                    }
                });
            }

            // Add sort select
            $('#content').before(`
                <div class="mb-4">
                    <select id="sort-select" class="rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        <option value="upcoming">Upcoming Events</option>
                        <option value="all">All Events</option>
                    </select>
                </div>
            `);

            $('#sort-select').change(function() {
                createdat = 0;
                index = 20;
                $('#content').empty();
                getEvent();
            });

            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && index >= 20) {
                            getEvent();
                        }
                    });
                },
                {
                    root: null,
                    rootMargin: '0px',
                    threshold: 0.1
                }
            );

            $('.content-skeleton').each(function() {
                observer.observe(this);
            });

            // Initial load
            getEvent();
        });
    </script>
@stop
