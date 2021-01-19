<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($lists as $list)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <strong>{{ $list->name }}</strong>
                        <hr />
                        <ul class="list-disc">
                            @foreach($list->Tasks as $task)
                                <li class="ml-10">{{ $task->text }}</li>
                            @endforeach
                        </ul>
                        <button data-list-id="{{ $list->id }}" class="modal-open-0 bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">TAAK TOEVOEGEN</button>
                    </div>
                @endforeach
                <button class="modal-open-1 border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">LIJST TOEVOEGEN</button>

                <!--Modal-->
                <div class="modal-0 opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
                    <div class="modal-overlay-0 absolute w-full h-full bg-gray-900 opacity-50"></div>
                    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                        <div class="modal-close-0 absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                            <span class="text-sm">(Esc)</span>
                        </div>

                        <!-- Add margin if you want to see some of the overlay behind the modal-->
                        <div class="modal-content py-4 text-left px-6">

                            <!--Title-->
                            <div class="flex justify-between items-center pb-3">
                                <p class="modal-title text-2xl font-bold">Taak voevoegen</p>
                                <div class="modal-close-0 cursor-pointer z-50">
                                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                    </svg>
                                </div>
                            </div>

                            <form id="task_form" method="POST" action="{{ route('add_task') }}">
                                @csrf

                                <input id="list_id" type="hidden" name="list_id" value="">

                                <label for="task">Inhoud: </label>
                                <input id="task" type="text" name="task" required autofocus>
                            </form>

                            <!--Footer-->
                            <div class="flex justify-end pt-2">
                                <button data-type="submit" id="add_task" class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">Opslaan</button>
                                <button class=".modal-close-0 border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">Annuleren</button>
                            </div>
                        </div>
                    </div>
                </div><!--End Modal-->


                <!--Modal-->
                <div class="modal-1 opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
                    <div class="modal-overlay-1 absolute w-full h-full bg-gray-900 opacity-50"></div>
                    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                        <div class="modal-close-1 absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                            <span class="text-sm">(Esc)</span>
                        </div>

                        <!-- Add margin if you want to see some of the overlay behind the modal-->
                        <div class="modal-content py-4 text-left px-6">

                            <!--Title-->
                            <div class="flex justify-between items-center pb-3">
                                <p class="modal-title text-2xl font-bold">Lijst voevoegen</p>
                                <div class="modal-close-1 cursor-pointer z-50">
                                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                    </svg>
                                </div>
                            </div>

                            <form id="list_form" method="POST" action="{{ route('add_list') }}">
                                @csrf

                                <label for="list">Naam: </label>
                                <input id="list" type="text" name="list" required autofocus>
                            </form>

                            <!--Footer-->
                            <div class="flex justify-end pt-2">
                                <button data-type="submit" id="add_list" class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">Opslaan</button>
                                <button class=".modal-close-1 border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">Annuleren</button>
                            </div>
                        </div>
                    </div>
                </div><!--End Modal-->
               
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/dashboard.js') }}" defer></script>
