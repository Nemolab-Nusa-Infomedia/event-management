@extends('layouts.app')

@section('content')
    <section class="py-4 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100">
        <div class="mx-auto px-4 text-center mb-14">
            <div class="mb-4">
                <select id="sort-select"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="upcoming">Upcoming Events</option>
                    <option value="newest">Newest</option>
                    <option value="all">All Events</option>
                </select>
            </div>
            <div id="event-container">
                <div id="content" class="grid grid-cols-[repeat(auto-fit,_minmax(16rem,_1fr))] justify-center gap-8">
                    @for ($i = 0; $i < 5; $i++)
                        <div
                            class="content-skeleton p-6 shadow-md rounded-lg bg-gray-200 dark:bg-gray-800 text-left hover:scale-105 transform transition duration-300">
                            <div class="w-full h-48 bg-gray-300 rounded-lg mb-4 dark:bg-gray-700 animate-pulse"></div>
                            <div class="h-6 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                            <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                            <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                            <div class="h-4 bg-gray-300 rounded-full mb-2 dark:bg-gray-700 animate-pulse"></div>
                            <div class="h-10 bg-blue-700 rounded-lg dark:bg-blue-800 animate-pulse"></div>
                        </div>
                    @endfor
                </div>
                <div id="skeleton-container"
                    class="grid grid-cols-[repeat(auto-fit,_minmax(16rem,_1fr))] justify-center gap-8">

                </div>
            </div>
        </div>
    </section>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            const url = new URL(window.location.href);
            const searchParams = new URLSearchParams(url.search);
            let searchQuery = searchParams.get('search');
            const searchInput = $('#topbar-search');
            $(searchInput).val(searchQuery);

            const contentSkeleton = $('.content-skeleton');

            let createdat = 0;
            let eventdate = 0;
            let evenstart = 0;
            let lastid = 0;
            let loading = false;
            const ITEMS_PER_PAGE = 20;


            const statusClasses = {
                ongoing: 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                ended: 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                upcoming: 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300'
            };

            function search() {

            }

            function getEventStatusClass(status) {
                return statusClasses[status] || '';
            }

            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            function renderEventCard(data) {
                const statusClass = getEventStatusClass(data.status);

                return `
            <div class="max-w-[540px] p-6 shadow-md rounded-lg bg-gray-200 dark:bg-gray-800 text-left hover:scale-105 transform transition duration-300">
                <div class="relative">
                    <img src="/storage/${data.thumbnail_img}" 
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
        `;
            }

            function showSkeleton() {
                $('#content').append(contentSkeleton);
                // $(contentSkeleton).removeClass('hidden');
                // $('#skeleton-container').show();
            }

            function hideSkeleton() {
                $('#skeleton-container').append(contentSkeleton);
                $('#skeleton-container').hide();
                // $(contentSkeleton).addClass('hidden');
            }

            function moveSkeleton() {
                $('#content').append(contentSkeleton);
            }

            function getEvents() {
                if (loading) return;
                loading = true;

                $.ajax({
                    type: "get",
                    url: "{{ route('home.events') }}",
                    data: {
                        'createdAt': createdat,
                        'eventDate': eventdate,
                        'eventStart': evenstart,
                        'lastId': lastid,
                        'sort': $('#sort-select').val(),
                        'search': searchQuery,
                    },
                    success: function(response) {
                        hideSkeleton();
                        // moveSkeleton();
                        console.log(response);
                        if (response.length === 0) {
                            if ($('#content').children().length === 0) {
                                $('#content').html(
                                    '<div class="col-span-full text-center text-gray-500">No events found</div>'
                                );
                                hideSkeleton();
                            } else {
                                hideSkeleton();
                            }
                            loading = false;
                            return;
                        }

                        response.forEach(data => {
                            $('#content').append(renderEventCard(data));
                        });

                        const lastItem = response[response.length - 1];
                        createdat = lastItem.created_at;
                        eventdate = lastItem.event_date;
                        evenstart = lastItem.event_start;
                        lastid = lastItem.id;
                        if (response.length < ITEMS_PER_PAGE) {
                            hideSkeleton();
                        } else {
                            showSkeleton();
                        }

                        loading = false;
                    },
                    error: function() {
                        loading = false;
                        hideSkeleton();
                    }
                });
            }

            // Event handlers
            $('#sort-select').change(function() {
                createdat = 0;
                eventdate = 0;
                lastid = 0;
                evenstart = 0;
                $('#content').empty();
                showSkeleton();
                getEvents();
            });

            // Infinite scroll
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            getEvents();
                        }
                    });
                }, {
                    rootMargin: '50px',
                    threshold: 0.1
                }
            );

            // Observe the skeleton container
            contentSkeleton.each(function(index, element) {
                observer.observe(element);
            });

            // Initial load
            getEvents();
        });
    </script>
@stop
