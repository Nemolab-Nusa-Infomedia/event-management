@extends('layouts.components.landingpage.app')

@section('content') 
<div class="container mx-auto p-4 sm:p-8 mb-4">  
    <div class="w-full h-64 rounded-lg shadow-lg overflow-hidden mb-4" data-aos="fade-up" data-aos-offset="100">
        <div class="scroll-container">
            <img src="{{ asset('vendor/img/wallpaperflare.com_wallpaper (14).jpg') }}" 
                 alt="Event Image" 
                 class="w-auto h-full object-cover">
        </div>
    </div>
    <p class="text-gray-500 dark:text-gray-300"><strong>Wednesday</strong>, March 15, 2024</p>
    <h1 class="flex text-3xl sm:text-5xl dark:text-gray-200 font-bold text-gray-700 mb-8">Nama Event   
        <button data-modal-target="edit-event-name" data-modal-toggle="edit-event-name" class="text-blue-600 dark:text-blue-600 hover:text-gray-500">
            <svg class="w-[16px] h-[16px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
              </svg>              
        </button>
    </h1>
    <div class="flex items-center" data-aos="fade-up" data-aos-offset="100">
        <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
        <p class="mx-4">by <strong>Username</strong></p>
    </div>
</div>



<section id="info" class="container mx-auto p-4 sm:p-16 mb-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100" data-aos="fade-up" data-aos-offset="100">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-12 items-start">
        <div>
            <div class="p-4 sm:p-8 mb-6">
                <h1 class="text-2xl sm:text-3xl dark:text-gray-200 font-bold text-gray-700 mb-4">Date & Time
                    <button data-modal-target="edit-event-datetime" data-modal-toggle="edit-event-datetime" class="text-blue-600 dark:text-blue-600 hover:text-gray-500">
                        <svg class="w-[16px] h-[16px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                          </svg>              
                    </button>
                </h1>     
                <p class="flex items-center">
                    <svg class="mx-2 w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" clip-rule="evenodd"/>
                      </svg>                      
                    March 15, 2024 | <svg class="mx-2 w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"/>
                    </svg> 10:00 AM - 12:00 PM
                </p>
            </div>
            <div class="p-4 sm:p-8 mb-6">
                <h1 class="text-2xl sm:text-3xl dark:text-gray-200 font-bold text-gray-700 mb-4">Location
                    <button data-modal-target="edit-event-location" data-modal-toggle="edit-event-location" class="text-blue-600 dark:text-blue-600 hover:text-gray-500">
                        <svg class="w-[16px] h-[16px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                          </svg>
                    </button>
                </h1>     
                <p class="flex items-center">
                    <svg class="mx-2 w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518Z"/>
                    </svg>          
                    Jl. Jenderal Sudirman No. 1, Jakarta Pusat
                </p>
            </div>
            <div class="p-4 sm:p-8 mb-6">
                <h1 class="text-2xl sm:text-3xl dark:text-gray-200 font-bold text-gray-700 mb-4">About This Event
                    <button data-modal-target="edit-event-description" data-modal-toggle="edit-event-description" class="text-blue-600 dark:text-blue-600 hover:text-gray-500">
                        <svg class="w-[16px] h-[16px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                          </svg>
                    </button>
                </h1>     
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quaem?</p>
                <button data-modal-target="edit-event-name" data-modal-toggle="edit-event-name" class="block mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Join
                </button>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-1 lg:grid-cols-2 gap-2" data-aos="zoom-in" data-aos-offset="100">
            <!-- Input File 1 -->
            <div>
                <label for="file-upload-1" class="cursor-pointer">
                    <div id="default-1" class="transform transition duration-300 hover:scale-105 h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] max-w-full rounded-lg justify-center items-center flex bg-gray-50 dark:bg-gray-700">
                        <svg class="w-[50px] h-[50px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        Add Photo
                    </div>
                    <img id="preview-1" class="hidden transform transition duration-300 hover:scale-105 object-cover h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] rounded-lg border border-gray-300" src="" alt="Preview">
                </label>
                <input id="file-upload-1" type="file" accept="image/*" class="hidden" onchange="previewImage(event, 'preview-1', 'default-1')">
            </div>
        
            <!-- Input File 2 -->
            <div>
                <label for="file-upload-2" class="cursor-pointer">
                    <div id="default-2" class="transform transition duration-300 hover:scale-105 h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] max-w-full rounded-lg justify-center items-center flex bg-gray-50 dark:bg-gray-700">
                        <svg class="w-[50px] h-[50px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        Add Photo
                    </div>
                    <img id="preview-2" class="hidden transform transition duration-300 hover:scale-105 object-cover h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] rounded-lg border border-gray-300" src="" alt="Preview">
                </label>
                <input id="file-upload-2" type="file" accept="image/*" class="hidden" onchange="previewImage(event, 'preview-2', 'default-2')">
            </div>
        
            <!-- Input File 3 -->
            <div>
                <label for="file-upload-3" class="cursor-pointer">
                    <div id="default-3" class="transform transition duration-300 hover:scale-105 h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] max-w-full rounded-lg justify-center items-center flex bg-gray-50 dark:bg-gray-700">
                        <svg class="w-[50px] h-[50px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        Add Photo
                    </div>
                    <img id="preview-3" class="hidden transform transition duration-300 hover:scale-105 object-cover h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] rounded-lg border border-gray-300" src="" alt="Preview">
                </label>
                <input id="file-upload-3" type="file" accept="image/*" class="hidden" onchange="previewImage(event, 'preview-3', 'default-3')">
            </div>
        
            <!-- Input File 4 -->
            <div>
                <label for="file-upload-4" class="cursor-pointer">
                    <div id="default-4" class="transform transition duration-300 hover:scale-105 h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] max-w-full rounded-lg justify-center items-center flex bg-gray-50 dark:bg-gray-700">
                        <svg class="w-[50px] h-[50px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        Add Photo
                    </div>
                    <img id="preview-4" class="hidden transform transition duration-300 hover:scale-105 object-cover h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] rounded-lg border border-gray-300" src="" alt="Preview">
                </label>
                <input id="file-upload-4" type="file" accept="image/*" class="hidden" onchange="previewImage(event, 'preview-4', 'default-4')">
            </div>
        </div>        
    </div>    
</section>

<!-- Modal Nama Event -->
<div id="edit-event-name" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed bg-black/50 dark:bg-black/0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Event Name
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-event-name">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                </div>
                <button type="submit" class="block mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                  Save Changes
              </button>
            </form>
        </div>
    </div>
</div>   

<!-- Modal Date&time Event -->
<div id="edit-event-datetime" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed bg-black/50 dark:bg-black/0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Event Date & Time
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-event-datetime">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                        <input type="date" placeholder="*Event date*" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start</label>
                        <input type="time" placeholder="*Event date*" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End</label>
                        <input type="time" placeholder="*Event date*" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                </div>    
                <button type="submit" class="block mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                  Save Changes
              </button>
            </form>
        </div>
    </div>
</div>   

<!-- Modal Location Event -->
<div id="edit-event-location" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed bg-black/50 dark:bg-black/0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Event Location
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-event-location">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                        <textarea name="location" id="location" rows="3" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                    </div>
                </div>    
                <button type="submit" class="block mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                  Save Changes
              </button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Description Event -->
<div id="edit-event-description" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed bg-black/50 dark:bg-black/0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Event description
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-event-description">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Describe your event</label>
                        <textarea name="location" id="location" rows="3" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                    </div>
                </div>                   
                <button type="submit" class="block mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                  Save Changes
              </button>
            </form>
        </div>
    </div>
</div>   

<style>
    .scroll-container {
        display: inline-block;
        white-space: nowrap;
    }

    @media (min-width: 640px) {
    .scroll-container {
        animation: scroll-vertical 10s linear infinite alternate;
    }
    }

    @keyframes scroll-vertical {
        0% { transform: translateY(0); }
        100% { transform: translateY(-70%); }
    }
</style>

<script>
    function previewImage(event, previewId, defaultId) {
        const input = event.target;
        const reader = new FileReader();
    
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            const defaultElement = document.getElementById(defaultId);
    
            // Tampilkan pratinjau dan sembunyikan elemen default
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            defaultElement.classList.add('hidden');
        };
    
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>        
@stop