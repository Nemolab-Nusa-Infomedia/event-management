<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="w-full p-0 font-medium flex flex-col mt-2 gap-2">
            @foreach (config('userNav') as $item)
                <li>
                    <a href="{{ route($item['link']) }}"
                        class="transition-all duration-100 flex items-center p-2 dark:fill:white fill-gray-900 text-gray-900 rounded-lg dark:text-white hover:bg-blue-200 dark:hover:bg-blue-700 hover:fill-black active:bg-blue-300 group @if (Route::is($item['link'])) bg-blue-400 @endif">
                        {!! $item['icon'] !!}

                        <span class="ms-3">{{ $item['name'] }}</span>
                    </a>
                </li>
            @endforeach
            @if (Auth::user()->role == 'admin')
                <li>
                    <a href="{{ route('user.index') }}"
                        class="transition-all duration-100 flex items-center p-2 dark:fill-white fill-gray-900 text-gray-900 rounded-lg dark:text-white hover:bg-blue-200 dark:hover:bg-blue-700 hover:fill-black active:bg-blue-300 group @if (Route::is('user.index')) bg-blue-400 @endif">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M17 10v1.126c.367.095.714.24 1.032.428l.796-.797 1.415 1.415-.797.796c.188.318.333.665.428 1.032H21v2h-1.126c-.095.367-.24.714-.428 1.032l.797.796-1.415 1.415-.796-.797a3.979 3.979 0 0 1-1.032.428V20h-2v-1.126a3.977 3.977 0 0 1-1.032-.428l-.796.797-1.415-1.415.797-.796A3.975 3.975 0 0 1 12.126 16H11v-2h1.126c.095-.367.24-.714.428-1.032l-.797-.796 1.415-1.415.796.797A3.977 3.977 0 0 1 15 11.126V10h2Zm.406 3.578.016.016c.354.358.574.85.578 1.392v.028a2 2 0 0 1-3.409 1.406l-.01-.012a2 2 0 0 1 2.826-2.83ZM5 8a4 4 0 1 1 7.938.703 7.029 7.029 0 0 0-3.235 3.235A4 4 0 0 1 5 8Zm4.29 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h6.101A6.979 6.979 0 0 1 9 15c0-.695.101-1.366.29-2Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ms-3">Users</span>
                    </a>
                </li>
            @endif
            <div>
                <input id="ParticipantDropDown" @if (Route::currentRouteName() == 'event.show') checked @endif type="checkbox"
                    class="sr-only peer" aria-hidden="true">

                <label
                    class="peer-checked:bg-blue-300 transition-all duration-100 flex items-center p-2 relative fill-gray-900 text-gray-900 rounded-lg dark:text-white hover:bg-blue-200 dark:hover:bg-blue-700 hover:fill-black active:bg-blue-300 group"
                    for="ParticipantDropDown">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                            clip-rule="evenodd" />
                    </svg><span class="ms-3">Participant</span>
                    <svg class="absolute right-4 w-2.5 h-2.5 ms-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </label>
                <ul
                    class="mx-2 transition-all duration-100 opacity-0 peer-checked:opacity-100 text-sm dark:bg-slate-900 text-gray-700 bg-gray-50 dark:text-gray-200 hidden peer-checked:block">
                    @if ($myEvents->isEmpty())
                        <li>
                            <p class="block px-4 py-2">
                                {{ Auth::user()->name }} - No Event</p>
                        </li>
                    @else
                        @foreach ($myEvents as $item)
                            <li>
                                <a href="{{ route('event.show', $item->id) }}"
                                    class="{{ Request::url() == route('event.show', $item->id) ? 'hover:bg-gray-300 bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 active:bg-gray-400 ' : 'hover:bg-gray-100 dark:hover:bg-gray-600 active:bg-gray-200 dark:hover:text-white' }} block px-4 py-2 dark:hover:text-white">
                                    {{ $item->name }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>

        </ul>
    </div>
</aside>
