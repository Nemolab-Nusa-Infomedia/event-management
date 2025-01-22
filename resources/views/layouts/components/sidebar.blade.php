<aside id="logo-sidebar"
    class="fixed top-16 bottom-0 flex flex-col overflow-x-hidden justify-between peer-checked:max-w-16 left-0 z-10 min-w-64 sm:min-w-16 w-64 min-h-[calc(100svh_-_4rem)] transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 bg-white dark:bg-gray-800">
        <ul class="w-full p-0 font-medium flex flex-col mt-2 gap-2">
            <li>
                <a href="/"
                    class="transition-all duration-100 flex items-center p-2 dark:fill:white fill-gray-900 text-gray-900 rounded-lg dark:text-white hover:bg-blue-200 dark:hover:bg-blue-700 hover:fill-black active:bg-blue-300 group @if (Route::is('welcome')) bg-blue-400 @endif">
                    <svg class="min-w-6 min-h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="ms-5 text-nowrap">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('home.events') }}"
                    class="transition-all duration-100 flex items-center p-2 dark:fill:white fill-gray-900 text-gray-900 rounded-lg dark:text-white hover:bg-blue-200 dark:hover:bg-blue-700 hover:fill-black active:bg-blue-300 group @if (Route::is('home.events')) bg-blue-400 @endif">
                    <svg class="min-w-6 min-h-6 text-gray-800 dark:text-white" aria-hidden="true" 
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" 
                        viewBox="0 0 24 24"><path fill-rule="evenodd" 
                            d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" 
                            clip-rule="evenodd"/>
                    </svg>

                    <span class="ms-5 text-nowrap">Events</span>
                </a>
            </li>
            @auth
                @foreach (config('userNav') as $item)
                    @if ($item['access'] == 'all')
                        <li>
                            <a href="{{ route($item['link']) }}"
                                class="transition-all duration-100 flex items-center p-2 dark:fill:white fill-gray-900 text-gray-900 rounded-lg dark:text-white hover:bg-blue-200 dark:hover:bg-blue-700 hover:fill-black active:bg-blue-300 group @if (Route::is($item['link'])) bg-blue-400 @endif">
                                {!! $item['icon'] !!}

                                <span class="ms-5 text-nowrap">{{ $item['name'] }}</span>
                            </a>
                        </li>
                    @elseif($item['access'] == 'admin' && Auth::user()->role == 'admin')
                        <li>
                            <a href="{{ route($item['link']) }}"
                                class="transition-all duration-100 flex items-center p-2 dark:fill:white fill-gray-900 text-gray-900 rounded-lg dark:text-white hover:bg-blue-200 dark:hover:bg-blue-700 hover:fill-black active:bg-blue-300 group @if (Route::is($item['link'])) bg-blue-400 @endif">
                                {!! $item['icon'] !!}

                                <span class="ms-5 text-nowrap">{{ $item['name'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
                <div class="">
                    <input id="ParticipantDropDown" @if (Route::currentRouteName() == 'event.show') checked @endif type="checkbox"
                        class="sr-only peer" aria-hidden="true"
                        onchange="$(document).ready(function () {$('#ParticipantDropDown').prop('checked') ? $('#smallSidebar').prop('checked', false) : ''});">
                    <label
                        class="peer-checked:bg-blue-300 transition-all duration-100 flex items-center p-2 relative fill-gray-900 text-gray-900 rounded-lg dark:text-white hover:bg-blue-200 dark:hover:bg-blue-700 hover:fill-black active:bg-blue-300 group"
                        for="ParticipantDropDown">
                        <svg class="min-w-6 min-h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                clip-rule="evenodd" />
                        </svg><span class="ms-5 text-nowrap">Participant</span>
                        <svg class="absolute right-4 w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </label>
                    <ul
                        class="mx-2 transition-all @if(Auth::check() && Auth::user()->role == 'admin') max-h-[calc(100svh_-_37rem)] @elseif(Auth::check() && Auth::user()->role == 'user') max-h-[calc(100svh_-_34rem)] @endif overflow-y-auto duration-100 opacity-0 peer-checked:opacity-100 text-sm dark:bg-slate-900 text-gray-700 bg-gray-50 dark:text-gray-200 hidden peer-checked:block">
                        @if ($myEvents->isEmpty())
                            <li>
                                <p class="block px-4 py-2">
                                    {{ Auth::user()->name }} - No Event</p>
                            </li>
                        @else
                            @foreach ($myEvents as $item)
                                <li>
                                    <a href="{{ route('event.show', $item->id) }}"
                                        class="{{ Request::url() == route('event.show', $item->slug) ? 'hover:bg-gray-300 bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 active:bg-gray-400 ' : 'hover:bg-gray-100 dark:hover:bg-gray-600 active:bg-gray-200 dark:hover:text-white' }} block px-4 py-2 dark:hover:text-white">
                                        {{ $item->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            @endauth

        </ul>
    </div>
</aside>
