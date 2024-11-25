@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    @include('layouts.components.profile.app')

    <div class="text-black dark:text-white px-4">
        <div class="flex xl:flex-row flex-col xl:gap-0 gap-4">
            <div class="p-2 border border-gray-400 rounded-lg xl:rounded-l-lg xl:rounded-r-none grow">
                <div class=""><span class="text-gray-400 mr-2">Name :</span>{{ Auth::user()->name }}</div>
            </div>
            <div class="p-2 border border-gray-400 rounded-lg xl:rounded-r-lg xl:rounded-l-none grow">
                <div class=""><span class="text-gray-400 mr-2">Email :</span>{{ Auth::user()->email }}</div>
            </div>
        </div>

        <form action="{{ route('change-personal-data', Auth::id()) }}" method="post" class="mt-4 flex flex-col gap-4">
            @csrf
            <div>
                <h4 class="mb-2">Phone Number</h4>
                <div class="flex relative">
                    <label for="dial_phone" id="dial" onclick="$('#dial_phone').focus()"
                        class="absolute left-3 w-12 text-center top-2 h-6 bg-gray-50 text-gray-900 dark:bg-gray-700 dark:text-white">+93    </label>
                    <select id="dial_phone" onchange="$('#dial').text($(this).val())" name="dial_phone"
                        class="bg-gray-50 border border-gray-300 text-gray-900 focus-visible:outline-none text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-w-20">
                        @foreach (config('phoneCode') as $item)
                            <option value="{{ $item['dial_code'] }}">
                                {{ $item['dial_code'] . ' ' . $item['name'] }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="no_hp" id=""
                        class="bg-gray-50 border focus-visible:outline-none border-gray-300 text-gray-900 text-sm rounded-r-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 "
                        placeholder="Phone Number" value="{{ Auth::user()->no_telp }}">
                </div>
            </div>
            <div>
                <h4 class="mb-2">Address</h4>
                <div id="normal_address" class="">
                    <textarea name="address" id="alamat" cols="30" rows="10"
                        class="bg-gray-50 border focus-visible:outline-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>
                <div id="indonesian_address" class="grid grid-cols-1 md:grid-cols-2 gap-4 hidden">
                    <div class="relative">
                        <input type="text" id="Provinsi" name="provinsi"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />
                        <label for="Provinsi"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 transition-transform duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Provinsi</label>
                    </div>
                    <div class="relative">
                        <input type="text" id="Kabupaten" name="kabupaten"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />
                        <label for="Kabupaten"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 transition-transform duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Kabupaten</label>
                    </div>
                    <div class="relative">
                        <input type="text" id="Kecamatan" name="kecamatan"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />
                        <label for="Kecamatan"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 transition-transform duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Kecamatan</label>
                    </div>
                    <div class="relative">
                        <input type="text" id="Desa" name="desa"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />
                        <label for="Desa"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 transition-transform duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Desa</label>
                    </div>
                    <div class="relative md:col-span-2">
                        <input type="text" id="Additional" name="additional"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />
                        <label for="Additional"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 transition-transform duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Additional</label>
                    </div>
                </div>

            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-full">Save</button>
        </form>

    </div>

@stop

@section('script')
    <script>
        $(document).ready(function() {
            $('#dial_phone').change(function() {
                if ($('#dial_phone').val() == '+62') {
                    $('#normal_address').addClass('hidden');
                    $('#indonesian_address').removeClass('hidden');
                } else {
                    $('#normal_address').removeClass('hidden');
                    $('#indonesian_address').addClass('hidden');
                }
            });
        });
    </script>
@stop
